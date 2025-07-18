<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    const CREATED_AT = 'created_at'; // Specify the created at column if it differs
    const UPDATED_AT = 'updated_at'; // Specify the updated at column if it differs
    protected $connection = 'mysql'; // Specify the database connection if needed
    protected $table = 'topics'; // Specify the table name if it differs from the model name
    //
    protected $primaryKey = 'id'; // Specify the primary key if it differs from 'id'
    protected $keyType = 'int'; // Specify the key type if it differs from 'int'
    public $incrementing = true; // Specify if the primary key is auto-incrementing
    public $timestamps = false;

    protected $fillable = [
        'name','classroom_id','user_id',
    ];
    public function classworks()
    {
      return $this->hasMany(Classwork::class, 'topic_id','id');  
    }
}
