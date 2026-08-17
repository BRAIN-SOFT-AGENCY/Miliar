<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class email extends Model
{
    protected $table = 'email';
    protected $primaryKey = 'emailID';

    public $timestamps = false;

    protected $fillable = [
        'email'
    ];

}