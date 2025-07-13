<?php

namespace App\Models;

use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

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
    static::addGlobalScope(new UserClassroomScope);
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

    // global scope بيطبق بشكل تلقائي
}
