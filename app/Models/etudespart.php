<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class etudespart extends Model
{
    protected $table = 'etudespart';

    protected $primaryKey = 'etudespartID';

    public $timestamps = false;   // ⭐ IMPORTANT

    protected $fillable = [
        'etudespartImage',
        'etudespartTitre',
        'etudespartNomAuteur',
        'etudespartMaisonEdition',
        'etudespartDateSortie',
        'etudespartPublierLe',
        'etudespartResumeLivre',
        'translatorID',
        'categoryID',
        'etudespartarticle',
        'booksID',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'categoryID');
    }
    public function translator()
    {
        return $this->belongsTo(
            Translator::class,
            'translatorID',
            'translatorID'
        );
    }
}