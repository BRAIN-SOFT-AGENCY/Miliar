<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Translator;
use App\Models\Category;
use App\Models\Bookspart;
use App\Models\etudespart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TranslatorController extends Controller
{
    public function index()
    {
        // echo 'translator';
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
        $toobooks = Book::where('status', 0)->where('type', 1)->where('translatorID', Auth::guard('translator')->user()->translatorID)->take(2)->whereDate('books.PublierLe', '<=', now())->orderBy('booksID', 'desc')->get();
        $translators = Translator::withCount('books')->where('translator.translatorStatus', 1)->orderBy('books_count', 'desc')->take(9)->get();
        $allbooks = Book::where('status', 0)->where('translatorID', Auth::guard('translator')->user()->translatorID)->take(4)->whereDate('books.PublierLe', '<=', now())->orderBy('booksID', 'desc')->get();

        return view('translator.pages.index', compact('etudes', 'cours', 'books', 'toobooks', 'translators', 'allbooks'));
    }
    public function article()
    {
        $books = Book::where('status', -3)->where('type', 0)->where('translatorID', Auth::guard('translator')->user()->translatorID)->orderBy('booksID', 'desc')->get();

        return view('translator.pages.article', compact('books'));
    }
    public function books()
    {
        $books = Book::where('status', -3)->where('type', 1)->where('translatorID', Auth::guard('translator')->user()->translatorID)->orderBy('booksID', 'desc')->get();

        return view('translator.pages.books', compact('books'));
    }
    public function etudes()
    {
        $books = Book::where('status', -3)->where('type', 2)->where('translatorID', Auth::guard('translator')->user()->translatorID)->orderBy('booksID', 'desc')->get();
        //echo print_r($books);die();
        return view('translator.pages.etudes', compact('books'));
    }
    public function addEtudes()
    {
        //$books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.addEtudes', compact('translators', 'categories'));
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

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('includesAdmin/img/books');

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

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('translator.pages.etudes')->with('success', 'etudes ajouté avec succès !');
    }
    public function deleteEtudes($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();

        return redirect()->route('translator.pages.etudes')
            ->with('success', 'تم حذف الدراسات بنجاح');
    }
    public function addbooks()
    {
        $books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.addbooks', compact('books', 'translators', 'categories'));
    }

    public function storeBooks(Request $request)
    {
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

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('includesAdmin/img/books');

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
        // Upload PDF dans includesAdmin/pdf/books
        if ($request->hasFile('pdf_file')) {
            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('includesAdmin/pdf/books/'), $filename);
            $data['pdf_file'] = $filename;
        } else {
            $data['pdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['PublierLe'] = now()->toDateString(); // yyyy-mm-dd

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('translator.pages.books')->with('success', 'Livre ajouté avec succès !');
    }

    public function deleteBooks($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();

        return redirect()->route('translator.pages.books')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }

    public function addArticle()
    {
        $books = Book::orderBy('booksID', 'desc')->get();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.addArticle', compact('books', 'translators', 'categories'));
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

        ]);

        // Upload image
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');

            $filename = time() . '_' . $file->getClientOriginalName();

            // chemin vers ton dossier cible
            $destinationPath = public_path('includesAdmin/img/books');

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

        Book::create($data);

        // Redirection vers la page des livres
        return redirect()->route('translator.pages.article')->with('success', 'article ajouté avec succès !');
    }
    public function deleteArticle($id)
    {
        $book = Book::findOrFail($id);

        // supprimer image
        if ($book->Image != 'default.jpg') {
            $imagePath = public_path('includesAdmin/img/books/' . $book->Image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if ($book->pdf_file) {
            $pdfPath = public_path('includesAdmin/pdf/books/' . $book->pdf_file);
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $book->delete();

        return redirect()->route('translator.pages.article')
            ->with('success', 'تم حذف الكتاب بنجاح');
    }
    public function booksPart($id)
    {
        // echo $id;die();
        $Bookspart = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'bookspart.booksID', '=', 'books.booksID')
            ->where('bookspart.booksID', $id)
            ->orderBy('booksPartID', 'desc')

            ->get();
        $booksID = $id;
        //    echo $Bookspart;die();
        return view('translator.pages.booksPart', compact('Bookspart', 'booksID'));
    }
    public function addbookspart($id)
    {
        $booksID = $id;

        //echo $booksID;
        //die();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.addbookspart', compact('booksID', 'translators', 'categories'));
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
            $destinationPath = public_path('includesAdmin/img/books');

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
        // Upload PDF dans includesAdmin/pdf/books
        if ($request->hasFile('bookspartpdf_file')) {
            $file = $request->file('bookspartpdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('includesAdmin/pdf/books/'), $filename);
            $data['bookspartpdf_file'] = $filename;
        } else {
            $data['bookspartpdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['bookspartPublierLe'] = now()->toDateString(); // yyyy-mm-dd

        Bookspart::create($data);

        // Redirection vers la page des livres
        return redirect()->route('translator.pages.booksPart', ['id' => $data['booksID']]);
    }









    public function destroy($id)
    {
        $Bookspart = Bookspart::findOrFail($id);

        // supprimer image
        if (!empty($Bookspart->booksPartImage) && $Bookspart->booksPartImage !== 'default.jpg') {
            $imagePath = public_path('includesAdmin/img/books/' . $Bookspart->booksPartImage);

            if (is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        // supprimer pdf
        if (!empty($Bookspart->bookspartpdf_file) && $Bookspart->bookspartpdf_file !== 'test.pdf') {
            $pdfPath = public_path('includesAdmin/pdf/books/' . $Bookspart->bookspartpdf_file);

            if (is_file($pdfPath)) {
                unlink($pdfPath);
            }
        }

        $Bookspart->delete();
        return redirect()->route('translator.pages.booksPart', ['id' => $Bookspart->booksID]);

    }
    public function editArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.editArticle', compact('book', 'translators', 'categories'));
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
            'translatorID' => 'required|exists:translator,translatorID',
            'type' => 'required',
            'article' => 'nullable',
            'status' => 'required',
            'isbanner' => 'required',
        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);

        return redirect()->route('translator.pages.article')
            ->with('success', 'Livre modifié avec succès');
    }
    public function viewArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.viewArticle', compact('book', 'translators', 'categories'));
    }
    public function editEtudes($id)
    {//echo'hiiii';die();
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.editEtudes', compact('book', 'translators', 'categories'));
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
        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);

        return redirect()->route('translator.pages.etudes')
            ->with('success', 'Livre modifié avec succès');
    }
    public function viewEtudes($id)
    {//echo'hiiii';die();
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.viewEtudes', compact('book', 'translators', 'categories'));
    }
    public function editBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.editBooks', compact('book', 'translators', 'categories'));
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
        ]);

        // IMAGE
        if ($request->hasFile('Image')) {

            $file = $request->file('Image');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/img/books/'), $filename);

            $data['Image'] = $filename;

        } else {

            // garder ancienne image
            $data['Image'] = $book->Image;
        }

        // PDF
        if ($request->hasFile('pdf_file')) {

            $file = $request->file('pdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('includesAdmin/pdf/books/'), $filename);

            $data['pdf_file'] = $filename;

        } else {

            // garder ancien pdf
            $data['pdf_file'] = $book->pdf_file;
        }

        $book->update($data);

        return redirect()->route('translator.pages.books')
            ->with('success', 'Livre modifié avec succès');
    }
    public function viewBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.viewBooks', compact('book', 'translators', 'categories'));
    }



    /******etudesPart ******/

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
        return view('translator.pages.etudesPart', compact('etudesPart', 'booksID'));
    }
    public function addetudesPart($id)
    {
        $booksID = $id;

        //echo $booksID;
        //die();

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('translator.pages.addetudesPart', compact('booksID', 'translators', 'categories'));
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

            $destinationPath = public_path('includesAdmin/img/books');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $filename);

            $data['etudespartImage'] = $filename;

        } else {
            $data['etudespartImage'] = 'default.jpg';
        }
        // Upload PDF
        // Upload PDF dans includesAdmin/pdf/books
        if ($request->hasFile('etudesPartpdf_file')) {
            $file = $request->file('etudesPartpdf_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('includesAdmin/pdf/etudesPart/'), $filename);
            $data['etudesPartpdf_file'] = $filename;
        } else {
            $data['etudesPartpdf_file'] = 'test.pdf';
        }

        // Ajouter la date de publication automatiquement
        $data['etudespartPublierLe'] = now()->toDateString(); // yyyy-mm-dd

        etudespart::create($data);

        // Redirection vers la page des livres
        return redirect()->route('translator.pages.etudesPart', ['id' => $data['booksID']]);
    }
    public function deleteEtudesPart($id)
    {
        $etudespart = etudespart::findOrFail($id);

        // supprimer image
        if ($etudespart->etudespartImage != 'default.jpg') {
            $imagePath = public_path('includesAdmin/img/books/' . $etudespart->etudespartImage);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }


        $etudespart->delete();
        return redirect()->route('translator.pages.etudesPart', ['id' => $etudespart->booksID]);
    }



    public function viewetudesPart($id)
    {
        $etudesPart = EtudesPart::findOrFail($id);
        // Vérifier que le translator connecté est bien le propriétaire (optionnel)
        if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
        }
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        //echo  $etudesPart;die();
        return view('translator.pages.viewetudesPart', compact('etudesPart', 'categories'));
    }

    public function editetudesPart($id)
    {
        $etudesPart = EtudesPart::findOrFail($id);
        // Vérifier que le translator connecté est bien le propriétaire (optionnel)
        if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
        }
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();
        //echo  $etudesPart;die();
        return view('translator.pages.editetudesPart', compact('etudesPart', 'categories'));
    }

    public function updateetudesPart(Request $request, $id)
    {
        $etudesPart = EtudesPart::findOrFail($id);

        // Sécurité
        if ($etudesPart->translatorID != Auth::guard('translator')->user()->translatorID) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette étude.');
        }

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
        $etudesPart->translatorID = Auth::guard('translator')->user()->translatorID;
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

            $destinationPath = public_path('includesAdmin/img/books');

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

        return redirect()->route('translator.pages.etudesPart', $etudesPart->booksID)
            ->with('success', 'تم تحديث جزء الدراسة بنجاح.');
    }

    public function viewbookspart($id)
    {
        $bookspart = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'bookspart.booksID', '=', 'books.booksID')
            ->where('bookspart.booksPartID', $id)
            ->first();

        return view('translator.pages.viewbookspart', compact('bookspart'));
    }
    public function editbookspart($id)
    {
        $bookspart = Bookspart::where('booksPartID', $id)->first();

        $categories = Category::select('categoryID', 'categoryName')->get();
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();

        return view('translator.pages.editbookspart', compact('bookspart', 'categories', 'translators'));
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
            $destinationPath = public_path('includesAdmin/img/books');

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
            $file->move(public_path('includesAdmin/pdf/books/'), $filename);
            $data['bookspartpdf_file'] = $filename;
        }

        $bookspart->update($data);

        return redirect()->route('translator.pages.booksPart', [
            'id' => $bookspart->booksID
        ]);
    }


    public function translatorByID()
    {
        $translator = translator::where(
            'translatorID',
            Auth::guard('translator')->user()->translatorID
        )->first();

        return view('translator.pages.translatorByID', compact('translator'));
    }
    public function updatepwd()
    {
        $translator = translator::where(
            'translatorID',
            Auth::guard('translator')->user()->translatorID
        )->first();
        return view('translator.pages.updatepwd', compact('translator'));
    }




    public function updatepwdStore(Request $request)
    {

        $request->validate(
            [

                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',

            ],
            [
                'old_password.required' => 'الرجاء إدخال كلمة المرور الحالية',
                'password.required' => 'الرجاء إدخال كلمة المرور الجديدة',
                'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
                'password.min' => 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',

            ]
        );



        // récupérer le translator connecté

        $translator = translator::where(
            'translatorID',
            Auth::guard('translator')->user()->translatorID
        )->first();



        // vérifier l'ancien password

        if (!Hash::check($request->old_password, $translator->translatorPWD)) {

            return redirect()
                ->back()
                ->withErrors([
                    'old_password' => 'كلمة المرور الحالية غير صحيحة، يرجى التحقق من كلمة المرور القديمة'
                ])
                ->withInput();

        }



        // enregistrer le nouveau password

        $translator->translatorPWD = Hash::make($request->password);

        $translator->save();
        return back()
            ->with('success', 'تم تحديث كلمة المرور الخاصة بك بنجاح');
    }

    public function publish($id)
    {
        $book = Book::findOrFail($id);

        $book->status = -1;
        $book->save();
        if ($book->type == 1) {
            return redirect()->route('translator.pages.books')
                ->with('success', 'تم نشر الكتاب بنجاح');
        } else if ($book->type == 0) {
            return redirect()->route('translator.pages.article')
                ->with('success', 'تم نشر المقال بنجاح');
        } else if ($book->type == 2) {
            return redirect()->route('translator.pages.etudes')
                ->with('success', 'تم نشر الدراسة بنجاح');
        }
    }



}