<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ClassroomObserver;
use App\Observers\ClassroomObserver as ObserversClassroomObserver;

class Classroom extends Model
{
    //
    use HasFactory,SoftDeletes;
    public static string $disk =  'uploads'; 
    protected $fillable = ['name', 'section', 'subject', 'room','code','theme','cover_image_path','user_id'];// These fields are mass assignable
    // protected $guarded = ['id', 'created_at', 'updated_at'];// These fields are not mass assignable
    // // = [] All allowable fields
    // public function getRouteKeyName()
    // {
    //     return 'code'; // Use code instead of id for route model binding
    // }
    protected static function booted()
    {
    //     static::addGlobalScope('user', function (Builder $query) {
    //         $query->where('user_id','=', Auth::id());
    // });
    static::observe(ObserversClassroomObserver::class);
    static::addGlobalScope(new UserClassroomScope);
    static::creating(function (Classroom $classroom){
        $classroom->code = Str::random(8);
        $classroom->user_id = Auth::id();
    });
    static::forceDeleted(function (Classroom $classroom){
        static::deleteCoverImage($classroom->cover_image_path);
    });
    static::deleting(function (Classroom $classroom){
        $classroom->status = 'deleted';
    });
    static::restored(function (Classroom $classroom){
        $classroom->status = 'active';
        $classroom->save();
    });
}
    public function getRouteKeyName()
    {
        return 'id';
    }
    public  static function uploadCoverImage($file)
    {
        $path = $file->store('/covers',
            [
                'disk'=> static::$disk // store the file in the uploads disk
                ,
            ]);
            return $path;
    }
    public static function deleteCoverImage($path){
        if(!$path || !Storage::disk(Classroom::$disk)->exists($path)){
            return;
        }
        return Storage::disk(Classroom::$disk  )->delete($path);
    }

    // local scopes
    //Illuminate\Database\Eloquent\Builder
    public function scopeActive(Builder $query)
    {
        $query->where('status','=','active');
    }
    public function scopeRecent(Builder $query)
    {
        $query->orderBy('updated_at','desc');
    }
    public function scopeStatus(Builder $query, $status = 'active')
    {
        $query->where('status','=', $status);
    }
    public function join($user_id,$role = 'student')
    {
        return DB::table('classroom_user')->insert([
            'classroom_id' => $this->id,
            'user_id' => $user_id,
            'role' => $role,
            'created_at' => now()
        ]);
    }

    // global scope بيطبق بشكل تلقائي
    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }
    public function getCoverImageUrlAttribute()
    {
        if($this->cover_image_path){
            return;
        }
        return 'https://placehold.co/800x300';
    }
    public function getUrlAttribute()
    {
        return route('classrooms.show',$this->id);
    }


}
