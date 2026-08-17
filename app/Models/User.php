<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'type'
    ];

    protected $hidden = [
        'password',
    ];

    // Accessor pour récupérer le rôle en texte
    public function getRoleAttribute()
    {
        return match ($this->type) {
            1 => 'translator',
            2 => 'editor',
            3 => 'super_admin',
            default => 'unknown'
        };
    }

    public function translator()
    {
        return $this->hasOne(Translator::class, 'user_id', 'id');
    }
}