<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    protected $primaryKey = 'booksID';

    public $timestamps = false;   // ⭐ IMPORTANT

    protected $fillable = [
        'Image',
        'Titre',
        'NomAuteur',
        'MaisonEdition',
        'DateSortie',
        'VersionImprimable',
        'ResumeLivre',
        'pdf_file',
        'PublierLe',
        'translatorID',
        'categoryID',
        'article',
        'type',
        'status',
        'isbanner'
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