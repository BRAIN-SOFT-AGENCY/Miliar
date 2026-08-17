<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Favoris;
use App\Models\Book;
use App\Models\Translator;
use App\Models\Category;
use App\Models\statistique;
use App\Models\Bookspart;
use App\Models\etudespart;

use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

    public function index()
    {
        // echo 'hi';die();
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
                ->whereDate('books.PublierLe', '<=', now())
                ->orderBy('books.booksID', 'desc')
                ->take(5) // les 4 derniers
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
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('books.booksID', 'desc')
            ->take(4)
            ->get();

        $bookVue = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.categoryID', 2)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())

            ->take(4)
            ->get();

        $bookChoix = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.categoryID', 3)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())

            ->take(4)
            ->get();

        $bookDerIndex = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())

            ->take(3)
            ->get();
        $bookDerIndex2 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())

            ->skip(12)   //  ignore les 6 premiers
            ->take(6)   //  prend les 6 suivants
            ->get();

        $bookBanner = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.isbanner', 1)
            ->take(4)->get();
        $bookBanner1 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.isbanner', 1)

            ->skip(4)   //  ignore les 6 premiers
            ->take(1)->get();
        $translatorscount = Translator::count();
        $categorycount = Category::count();
        $bookscount = Book::count();
        $mainCounter = statistique::value('statistiqueBooksCount');
        $translators = Translator::withCount('books')
            ->orderBy('books_count', 'desc')
            ->get();


        $articlesCount = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 0)
            ->count();
        $booksCount = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 1)
            ->count();
        $studiesCount = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 1)
            ->count();


        $booksindex = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 1)
            ->take(2)
            ->get();
        //   echo print_r($booksindex);die();
        $articlesindex = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 0)
            ->take(2)
            ->get();
        $etudesindex = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 2)
            ->take(2)
            ->get();
        return view('client.pages.index', compact('booksindex', 'articlesindex', 'etudesindex', 'articlesCount', 'booksCount', 'studiesCount', 'category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2', 'bookBanner', 'bookBanner1', 'translatorscount', 'categorycount', 'bookscount', 'mainCounter', 'translators'));

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
            ->orderBy('favoris.favorisID', 'desc')

            ->where('favoris.clientID', $clientID)
            ->paginate(9);

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
        $favori = Favoris::where('clientID', $clientID)
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

    public function translatorweb(Request $request)
    {
        $query = Translator::withCount('books')
            ->orderBy('books_count', 'desc');

        if ($request->filled('search')) {

            $words = explode(' ', $request->search);

            $query->where(function ($q) use ($words) {
                foreach ($words as $word) {
                    $q->where(function ($q2) use ($word) {
                        $q2->where('translatorfirstName', 'LIKE', "%$word%")
                            ->orWhere('translatorLastName', 'LIKE', "%$word%");
                    });
                }
            });
        }
        $translators = $query->paginate(15);

        return view('client.pages.translatorweb', compact('translators'));
    }


    public function getShortResumeAttribute()
    {
        return Str::words(strip_tags($this->ResumeLivre), 30, '...');
    }
    public function books(Request $request)
    {
        $perPage = 12;

        $booksQuery = Book::with('category');

        // status
        $booksQuery->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now());

        // ================= SEARCH =================
        if ($request->filled('search')) {

            $search = $request->search;

            $booksQuery->where(function ($q) use ($search) {

                $q->where('Titre', 'like', "%{$search}%")
                    ->orWhere('ResumeLivre', 'like', "%{$search}%")
                    ->orWhere('NomAuteur', 'like', "%{$search}%")
                    ->orWhere('MaisonEdition', 'like', "%{$search}%");

            });
        }

        // ================= SOURCE =================
        if ($request->filled('MaisonEdition')) {

            $booksQuery->where(
                'MaisonEdition',
                'like',
                '%' . $request->MaisonEdition . '%'
            );
        }

        // ================= CATEGORY =================
        if ($request->filled('category')) {

            $booksQuery->where(
                'categoryID',
                $request->category
            );
        }

        // ================= TRANSLATOR =================
        /*if ($request->filled('translatorID')) {

            $booksQuery->where(
                'translatorID',
                $request->translatorID
            );
        }*/
        if ($request->filled('translatorID')) {

            $booksQuery->where('books.translatorID', $request->translatorID);
        }
        $translator = request('translator');

        $books = Book::with(['translator', 'category'])
            ->when($translator, function ($query) use ($translator) {
                $query->whereHas('translator', function ($q) use ($translator) {
                    $q->whereRaw("CONCAT(translatorfirstName, ' ', translatorLastName) = ?", [$translator]);
                });
            })
            ->paginate(9);
        // ================= TRANSLATOR SEARCH =================
        if ($request->filled('translatorName')) {

            $translatorSearch = trim($request->translatorName);

            // join translator table
            $booksQuery->join(
                'translator',
                'books.translatorID',
                '=',
                'translator.translatorID'
            );

            $words = explode(' ', $translatorSearch);

            $booksQuery->where(function ($q) use ($words) {

                foreach ($words as $word) {

                    $q->where(function ($qq) use ($word) {

                        $qq->where(
                            'translator.translatorfirstName',
                            'like',
                            '%' . $word . '%'
                        )
                            ->orWhere(
                                'translator.translatorLastName',
                                'like',
                                '%' . $word . '%'
                            );

                    });

                }

            });

            // avoid duplicate columns issue
            $booksQuery->select('books.*');
        }

        // ================= TYPE =================
        if ($request->filled('type')) {

            $booksQuery->whereIn(
                'type',
                $request->type
            );
        }

        // ================= YEAR RANGE =================
        if ($request->filled('year_from') && $request->filled('year_to')) {

            $booksQuery->whereYear(
                'PublierLe',
                '>=',
                $request->year_from
            );

            $booksQuery->whereYear(
                'PublierLe',
                '<=',
                $request->year_to
            );
        }
        // ================= DATE PUBLICATION =================
        // ================= DATE =================
        if ($request->filled('publish_date')) {

            $booksQuery->whereDate(
                'PublierLe',
                $request->publish_date
            );
        }
        // ================= SORT =================
        switch ($request->sort) {

            case 'newest':
                $booksQuery->orderBy('PublierLe', 'desc');
                break;

            case 'title_asc':
                $booksQuery->orderBy('Titre', 'asc');
                break;

            case 'title_desc':
                $booksQuery->orderBy('Titre', 'desc');
                break;

            default:
                $booksQuery->orderBy('booksID', 'desc');
                break;
        }

        $books = $booksQuery
            ->paginate($perPage)
            ->appends($request->all());

        $categories = Category::where('parent', 0)->get();

        $translators = Translator::all();

        $booksTranslatorsnews = Book::join(
            'category',
            'books.categoryID',
            '=',
            'category.categoryID'
        )
            ->join(
                'translator',
                'books.translatorID',
                '=',
                'translator.translatorID'
            )
            ->select(
                'books.*',
                'category.categoryName as categoryName',
                'translator.translatorfirstName as translatorfirstName',
                'translator.translatorlastName as translatorlastName'
            )
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('books.booksID', 'desc')
            ->skip(12)
            ->take(16)
            ->get();
        $translators = Translator::withCount('books')
            ->orderBy('books_count', 'desc')
            ->paginate(15);
        return view(
            'client.pages.books',
            compact(
                'books',
                'categories',
                'translators',
                'booksTranslatorsnews'
            )
        );
    }
    public function booksDetails($id)
    {
        // Récupérer le livre correspondant à l'ID
        $book = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $id)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->firstOrFail();
        $booksType0categ = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->where('books.categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 0)
            ->take(4)
            ->get();
        $booksType1categ = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->where('books.categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 1)
            ->take(10)
            ->get();
        $booksType2categ = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->where('books.categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 2)
            ->take(10)
            ->get();
        //echo print_r($booksType2categ);die();

        $booksParts = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->join('bookspart', 'books.booksID', '=', 'bookspart.booksID')
            ->select('books.*', 'bookspart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $id)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
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
            ->whereDate('books.PublierLe', '<=', now())
            ->get();
        $groupedetudes = $etudesParts->chunk(ceil($etudesParts->count() / 3));

        return view('client.pages.booksDetails', compact('book', 'groupedBooks', 'groupedetudes', 'booksType2categ', 'booksType0categ', 'booksType1categ'));
    }
    public function booksPartDetails($id)
    {
        // Récupérer le livre correspondant à l'ID
        $book = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->select('bookspart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorLastName as translatorLastName')
            ->where('bookspart.booksPartID', $id)
            ->firstOrFail();
        $booksID = $book->booksID;
        $booksType0categ = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->where('books.categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 1)
            ->take(4)
            ->get();

        $booksParts = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->select('bookspart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorLastName as translatorLastName')
            ->where('bookspart.booksID', $booksID)
            // ->where('bookspart.booksPartID', '!=', $id)

            ->get();
        // division automatique en 3 colonnes
        $groupedBooks = $booksParts->chunk(ceil($booksParts->count() / 3));

        return view('client.pages.booksPartDetails', compact('book', 'booksType0categ', 'groupedBooks'));
    }

    public function etudesPartDetails($id)
    {
        // Récupérer le livre correspondant à l'ID
        $book = etudespart::join('category', 'etudespart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'etudespart.translatorID', '=', 'translator.translatorID')
            ->select('etudespart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorLastName as translatorLastName')
            ->where('etudespart.etudespartID', $id)
            ->firstOrFail();
        $booksID = $book->booksID;
        $booksType0categ = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->where('books.categoryID', $book->categoryID)
            ->where('booksID', '!=', $id) // exclure le livre actuel
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.type', 2)
            ->take(4)
            ->get();

        $booksParts = etudespart::join('category', 'etudespart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'etudespart.translatorID', '=', 'translator.translatorID')
            ->select('etudespart.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorLastName as translatorLastName')
            ->where('etudespart.booksID', $booksID)
            ->get();
        // division automatique en 3 colonnes
        $groupedBooks = $booksParts->chunk(ceil($booksParts->count() / 3));
        //echo print_r($groupedBooks);die();



        return view('client.pages.etudesPartDetails', compact('book', 'booksType0categ', 'groupedBooks'));
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
            ->whereDate('books.PublierLe', '<=', now())
            ->limit(5)
            ->get();
        $books2 = \DB::table('books')
            ->where('translatorID', $id)
            ->orderBy('booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->skip(5)   //  ignore les 5 premiers
            ->take(5) //prondre 5 suivants
            ->get();
        $books3 = \DB::table('books')
            ->where('translatorID', $id)
            ->orderBy('booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
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
    public function categoryID($categoryID)
    {
        $category = Category::findOrFail($categoryID);

        $books = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select(
                'books.*',
                'category.categoryName',
                'translator.translatorfirstName',
                'translator.translatorlastName'
            )
            ->where('books.categoryID', $categoryID)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('books.booksID', 'desc')
            ->take(3)
            ->get();

        $bookscol4 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select(
                'books.*',
                'category.categoryName',
                'translator.translatorfirstName',
                'translator.translatorlastName'
            )
            ->where('books.categoryID', $categoryID)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('books.booksID', 'desc')
            ->skip(15)
            ->take(6)
            ->get();
        $latestPosts = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select(
                'books.*',
                'category.categoryName as categoryName',
                'translator.translatorfirstName as translatorfirstName',
                'translator.translatorlastName as translatorlastName'
            )
            ->where('books.categoryID', $categoryID)
            ->where('books.isbanner', 2)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('books.booksID', 'desc')
            ->take(5)
            ->get();

        $bookBanner1 = $latestPosts->take(1); // premier article
        $bookBanner = $latestPosts->slice(1, 4); // les 4 suivants
        return view('client.pages.categoryID', compact('books', 'category', 'bookBanner1', 'bookBanner', 'bookscol4'));
    }

}