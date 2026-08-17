<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'categoryID';
    public $timestamps = false;

    protected $fillable = [
        'categoryName',
        'parent',
        'icon'
    ];
}