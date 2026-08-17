<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statistique extends Model
{
    protected $table = 'statistique';
    protected $primaryKey = 'statistiqueID';

    public $timestamps = false;

    protected $fillable = [
        'statistiqueBooksCount'
    ];

}