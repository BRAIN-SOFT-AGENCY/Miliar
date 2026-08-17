<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    protected $table = 'translator';
    protected $primaryKey = 'translatorID';

    public $timestamps = false;

    protected $fillable = [
        'translatorfirstName',
        'translatorLastName',
        'translatorPicture',
        'translatorEmail',
        'translatorPWD',
        'translatorStatus',
        'translatorCreated',
        'partner'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function books()
    {
        return $this->hasMany(Book::class, 'translatorID', 'translatorID');
    }
}