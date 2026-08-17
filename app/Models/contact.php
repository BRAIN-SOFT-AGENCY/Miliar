<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'contactID';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'message'
    ];

}