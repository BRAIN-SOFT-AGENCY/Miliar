<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\email;
use App\Models\contact;
use App\Models\etudespart;
use App\Models\Bookspart;
use App\Models\Category;
use App\Models\Translator;
use App\Models\Book;
use App\Models\partners;

use Illuminate\Support\Facades\Mail;
class AdminController extends Controller
{

    public function index()
    {
        // echo 'admin';
        // die();
        $books = Book::where('status', 0)
            ->where('type', 1)
            ->whereDate('books.PublierLe', '<=', now())
            ->count();

        $cours = Book::where('status', 0)
            ->where('type', 0)
            ->whereDate('books.PublierLe', '<=', now())
            ->count();

        $etudes = Book::where('status', 0)
            ->where('type', 2)
            ->whereDate('books.PublierLe', '<=', now())
            ->count();
        $translators = Translator::withCount('books')->where('translator.translatorStatus', 1)->orderBy('books_count', 'desc')->take(9)->get();
        $allbooks = Book::where('status', -2)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('booksID', 'desc')
            ->take(4)
            ->get();

        $toobooks = Book::where('status', -2)
            ->where('type', 1)
            ->whereDate('books.PublierLe', '<=', now())
            ->orderBy('booksID', 'desc')
            ->take(4)
            ->get();
        return view('superAdmin.pages.index', compact('etudes', 'cours', 'books', 'toobooks', 'translators', 'allbooks'));
    }
    public function banner()
    {
        $books = Book::where('isbanner', 1)->orderBy('booksID', 'desc')->get();
        $countBooks = Book::where('isbanner', 1)->count();
        // echo $countBooks;die();
        return view('superAdmin.pages.banner', compact('books', 'countBooks'));
    }
    public function deletebanner($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('../includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();

        return redirect()->route('superAdmin.pages.banner')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }

    public function addbanner()
    {
        //$books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        //echo $translators;        die();
        return view('superAdmin.pages.addbanner', compact('translators', 'categories'));
    }
    public function storebanner(Request $request)
    {
        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'article' => 'nullable',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['Image'] = $filename;

        } else {
            $data['Image'] = 'default.jpg';
        }
        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd
        $data['nbViews'] = 0;

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.banner')->with('success', 'article ajouté avec succès !');
    }
    public function books()
    {
        //$books = Book::orderBy('booksID', 'desc')->where('books.status', -2)->get();

        return view('superAdmin.pages.books', compact('books'));
    }
    public function article()
    {
        $books = Book::orderBy('booksID', 'desc')->where('books.status', -2)->where('books.type', 0)
            ->get();

        return view('superAdmin.pages.article', compact('books'));
    }
    public function deletebooks($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('../includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();
        if ($book->type == 1) {
            return redirect()->route('superAdmin.pages.books')
                ->with('success', 'تم حذف الكتاب بنجاح');
        } else if ($book->type == 0) {
            return redirect()->route('superAdmin.pages.article')
                ->with('success', 'تم حذف المقال بنجاح');
        } else if ($book->type == 2) {
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'تم حذف الدراسة بنجاح');
        }

    }

    /* public function publish($id)
     {
         $book = Book::findOrFail($id);

         $book->status = 0; // 👈 هنا التغيير
         $book->save();
         if ($book->type == 1) {
             return redirect()->route('superAdmin.pages.books')
                 ->with('success', 'تم نشر الكتاب بنجاح');
         } else if ($book->type == 0) {
             return redirect()->route('superAdmin.pages.article')
                 ->with('success', 'تم نشر المقال بنجاح');
         } else if ($book->type == 2) {
             return redirect()->route('superAdmin.pages.etudes')
                 ->with('success', 'تم نشر الدراسة بنجاح');
         }
         // return redirect()->back()->with('success', 'تم نشر الكتاب بنجاح');
     }*/
    public function publish(Request $request, $id)
    {
        $request->validate([
            'PublierLe' => 'required|date',
        ]);

        $book = Book::findOrFail($id);

        $book->status = 0;
        //$book->PublierLe = $request->PublierLe; // mise à jour de la date
        $book->update([
            'PublierLe' => date('Y-m-d H:i:s', strtotime($request->PublierLe))
        ]);
        $book->save();

        if ($book->type == 1) {
            return redirect()->route('superAdmin.pages.books')
                ->with('success', 'تم نشر الكتاب بنجاح');
        }

        if ($book->type == 0) {
            return redirect()->route('superAdmin.pages.article')
                ->with('success', 'تم نشر المقال بنجاح');
        }

        if ($book->type == 2) {
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'تم نشر الدراسة بنجاح');
        }

        return redirect()->back()->with('success', 'تم النشر بنجاح');
    }
    public function etudes()
    {
        $books = Book::orderBy('booksID', 'desc')->where('books.status', -2)->where('books.type', 2)
            ->get();

        return view('superAdmin.pages.etudes', compact('books'));
    }
    public function category()
    {//echo 'hii';die();
        $category = category::orderBy('categoryID', 'desc')->get();

        return view('superAdmin.pages.category', compact('category'));
    }
    public function addcategory()
    {
        return view('superAdmin.pages.addcategory');
    }
    public function storecategory(Request $request)
    {
        $data = $request->validate([
            'categoryName' => 'required',
            'parent' => 'required',
            'icon' => 'required',
        ]);
        Category::create($data);

        // Redirection vers la page des category
        return redirect()->route('superAdmin.pages.category')->with('success', 'category ajouté avec succès !');
    }
    public function deletecategory($id)
    {
        $categorys = category::findOrFail($id);

        $categorys->delete();

        return redirect()->route('superAdmin.pages.category')
            ->with('success', 'تم حذف الصنف بنجاح');
    }
    public function addArticle()
    {// echo 'hiii';die();
        // $books = Book::orderBy('booksID', 'desc')->get();
        //echo $books;die();
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        return view('superAdmin.pages.addArticle', compact('translators', 'categories'));

        //  return view('superAdmin.pages.addArticle', compact('books', 'translators', 'categories'));
    }
    public function storeArticle(Request $request)
    {
        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'article' => 'nullable',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',
        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['Image'] = $filename;

        } else {
            $data['Image'] = 'default.jpg';
        }
        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd

        $data['nbViews'] = 0;
        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.article')->with('success', 'article ajouté avec succès !');
    }


    public function addbooks()
    {
        // $books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        return view('superAdmin.pages.addbooks', compact('translators', 'categories'));

        // return view('superAdmin.pages.addbooks', compact('books', 'translators', 'categories'));
    }

    public function storeBooks(Request $request)
    {
        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'required',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'pdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'article' => 'nullable',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['Image'] = $filename;

        } else {
            $data['Image'] = 'default.jpg';
        }
        // Upload PDF
        // Upload PDF dans ../includesAdmin/pdf/books
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);
            $data['pdf_file'] = $filename;
        } else {
            $data['pdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd
        $data['nbViews'] = 0;

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.books')->with('success', 'Livre ajouté avec succès !');
    }


    public function addEtudes()
    {
        //$books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        return view('superAdmin.pages.addEtudes', compact('translators', 'categories'));

        // return view('superAdmin.pages.addEtudes', compact('books', 'translators', 'categories'));
    }
    public function storeEtudes(Request $request)
    {
        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'article' => 'nullable',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',
        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['Image'] = $filename;

        } else {
            $data['Image'] = 'default.jpg';
        }
        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd
        $data['nbViews'] = 0;

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.etudes')->with('success', 'etudes ajouté avec succès !');
    }
    public function listePublier()
    {
        $listePublier = Book::orderBy('booksID', 'desc')->where('books.status', 0)
            ->get();

        return view('superAdmin.pages.listePublier', compact('listePublier'));
    }
    public function editlistePublier($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.editEtudes', compact('book', 'translators', 'categories'));
    }

    /*   public function allBooks()
       {
           //$books = Book::orderBy('booksID', 'desc')->where('books.status', 0)
           //  ->get();
           $books = Book::where('status', 0)

               ->orderBy('booksID', 'desc')

               ->select([

                   'booksID',

                   'Image',

                   'Titre',

                   'ResumeLivre',

                   'pdf_file',
                   'categoryID',
                   'translatorID',
                   'type',
                   'isbanner',
               ])

               ->cursor();
           $countBooks = Book::where('isbanner', 1)->count();

           return view('superAdmin.pages.allBooks', compact('books', 'countBooks'));
       }*/

    public function allBooks()
    {
        $books = Book::where('status', 0)
            ->orderBy('booksID', 'desc')
            ->select([
                'booksID',
                'Image',
                'Titre',
                'ResumeLivre',
                'pdf_file',
                'categoryID',
                'translatorID',
                'type',
                'isbanner',
                'conversation',
                'selection',
            ])
            ->with(['category', 'translator'])
            ->get();

        $countBooks = Book::where('isbanner', 1)->count();
        $countconversation = Book::where('conversation', 1)->count();
        $countselection = Book::where('selection', 1)->count();

        return view('superAdmin.pages.allBooks', compact('books', 'countBooks', 'countconversation', 'countselection'));
    }

    public function toggleBookOption(Request $request)
    {
        $book = Book::find($request->booksID);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'الكتاب غير موجود'
            ], 404);
        }

        $field = $request->field;
        $value = (int) $request->value;

        // Les seuls champs autorisés
        $allowedFields = [
            'isbanner',
            'conversation',
            'selection'
        ];

        if (!in_array($field, $allowedFields)) {
            return response()->json([
                'success' => false,
                'message' => 'الحقل غير صالح'
            ], 400);
        }

        /*
         * Limite du banner = 5
         */
        if ($field == 'isbanner' && $value == 1) {

            $countBooks = Book::where('isbanner', 1)->count();

            if ($countBooks >= 5) {

                return response()->json([
                    'success' => false,
                    'limit' => true,
                    'field' => $field,
                    'message' => 'لقد قمت بإضافة 5 بانرات بالفعل، وهذا هو الحد الأقصى. يرجى حذف أحد البانرات أولاً حتى تتمكن من إضافة بانر جديد.'
                ]);
            }
        }

        /*
         * Limite conversation = 5
         */
        if ($field == 'conversation' && $value == 1) {

            $countconversation = Book::where('conversation', 1)->count();

            if ($countconversation >= 5) {

                return response()->json([
                    'success' => false,
                    'limit' => true,
                    'field' => $field,
                    'message' => 'لقد قمت بإضافة 5 كتب للمحادثة بالفعل، وهذا هو الحد الأقصى. يرجى إلغاء أحدها أولاً حتى تتمكن من إضافة كتاب جديد.'
                ]);
            }
        }

        /*
         * Limite selection = 5
         */
        if ($field == 'selection' && $value == 1) {

            $countselection = Book::where('selection', 1)->count();

            if ($countselection >= 5) {

                return response()->json([
                    'success' => false,
                    'limit' => true,
                    'field' => $field,
                    'message' => 'لقد قمت بإضافة 5 كتب للاختيار بالفعل، وهذا هو الحد الأقصى. يرجى إلغاء أحدها أولاً حتى تتمكن من إضافة كتاب جديد.'
                ]);
            }
        }

        // Modifier uniquement le champ demandé
        $book->$field = $value;
        $book->save();

        // Compteurs
        $countBooks = Book::where('isbanner', 1)->count();
        $countconversation = Book::where('conversation', 1)->count();
        $countselection = Book::where('selection', 1)->count();

        return response()->json([
            'success' => true,
            'field' => $field,
            'value' => $value,
            'countBooks' => $countBooks,
            'countconversation' => $countconversation,
            'countselection' => $countselection
        ]);
    }
    public function deleteallbooks($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('../includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();
        return redirect()->route('superAdmin.pages.allBooks')
            ->with('success', 'Livre supprimé avec succès');


    }




    public function booksPart($id)
    {
        // echo $id;die();
        $Bookspart = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'bookspart.booksID', '=', 'books.booksID')
            ->orderBy('booksPartID', 'desc')
            ->where('bookspart.booksID', $id)
            ->get();
        $booksID = $id;
        //    echo $Bookspart;die();
        return view('superAdmin.pages.booksPart', compact('Bookspart', 'booksID'));
    }
    public function addbookspart($id)
    {
        $booksID = $id;

        //echo $booksID;
        //die();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.addbookspart', compact('booksID', 'translators', 'categories'));
    }
    public function storebookspart(Request $request)
    {
        $data = $request->validate([
            'booksPartTitre' => 'required',
            'booksPartNomAuteur' => 'nullable',
            'bookspartMaisonEdition' => 'nullable',
            'bookspartDateSortie' => 'nullable|date',
            'bookspartVersionImprimable' => 'nullable',
            'bookspartResumeLivre' => 'nullable',
            'bookpartarticle' => 'nullable',

            'booksPartImage' => 'nullable|image|mimes:jpg,jpeg,png',
            'bookspartpdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'booksID' => 'required',

        ]);
        /* echo "<pre>";
         print_r($data);
         echo "<pre>";

         die();*/
        // Upload booksPartImage
        if ($request->hasFile('booksPartImage')) {

            $file = $request->file('booksPartImage');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['booksPartImage'] = $filename;

        } else {
            $data['booksPartImage'] = 'default.jpg';
        }
        // Upload PDF
        // Upload PDF dans ../includesAdmin/pdf/books
        if ($request->hasFile('bookspartpdf_file')) {
            $file = $request->file('bookspartpdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);
            $data['bookspartpdf_file'] = $filename;
        } else {
            $data['bookspartpdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['bookspartPublierLe'] = now()->toDateString(); // yyyy-mm-dd

        Bookspart::create($data);

        // Redirection vers la page des livres

        return redirect()->route('superAdmin.pages.booksPart', ['id' => $data['booksID']]);
    }


    public function bannerByCategory($id)
    {
        $books = Book::where('categoryID', $id)->where('isbanner', 2)->orderBy('booksID', 'desc')->get();
        $countBooks = Book::where('categoryID', $id)->where('isbanner', 2)->count();
        $categoryID = $id;

        // echo $countBooks;die();
        return view('superAdmin.pages.bannerByCategory', compact('books', 'countBooks', 'categoryID'));
    }
    public function deletebannerByCategory($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('../includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();

        return redirect()->route('superAdmin.pages.bannerByCategory', ['id' => $book->categoryID])
            ->with('success', 'تم حذف الكتاب بنجاح');
    }

    public function addbannerByCategory($id)
    {
        $books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        $categoryID = $id;
        //echo $translators;        die();
        return view('superAdmin.pages.addbannerByCategory', compact('books', 'translators', 'categories', 'categoryID'));
    }
    public function storebannerByCategory(Request $request)
    {
        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'article' => 'nullable',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/books');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['Image'] = $filename;

        } else {
            $data['Image'] = 'default.jpg';
        }
        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd
        $data['nbViews'] = 0;

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.bannerByCategory', ['id' => $data['categoryID']])->with('success', 'article ajouté avec succès !');
    }
    public function viewArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.viewArticle', compact('book', 'translators', 'categories'));
    }
    public function viewEtudes($id)
    {//echo'hiiii';die();
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.viewEtudes', compact('book', 'translators', 'categories'));
    }
    public function viewBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.viewBooks', compact('book', 'translators', 'categories'));
    }



    public function etudesPart($id)
    {
        // echo $id;die();
        $etudesPart = etudespart::join('category', 'etudespart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'etudespart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'etudespart.booksID', '=', 'books.booksID')
            ->where('etudespart.booksID', $id)
            ->orderBy('etudespart.etudespartID', 'desc')

            ->get();
        $booksID = $id;
        //    echo $Bookspart;die();
        return view('superAdmin.pages.etudesPart', compact('etudesPart', 'booksID'));
    }
    public function addetudesPart($id)
    {
        $booksID = $id;

        //echo $booksID;
        //die();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.addetudesPart', compact('booksID', 'translators', 'categories'));
    }
    public function storeetudesPart(Request $request)
    {
        $data = $request->validate([
            'etudespartTitre' => 'required',
            'etudespartNomAuteur' => 'nullable',
            'etudespartMaisonEdition' => 'nullable',
            'etudespartDateSortie' => 'nullable|date',
            'etudespartVersionImprimable' => 'nullable',
            'etudespartResumeLivre' => 'nullable',
            'etudespartImage' => 'nullable|image|mimes:jpg,jpeg,png',
            'etudespartpdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'booksID' => 'required',
            'etudespartarticle' => 'nullable',

        ]);
        /*  echo "<pre>";
          print_r($data);
          echo "<pre>";

          die();*/
        // Upload etudesPartImage
        if ($request->hasFile('etudespartImage')) {

            $file = $request->file('etudespartImage');

            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('../includesAdmin/img/books');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);

            $data['etudespartImage'] = $filename;

        } else {
            $data['etudespartImage'] = 'default.jpg';
        }
        // Upload PDF
        // Upload PDF dans ../includesAdmin/pdf/books
        if ($request->hasFile('etudesPartpdf_file')) {
            $file = $request->file('etudesPartpdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('../includesAdmin/pdf/etudesPart/'), $filename);
            $data['etudesPartpdf_file'] = $filename;
        } else {
            $data['etudesPartpdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['etudespartPublierLe'] = now()->toDateString(); // yyyy-mm-dd

        etudespart::create($data);

        // Redirection vers la page des livres
        return redirect()->route('superAdmin.pages.etudesPart', ['id' => $data['booksID']]);
    }
    public function deleteEtudesPart($id)
    {
        $etudespart = etudespart::findOrFail($id);

        // supprimer image
        if ($etudespart->etudespartImage != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $etudespart->etudespartImage);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }


        $etudespart->delete();
        return redirect()->route('superAdmin.pages.etudesPart', ['id' => $etudespart->booksID]);
    }


    public function viewetudesPart($id)
    {
        $etudesPart = EtudesPart::findOrFail($id);
        // Vérifier que le translator connecté est bien le propriétaire (optionnel)
        /* if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
             abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
         }*/
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        //echo  $etudesPart;die();
        return view('superAdmin.pages.viewetudesPart', compact('etudesPart', 'categories'));
    }
    public function editetudesPart($id)
    {
        $etudesPart = EtudesPart::findOrFail($id);
        // Vérifier que le translator connecté est bien le propriétaire (optionnel)
        /*  if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
              abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
          }*/
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        //echo  $etudesPart;die();
        return view('superAdmin.pages.editetudesPart', compact('etudesPart', 'categories'));
    }

    public function updateetudesPart(Request $request, $id)
    {
        $etudesPart = EtudesPart::findOrFail($id);

        // Sécurité
        /* if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
             abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
         }*/

        // Validation
        $request->validate([
            'etudespartTitre' => 'required|string|max:255',
            'categoryID' => 'required|exists:category,categoryID',
            'etudespartNomAuteur' => 'nullable|string|max:255',
            'etudespartMaisonEdition' => 'nullable|string|max:255',
            'etudespartDateSortie' => 'required|date',
            'etudespartarticle' => 'nullable|string',
            'etudespartResumeLivre' => 'nullable|string',
            'etudespartImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update champs
        $etudesPart->etudespartTitre = $request->etudespartTitre;
        $etudesPart->categoryID = $request->categoryID;
        $etudesPart->translatorID = $request->translatorID;
        $etudesPart->etudespartNomAuteur = $request->etudespartNomAuteur;
        $etudesPart->etudespartMaisonEdition = $request->etudespartMaisonEdition;
        $etudesPart->etudespartDateSortie = $request->etudespartDateSortie;
        $etudesPart->etudespartarticle = $request->etudespartarticle;
        $etudesPart->etudespartResumeLivre = $request->etudespartResumeLivre;

        // =========================
        // IMAGE UPDATE (SAME STYLE AS ADD)
        // =========================
        if ($request->hasFile('etudespartImage')) {

            $file = $request->file('etudespartImage');

            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('../includesAdmin/img/books');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // supprimer ancienne image
            if (
                $etudesPart->etudespartImage &&
                $etudesPart->etudespartImage != 'default.jpg'
            ) {
                $oldImage = $destinationPath . '/' . $etudesPart->etudespartImage;

                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }

            // upload nouvelle image
            $file->move($destinationPath, $filename);

            $etudesPart->etudespartImage = $filename;
        }

        $etudesPart->save();

        return redirect()->route('superAdmin.pages.etudesPart', $etudesPart->booksID)
            ->with('success', 'تم تحديث جزء الدراسة بنجاح.');
    }



    public function viewbookspart($id)
    {
        $bookspart = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'bookspart.booksID', '=', 'books.booksID')
            ->where('bookspart.booksPartID', $id)
            ->first();

        return view('superAdmin.pages.viewbookspart', compact('bookspart'));
    }
    public function editbookspart($id)
    {
        $bookspart = Bookspart::where('booksPartID', $id)->first();

        $categories = Category::select('categoryID', 'categoryName')->get();
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();

        return view('superAdmin.pages.editbookspart', compact('bookspart', 'categories', 'translators'));
    }
    public function updatebookspart(Request $request, $id)
    {
        $bookspart = Bookspart::findOrFail($id);

        $data = $request->validate([
            'booksPartTitre' => 'required',
            'booksPartNomAuteur' => 'nullable',
            'bookspartMaisonEdition' => 'nullable',
            'bookspartDateSortie' => 'nullable|date',
            'bookspartVersionImprimable' => 'nullable',
            'bookspartResumeLivre' => 'nullable',
            'bookpartarticle' => 'nullable',
            'booksPartImage' => 'nullable|image|mimes:jpg,jpeg,png',
            'bookspartpdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
        ]);

        // IMAGE UPDATE
        if ($request->hasFile('booksPartImage')) {
            $file = $request->file('booksPartImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('../includesAdmin/img/books');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);
            $data['booksPartImage'] = $filename;
        }

        // PDF UPDATE
        if ($request->hasFile('bookspartpdf_file')) {
            $file = $request->file('bookspartpdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);
            $data['bookspartpdf_file'] = $filename;
        }

        $bookspart->update($data);

        return redirect()->route('superAdmin.pages.booksPart', [
            'id' => $bookspart->booksID
        ]);
    }

    public function destroy($id)
    {
        $Bookspart = Bookspart::findOrFail($id);

        // supprimer image
        if (!empty($Bookspart->booksPartImage) && $Bookspart->booksPartImage !== 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/books/' . $Bookspart->booksPartImage);

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if (!empty($Bookspart->bookspartpdf_file) && $Bookspart->bookspartpdf_file !== 'test.pdf') {
            $pdfPath = public_path('../includesAdmin/pdf/books/' . $Bookspart->bookspartpdf_file);

            if (is_file($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $Bookspart->delete();
        return redirect()->route('superAdmin.pages.booksPart', ['id' => $Bookspart->booksID]);

    }

    public function editArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.editArticle', compact('book', 'translators', 'categories'));
    }
    public function updateArticle(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'pdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required',
            'type' => 'required',
            'article' => 'nullable',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);
        if ($request['link'] == 1) {
            $books = Book::orderBy('booksID', 'desc')->where('books.status', 0)
                ->get();

            return view('superAdmin.pages.allBooks', compact('books'));
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'Livre modifié avec succès');
        } else {
            return redirect()->route('superAdmin.pages.article')
                ->with('success', 'Livre modifié avec succès');
        }
    }
    public function editEtudes($id)
    {//echo'hiiii';die();
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.editEtudes', compact('book', 'translators', 'categories'));
    }
    public function updateEtudes(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'pdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'article' => 'nullable',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);
        if ($request['link'] == 1) {
            $books = Book::orderBy('booksID', 'desc')->where('books.status', 0)
                ->get();

            return view('superAdmin.pages.allBooks', compact('books'));
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'Livre modifié avec succès');
        } else {
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'Livre modifié avec succès');
        }
    }




    public function editBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('superAdmin.pages.editBooks', compact('book', 'translators', 'categories'));
    }
    public function updateBooks(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'Titre' => 'required',
            'NomAuteur' => 'nullable',
            'MaisonEdition' => 'nullable',
            'DateSortie' => 'nullable|date',
            'VersionImprimable' => 'nullable',
            'ResumeLivre' => 'nullable',
            'Image' => 'nullable|image|mimes:jpg,jpeg,png',
            'pdf_file' => 'nullable|mimes:pdf',
            'categoryID' => 'required|exists:category,categoryID',
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'article' => 'nullable',
            'status' => 'required',
            'isbanner' => 'required',
            'nbViews' => 'nullable',
            'extrait' => 'nullable',

        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('../includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);
        if ($request['link'] == 1) {
            $books = Book::orderBy('booksID', 'desc')->where('books.status', 0)
                ->get();

            return view('superAdmin.pages.allBooks', compact('books'));
            return redirect()->route('superAdmin.pages.etudes')
                ->with('success', 'Livre modifié avec succès');
        } else {
            return redirect()->route('superAdmin.pages.books')
                ->with('success', 'Livre modifié avec succès');
        }
    }

    public function translatorList()
    {
        $Translators = Translator::orderBy('translatorID', 'desc')->get();
        // echo $Translators;die();
        return view('superAdmin.pages.translatorList', compact('Translators'));
    }
    public function addtranslatorList()
    {
        return view('superAdmin.pages.addtranslatorList');
    }
    /*  public function storetranslatorList(Request $request)
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
              $destinationPath = public_path('../includesAdmin/img/translator');

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


          $data['translatorCreated'] = now()->toDateString(); // yyyy-mm-dd
          Translator::create($data);



          if ($request->hasFile('translatorPicture')) {

              $file = $request->file('translatorPicture');

              $filename = time() . '_' . $file->getClientOriginalName();

              // chemin vers ton dossier cible
              $destinationPath = public_path('../includesAdmin/img/part');

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

          if ($data['partner'] == 1) {
              $data1 = $request->validate([
                  'partnersPicture' => 'nullable|image|mimes:jpg,jpeg,png',
              ]);
              partners::create($data1);

          }
          // Email data
          $emailData = [
              'email' => $data['translatorEmail'],
              'password' => '123456',
              'link' => 'https://maxu123.com/miliar/login',
              'name' => $data['translatorfirstName'] . ' ' . $data['translatorLastName']
          ];
          // dd($emailData);

          // Send email
          Mail::send('emails.translator_welcome', $emailData, function ($message) use ($emailData) {
              $message->to($emailData['email'])
                  ->subject('مرحبًا بك في منطقة المترجم الخاصة بك');
          });
          // Redirection vers la page des livres
          return redirect()->route('superAdmin.pages.translatorList')->with('success', 'translator ajouté avec succès !');
      }
  */
    public function storetranslatorList(Request $request)
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


        // =========================
        // Upload image translator
        // =========================

        if ($request->hasFile('translatorPicture')) {

            $file = $request->file('translatorPicture');

            $filename = time() . '_' . $file->getClientOriginalName();

            $destinationPath = public_path('../includesAdmin/img/translator');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);

            $data['translatorPicture'] = $filename;

        } else {

            $data['translatorPicture'] = 'default.jpg';

        }


        // Date création
        $data['translatorCreated'] = now()->toDateString();


        // =========================
        // Ajouter le translator
        // =========================

        Translator::create($data);



        // =========================
        // Si c'est une société
        // =========================

        if ($request->partner == 1) {


            // dossier part
            $partPath = public_path('../includesAdmin/img/part');


            if (!file_exists($partPath)) {
                mkdir($partPath, 0777, true);
            }


            // Copier l'image vers part
            $source = public_path('../includesAdmin/img/translator/' . $data['translatorPicture']);

            $destination = $partPath . '/' . $data['translatorPicture'];


            if (file_exists($source)) {
                copy($source, $destination);
            }


            // insertion partner
            partners::create([
                'partnersPicture' => $data['translatorPicture']
            ]);

        }

        // Email data
        $emailData = [
            'email' => $data['translatorEmail'],
            'password' => '123456',
            'link' => 'https://maxu123.com/miliar/login',
            'name' => $data['translatorfirstName'] . ' ' . $data['translatorLastName']
        ];
        // dd($emailData);

        // Send email
        Mail::send('emails.translator_welcome', $emailData, function ($message) use ($emailData) {
            $message->to($emailData['email'])
                ->subject('مرحبًا بك في منطقة المترجم الخاصة بك');
        });
        return redirect()
            ->route('superAdmin.pages.translatorList')
            ->with('success', 'translator ajouté avec succès !');
    }
    public function deletetranslatorList($id)
    {
        $translator = translator::findOrFail($id);

        // supprimer image
        if ($translator->translatorPicture != 'default.jpg') {
            $imagePath = public_path('../includesAdmin/img/translator/' . $translator->translatorPicture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $translator->delete();
        return redirect()->route('superAdmin.pages.translatorList')
            ->with('success', 'تم حذف المترجم بنجاح');
    }

    public function updatetranslatorList($id)
    {
        $translator = translator::findOrFail($id);

        // Update status
        $translator->translatorStatus = 1;
        $translator->save();


        // Email data
        $emailData = [
            'email' => $translator->translatorEmail,
            'password' => '123456',
            'link' => 'https://maxu123.com/miliar/login',
            'name' => $translator->translatorfirstName . ' ' . $translator->translatorLastName
        ];


        // Send email
        Mail::send('emails.translator_welcome', $emailData, function ($message) use ($emailData) {

            $message->to($emailData['email'])
                ->subject('مرحبًا بك في منطقة المترجم الخاصة بك');

        });

        if ($translator->partner == 1) {


            // dossier part
            $partPath = public_path('../includesAdmin/img/part');


            if (!file_exists($partPath)) {
                mkdir($partPath, 0777, true);
            }


            // Copier l'image vers part
            $source = public_path('../includesAdmin/img/translator/' . $translator->translatorPicture);

            $destination = $partPath . '/' . $translator->translatorPicture;


            if (file_exists($source)) {
                copy($source, $destination);
            }


            // insertion partner
            partners::create([
                'partnersPicture' => $translator->translatorPicture
            ]);

        }

        return redirect()
            ->back()
            ->with('success', 'تم قبول طلب المترجم وإرسال رسالة الترحيب إلى البريد الإلكتروني بنجاح');
    }

    public function contactList()
    {
        $contact = contact::orderBy('contactID', 'desc')->get();

        return view('superAdmin.pages.contactList', compact('contact'));
    }
    public function deleteContact($id)
    {
        try {

            $contact = contact::findOrFail($id);
            $contact->delete();

            return redirect()->back()->with('success', '✅ تم حذف الرسالة بنجاح.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', '❌ حدث خطأ أثناء حذف الرسالة.');
        }
    }
    public function emailList()
    {
        $emailList = email::orderBy('emailID', 'desc')->get();

        return view('superAdmin.pages.emailList', compact('emailList'));

    }
    public function deleteEmail($id)
    {
        try {

            $email = email::findOrFail($id);
            $email->delete();

            return redirect()->back()->with('success', '✅ تم حذف  البريد الالكتروني.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', '❌ حدث خطأ أثناء حذف البريد الالكتروني.');
        }
    }

    public function partnersList()
    {
        $partners = partners::orderBy('partnersID', 'desc')->get();

        return view('superAdmin.pages.partnersList', compact('partners'));
    }
    public function deletePartners($id)
    {
        try {

            $partner = partners::findOrFail($id);
            $partner->delete();

            return redirect()->back()->with('success', '✅ تم حذف   الشريك.');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', '❌ حدث خطأ أثناء حذف  الشريك.');
        }
    }

    public function addpartnersList()
    {
        return view('superAdmin.pages.addpartnersList');
    }
    public function storepartnersList(Request $request)
    {
        $data = $request->validate([
            'partnersPicture' => 'nullable|image|mimes:jpg,jpeg,png',

        ]);

        // Upload image
        if ($request->hasFile('partnersPicture')) {

            $file = $request->file('partnersPicture');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('../includesAdmin/img/part');

            // créer le dossier s'il n'existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // déplacer le fichier
            $file->move($destinationPath, $filename);

            $data['partnersPicture'] = $filename;

        } else {
            $data['partnersPicture'] = 'default.jpg';
        }

        partners::create($data);

        return redirect()->route('superAdmin.partnersList')->with('success', ' الشريك ajouté avec succès !');
    }


}