<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    use HasFactory;
    protected $fillable = ['name', 'section', 'subject', 'room','code','theme','cover_image_path'];// These fields are mass assignable
    // protected $guarded = ['id', 'created_at', 'updated_at'];// These fields are not mass assignable
    // // = [] All allowable fields
    
}
