<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\favoris;
use App\Models\Book;
use App\Models\Translator;
use App\Models\Category;
use App\Models\statistique;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    /*   public function favoris()
       {
           $favorisList = favoris::join('books', 'books.booksID', '=', 'favoris.booksID')
               ->join('client', 'favoris.clientID', '=', 'client.clientID')
               ->select('favoris.*', 'books.*', 'client.*')
               ->where('favoris.clientID', session('clientID'))
               ->get();
           return view('client.pages.favoris', compact('favorisList'));
       }*/

    public function index()
    {
        // Fonction pour récupérer les 6 derniers livres d'une catégorie
        $getBooksByCategory = function ($categoryId) {
            return Book::join('category', 'books.categoryID', '=', 'category.categoryID')
                ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
                ->select(
                    'books.*',
                    'category.categoryName as categoryName',
                    'translator.translatorfirstName as translatorfirstName',
                    'translator.translatorlastName as translatorlastName'
                )
                ->where('books.categoryID', $categoryId)
                ->where('books.status', 0)
                ->orderBy('books.booksID', 'desc')
                ->take(4) // les 4 derniers
                ->get();
        };

        $category1 = $getBooksByCategory(1);
        $category2 = $getBooksByCategory(2);
        $category3 = $getBooksByCategory(3);
        $category4 = $getBooksByCategory(4);
        $category6 = $getBooksByCategory(6);
        // Récupérer les derniére 6 livres
        $bookDer = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.status', 0)
            ->orderBy('books.booksID', 'desc')
            ->take(6)
            ->get();

        $bookVue = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.categoryID', 2)
            ->where('books.status', 0)

            ->take(6)
            ->get();

        $bookChoix = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.categoryID', 3)
            ->where('books.status', 0)

            ->take(6)
            ->get();

        $bookDerIndex = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)

            ->take(3)
            ->get();
        $bookDerIndex2 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)

            ->skip(12)   //  ignore les 6 premiers
            ->take(6)   //  prend les 6 suivants
            ->get();

        $bookBanner = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->where('books.isbanner', 1)
            ->take(4)->get();
        $bookBanner1 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->where('books.isbanner', 1)

            ->skip(4)   //  ignore les 6 premiers
            ->take(1)->get();
        $translatorscount = Translator::count();
        $categorycount = Category::count();
        $bookscount = Book::count();
        $mainCounter = statistique::value('statistiqueBooksCount');
        return view('client.pages.index', compact('category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2', 'bookBanner', 'bookBanner1', 'translatorscount', 'categorycount', 'bookscount', 'mainCounter'));

        //return view('client.pages.index1', compact('category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2'));
    }

    public function favoris()
    {
        $clientID = session('clientID');

        if (!$clientID) {
            return redirect('/login'); // ou page login
        }

        $favorisList = favoris::join('books', 'books.booksID', '=', 'favoris.booksID')
            ->join('client', 'favoris.clientID', '=', 'client.clientID')
            ->select('favoris.*', 'books.*', 'client.*')
            ->where('favoris.clientID', $clientID)
            ->paginate(10);

        return view('client.pages.favoris', compact('favorisList'));
    }
    public function addFavoris(Request $request)
    {
        // vérifier login
        if (!session()->has('clientID')) {

            return response()->json([
                'status' => 'login'
            ]);
        }

        $clientID = session('clientID');
        $booksID = $request->booksID;

        // vérifier si déjà existe
        $favori = favoris::where('clientID', $clientID)
            ->where('booksID', $booksID)
            ->first();

        // si existe => supprimer
        if ($favori) {

            $favori->delete();

            return response()->json([
                'status' => 'removed'
            ]);
        }

        // sinon ajouter
        favoris::create([
            'clientID' => $clientID,
            'booksID' => $booksID
        ]);

        return response()->json([
            'status' => 'added'
        ]);
    }

    public function translatorweb()
    {
        $translators = Translator::withCount('books')
            ->orderBy('books_count', 'desc')
            ->paginate(15);

        return view('client.pages.translatorweb', compact('translators'));
    }

    public function getShortResumeAttribute()
    {
        return Str::words(strip_tags($this->ResumeLivre), 30, '...');
    }
    public function books(Request $request)
    {
        $perPage = 12;

        $booksQuery = Book::query();

        // Recherche par texte (titre, résumé ou auteur)
        if ($request->filled('search')) {
            $search = $request->input('search');

            $booksQuery->where(function ($q) use ($search) {
                $q->where('Titre', 'like', "%{$search}%")
                    ->orWhere('ResumeLivre', 'like', "%{$search}%")
                    ->orWhere('NomAuteur', 'like', "%{$search}%")
                    ->orWhere('MaisonEdition', 'like', "%{$search}%");

            })->where('books.status', 0);
        }
        if ($request->filled('MaisonEdition')) {
            $MaisonEdition = $request->input('MaisonEdition');

            $booksQuery->where(function ($q) use ($MaisonEdition) {
                $q->where('MaisonEdition', 'like', "%{$MaisonEdition}%");

            });
        }
        // Filtre par date de publication
        if ($request->filled('search_date')) {
            $booksQuery->whereDate('PublierLe', $request->input('search_date'))
                ->where('books.status', 0);
        }

        // Filtre par catégorie
        if ($request->filled('category')) {
            $booksQuery->where('categoryID', $request->input('category'))
                ->where('books.status', 0);
        }

        // Filtre par Traducteur
        if ($request->filled('translator')) {
            $booksQuery->where('translatorID', $request->input('translator'))
                ->where('books.status', 0);
        }
        // Filtre par type (0 = مقالات
        // , 1 = كتب
        // , 2 = دراسات)
        if ($request->filled('type')) {
            $types = $request->input('type'); // array

            $booksQuery->whereIn('type', $types)
                ->where('books.status', 0);
        }
        // Tri
        switch ($request->input('sort')) {
            case 'newest':
                $booksQuery->orderBy('PublierLe', 'desc')
                    ->where('books.status', 0);
                break;
            case 'title_asc':
                $booksQuery->orderBy('Titre', 'asc')
                    ->where('books.status', 0);
                break;
            case 'title_desc':
                $booksQuery->orderBy('Titre', 'desc')
                    ->where('books.status', 0);
                break;
            case 'popular':
                // si vous avez une colonne de popularité/visites, remplacez-la ici
                $booksQuery->orderBy('booksID', 'desc')
                    ->where('books.status', 0);
                break;
            default:
                $booksQuery->orderBy('booksID', 'desc')
                    ->where('books.status', 0);
                break;
        }

        $books = $booksQuery->paginate($perPage)->appends($request->except('page'));

        $categories = Category::where('parent', 0)->get();
        $translators = Translator::all();



        //books col-lg-4
        $booksTranslatorsnews = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->skip(12)
            ->take(16)
            ->get();
        return view('client.pages.books', compact('books', 'categories', 'translators', 'booksTranslatorsnews'));
    }
    public function booksDetails($id)
    {
        // Récupérer le livre correspondant à l'ID
        $book = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $id)
            ->where('books.status', 0)
            ->firstOrFail();
        //  3 livres de la même catégorie
        $relatedBooks1 = Book::where('categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->take(5)
            ->get();
        $relatedBooks2 = Book::where('categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->skip(5)   //  ignore les 5 premiers
            ->take(5)   //  prend les 5suivants         
            ->get();
        $relatedBooks3 = Book::where('categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->skip(10)   //  ignore les 10 premiers
            ->take(5)   //  prend les 5suivants
            ->get();
        $booksParts = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->join('bookspart', 'books.booksID', '=', 'bookspart.booksID')
            ->select('books.*', 'bookspart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $id)
            ->where('books.status', 0)
            ->get();
        // division automatique en 3 colonnes
        $groupedBooks = $booksParts->chunk(ceil($booksParts->count() / 3));




        //etudesParts

        $etudesParts = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->join('etudespart', 'books.booksID', '=', 'etudespart.booksID')

            ->select('books.*', 'etudespart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $id)
            ->where('books.status', 0)
            ->get();
        $groupedetudes = $etudesParts->chunk(ceil($etudesParts->count() / 3));

        return view('client.pages.booksDetails', compact('book', 'relatedBooks1', 'relatedBooks2', 'relatedBooks3', 'groupedBooks', 'groupedetudes'));
    }
    public function translatorDetails($id)
    {
        // المترجم
        $translator = Translator::findOrFail($id);

        // الكتب (آخر 5)
        $books1 = \DB::table('books')
            ->where('translatorID', $id)
            ->orderBy('booksID', 'desc')
            ->where('books.status', 0)
            ->limit(5)
            ->get();
        $books2 = \DB::table('books')
            ->where('translatorID', $id)
            ->orderBy('booksID', 'desc')
            ->where('books.status', 0)
            ->skip(5)   //  ignore les 5 premiers
            ->take(5) //prondre 5 suivants
            ->get();
        $books3 = \DB::table('books')
            ->where('translatorID', $id)
            ->orderBy('booksID', 'desc')
            ->where('books.status', 0)
            ->skip(10)   //  ignore les 10 premiers
            ->take(5)->get(); //prondre 5 suivants

        return view('client.pages.translatorDetails', compact('translator', 'books1', 'books2', 'books3'));
    }

    public function about()
    {

        return view('client.pages.about');
    }
    public function contact()
    {

        return view('client.pages.contact');
    }
    public function elementor()
    {

        return view('client.pages.elementor');
    }
}