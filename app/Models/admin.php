<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'email',
        'password'
    ];
}
