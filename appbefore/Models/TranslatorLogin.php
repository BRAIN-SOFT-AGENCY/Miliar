<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TranslatorLogin extends Authenticatable
{
    protected $table = 'translator';

    protected $primaryKey = 'translatorID';

    protected $fillable = [
        'translatorEmail',
        'translatorPWD'
    ];

    protected $hidden = [
        'translatorPWD'
    ];
    public function getAuthPassword()
    {
        return $this->translatorPWD;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}