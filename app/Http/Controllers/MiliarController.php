<?php
namespace App\Http\Controllers;
use App\Models\Bookspart;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Translator;
use App\Models\Category;
use App\Models\statistique;
use App\Models\etudespart;
use App\Models\contact;
use App\Models\email;
use App\Models\partners;

use Exception;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class MiliarController extends Controller
{
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
        $translatorscount = Translator::where('translatorStatus', 1)->count();
        $partnerscount = partners::count();
        $articlescountlettres = 0;

        Book::where('status', 0)
            ->select('booksID', 'article')
            ->chunkById(100, function ($books) use (&$articlescountlettres) {

                foreach ($books as $book) {

                    $text = strip_tags($book->article);
                    $text = preg_replace('/[^\p{L}\p{N}]/u', '', $text);

                    $articlescountlettres += mb_strlen($text, 'UTF-8');
                }

            }, 'booksID');
        $categorycount = Category::count();
        $bookscount = Book::count();
        $mainCounter = statistique::value('statistiqueBooksCount');
        // echo print_r($articlescountmots); echo "*******";
        // echo print_r($mainCounter);
        // die();

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
        $booksCountmodal = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
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
            ->where('books.type', 2)
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
        $partners = partners::orderBy('partnersID', 'desc')->get();

        return view('web.pages.index', compact('bookscount', 'articlescountlettres', 'partnerscount', 'partners', 'booksindex', 'articlesindex', 'etudesindex', 'articlesCount', 'booksCountmodal', 'studiesCount', 'category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2', 'bookBanner', 'bookBanner1', 'translatorscount', 'categorycount', 'mainCounter', 'translators'));

        //return view('web.pages.index1', compact('category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2'));
    }
    public function indexProp2()
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
                ->orderBy('books.booksID', 'desc')
                ->where('books.status', 0)
                ->whereDate('books.PublierLe', '<=', now())

                ->take(1) // les 4 derniers
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
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())

            ->take(6)
            ->get();

        $bookVue = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.categoryID', 2)

            ->take(6)
            ->get();

        $bookChoix = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->where('books.categoryID', 3)

            ->take(6)
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
            ->skip(10)   //  ignore les 6 premiers
            ->take(4)->get();
        $bookBanner1 = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')

            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->orderBy('books.booksID', 'desc')
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->skip(14)   //  ignore les 6 premiers
            ->take(1)->get();
        return view('web.pages.indexProp2', compact('category1', 'category2', 'category3', 'category4', 'category6', 'bookDer', 'bookVue', 'bookChoix', 'bookDerIndex', 'bookDerIndex2', 'bookBanner', 'bookBanner1'));

    }

    public function translatorweb(Request $request)
    {
        $query = Translator::withCount('books')
            ->where('translator.translatorStatus', 1)
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

        return view('web.pages.translatorweb', compact('translators'));
    }


    public function getShortResumeAttribute()
    {
        return Str::words(strip_tags($this->ResumeLivre), 30, '...');
    }
    /*   public function books(Request $request)
       {
           $perPage = 12;

           $booksQuery = Book::with(['category', 'translator']);

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
           if ($request->filled('translatorID')) {

               $booksQuery->where(
                   'translatorID',
                   $request->translatorID
               );
           }
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

           $categories = Category::where('parent', 0)->where('isActive', 1)->get();

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
               'web.pages.books',
               compact(
                   'books',
                   'categories',
                   'translators',
                   'booksTranslatorsnews'
               )
           );
       }*/

    public function books(Request $request)
    {
        $perPage = 12;

        /*
        |--------------------------------------------------------------------------
        | QUERY PRINCIPALE
        |--------------------------------------------------------------------------
        */

        $booksQuery = Book::with(['category', 'translator']);

        /*
        |--------------------------------------------------------------------------
        | LIVRES PUBLIÉS
        |--------------------------------------------------------------------------
        */

        $booksQuery->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now());


        /*
        |--------------------------------------------------------------------------
        | SEARCH KEYWORD
        |--------------------------------------------------------------------------
        |
        | La recherche porte sur plusieurs champs.
        | Cette partie reste compatible avec TOUS les autres filtres.
        |
        */

        if ($request->filled('search')) {

            $search = trim($request->search);

            $booksQuery->where(function ($q) use ($search) {

                /*  $q->where('books.Titre', 'like', '%' . $search . '%')
                      ->orWhere('books.ResumeLivre', 'like', '%' . $search . '%')
                      ->orWhere('books.NomAuteur', 'like', '%' . $search . '%')
                      ->orWhere('books.MaisonEdition', 'like', '%' . $search . '%');*/

                $q->where('books.article', 'like', '%' . $search . '%');
            });
        }


        /*
        |--------------------------------------------------------------------------
        | SOURCE / MAISON D'ÉDITION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('MaisonEdition')) {

            $booksQuery->where(
                'books.MaisonEdition',
                'like',
                '%' . trim($request->MaisonEdition) . '%'
            );
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category')) {

            $booksQuery->where(
                'books.categoryID',
                $request->category
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSLATOR PAR ID
        |--------------------------------------------------------------------------
        */

        if ($request->filled('translatorID')) {

            $booksQuery->where(
                'books.translatorID',
                $request->translatorID
            );
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSLATOR PAR NOM
        |--------------------------------------------------------------------------
        |
        | On utilise whereHas() afin de ne pas casser la requête principale.
        |
        */

        if ($request->filled('translatorName')) {

            $translatorSearch = trim($request->translatorName);

            $booksQuery->whereHas('translator', function ($q) use ($translatorSearch) {

                $words = preg_split('/\s+/', $translatorSearch);

                foreach ($words as $word) {

                    if (!empty($word)) {

                        $q->where(function ($qq) use ($word) {

                            $qq->where(
                                'translatorfirstName',
                                'like',
                                '%' . $word . '%'
                            )
                                ->orWhere(
                                    'translatorLastName',
                                    'like',
                                    '%' . $word . '%'
                                );

                        });
                    }
                }
            });
        }


        /*
        |--------------------------------------------------------------------------
        | TYPE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('type')) {

            $types = is_array($request->type)
                ? $request->type
                : [$request->type];

            $booksQuery->whereIn(
                'books.type',
                $types
            );
        }


        /*
        |--------------------------------------------------------------------------
        | YEAR RANGE
        |--------------------------------------------------------------------------
        */

        if ($request->filled('year_from')) {

            $booksQuery->whereYear(
                'books.PublierLe',
                '>=',
                $request->year_from
            );
        }

        if ($request->filled('year_to')) {

            $booksQuery->whereYear(
                'books.PublierLe',
                '<=',
                $request->year_to
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DATE DE PUBLICATION
        |--------------------------------------------------------------------------
        */

        if ($request->filled('publish_date')) {

            $booksQuery->whereDate(
                'books.PublierLe',
                $request->publish_date
            );
        }


        /*
        |--------------------------------------------------------------------------
        | SORT
        |--------------------------------------------------------------------------
        */

        switch ($request->sort) {

            case 'newest':

                $booksQuery->orderBy(
                    'books.PublierLe',
                    'desc'
                );

                break;


            case 'title_asc':

                $booksQuery->orderBy(
                    'books.Titre',
                    'asc'
                );

                break;


            case 'title_desc':

                $booksQuery->orderBy(
                    'books.Titre',
                    'desc'
                );

                break;


            default:

                $booksQuery->orderBy(
                    'books.booksID',
                    'desc'
                );

                break;
        }


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        |
        | appends() conserve TOUS les filtres pendant la pagination.
        |
        */

        $books = $booksQuery
            ->paginate($perPage)
            ->appends($request->except('page'));


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = Category::where('parent',0)->where('isActive', 1)->get();


        /*
        |--------------------------------------------------------------------------
        | TRANSLATORS
        |--------------------------------------------------------------------------
        |
        | IMPORTANT :
        | Ici on récupère la liste des traducteurs pour le sidebar.
        | On ne doit PAS remplacer la requête $books.
        |
        */

        $translators = Translator::withCount('books')
            ->orderBy('books_count', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | LIVRES RÉCENTS / AUTRES LIVRES
        |--------------------------------------------------------------------------
        */

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
                'translator.translatorLastName as translatorLastName'
            )
            ->where(
                'books.status',
                0
            )
            ->whereDate(
                'books.PublierLe',
                '<=',
                now()
            )
            ->orderBy(
                'books.booksID',
                'desc'
            )
            ->skip(12)
            ->take(16)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'web.pages.books',
            compact(
                'books',
                'categories',
                'translators',
                'booksTranslatorsnews'
            )
        );
    }


    public function books1(Request $request)
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
        if ($request->filled('translatorID')) {

            $booksQuery->where(
                'translatorID',
                $request->translatorID
            );
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

        $categories = Category::where('parent', 0)->where('isActive', 1)->get();

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

        return view(
            'web.pages.books1',
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
//Added By AYMAN
        Book::where('booksID', $id)->increment('nbViews');
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

        return view('web.pages.booksDetails', compact('book', 'groupedBooks', 'groupedetudes', 'booksType2categ', 'booksType0categ', 'booksType1categ'));
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

        $bookoriginal = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $booksID)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->firstOrFail();
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

        return view('web.pages.booksPartDetails', compact('book', 'booksType0categ', 'groupedBooks', 'bookoriginal'));
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

        $bookoriginal = Book::join('category', 'books.categoryID', '=', 'category.categoryID')
            ->join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->select('books.*', 'category.categoryName as categoryName', 'translator.translatorfirstName as translatorfirstName', 'translator.translatorlastName as translatorlastName')
            ->where('books.booksID', $booksID)
            ->where('books.status', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->firstOrFail();
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



        return view('web.pages.etudesPartDetails', compact('book', 'booksType0categ', 'groupedBooks', 'bookoriginal'));
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

        return view('web.pages.translatorDetails', compact('translator', 'books1', 'books2', 'books3'));
    }
    public function inscription()
    {

        return view('web.pages.inscription');
    }
    public function register()
    {

        return view('web.pages.register');
    }
    public function about()
    {

        return view('web.pages.about');
    }

    public function elementor()
    {

        return view('web.pages.elementor');
    }
    public function categoryID($categoryID)
    {
        //echo 'hiii';die();
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
        return view('web.pages.categoryID', compact('books', 'category', 'bookBanner1', 'bookBanner', 'bookscol4'));
    }
    public function demande()
    {
        return view('web.pages.demande');
    }
    public function storedemandetranslator(Request $request)
    {
        $data = $request->validate([
            'translatorfirstName' => 'required',
            'translatorLastName' => 'required',
            'translatorEmail' => 'nullable',
            'translatorPWD' => 'nullable',
            'translatorStatus' => 'nullable',
            'translatorPicture' => 'nullable|image|mimes:jpg,jpeg,png',
            'partner' => 'nullable|in:0,1'

        ]);

        // Upload image
        if ($request->hasFile('translatorPicture')) {

            $file = $request->file('translatorPicture');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('includesAdmin/img/translator');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['translatorPicture'] = $filename;

        } else {
            $data['translatorPicture'] = 'default.jpg';
        }


        // Ajouter la date de publication automatiquement
        $data['translatorCreated'] = now()->toDateString(); // yyyy-mm-dd

        Translator::create($data);
        // Email data
        /*  $emailData = [
              'email' => $data['translatorEmail'],
              'password' => '123456',
              'link' => 'https://maxu123.com/miliar/login',
              'name' => $data['translatorfirstName'] . ' ' . $data['translatorLastName']
          ];

          // Send email
          Mail::send('emails.translator_welcome', $emailData, function ($message) use ($emailData) {
              $message->to($emailData['email'])
                  ->subject('مرحبًا بك في منطقة المترجم الخاصة بك');
          });*/
        // Redirection vers la page des livres
        return redirect()->route('miliar.demande')->with('success', 'تم إرسال طلبك بنجاح');
    }
    public function contact()
    {

        return view('web.pages.contact');
    }
    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'message' => 'required',
        ]);

        try {

            contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'message' => $request->message,
            ]);

            return redirect()->back()->with('success', '✅ تم إرسال رسالتك بنجاح.');

        } catch (Exception $e) {

            return redirect()->back()
                ->withInput()
                ->with('error', '❌ حدث خطأ أثناء إرسال الرسالة، يرجى المحاولة مرة أخرى.');

            // Pour déboguer, tu peux temporairement utiliser :
            // return $e->getMessage();
        }
    }

    public function emailStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        try {

            Email::create([
                'email' => $request->email,
            ]);

            return back()->with('success', 'تم إرسال البريد الإلكتروني بنجاح.');

        } catch (\Exception $e) {

            return back()
                ->withInput()
                ->with('error', 'حدث خطأ، يرجى المحاولة مرة أخرى.');
        }
    }
}