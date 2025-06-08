<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    //
    use HasFactory;
    public static string $disk =  'uploads'; 
    protected $fillable = ['name', 'section', 'subject', 'room','code','theme','cover_image_path'];// These fields are mass assignable
    // protected $guarded = ['id', 'created_at', 'updated_at'];// These fields are not mass assignable
    // // = [] All allowable fields
    // public function getRouteKeyName()
    // {
    //     return 'code'; // Use code instead of id for route model binding
    // }

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
        
        return Storage::disk(Classroom::$disk  )->delete($path);
    }
}
