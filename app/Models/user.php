<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user extends Model
{
    use HasFactory;
        public $timestamps = true;

    protected $primaryKey = "id";

    protected $table = "user";


    protected $fillable = ['id','username' ,'password', 'role', 'avatar_url','full_name','status' ];
}
