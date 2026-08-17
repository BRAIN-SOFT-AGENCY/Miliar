<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookspart extends Model
{
    protected $table = 'bookspart';

    protected $primaryKey = 'booksPartID';

    public $timestamps = false;   // ⭐ IMPORTANT

    protected $fillable = [
        'booksPartImage',
        'booksPartTitre',
        'booksPartNomAuteur',
        'bookspartMaisonEdition',
        'bookspartDateSortie',
        'bookspartVersionImprimable',
        'bookspartResumeLivre',
        'bookspartpdf_file',
        'bookspartPublierLe',
        'translatorID',
        'categoryID',
        'booksID',
        'bookpartarticle',

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