<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Translator;
use App\Models\Category;
use App\Models\etudespart;
use App\Models\Bookspart;

class EditorController extends Controller
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
        $toobooks = Book::where('status', -1)->where('type', 1)->take(2)->whereDate('books.PublierLe', '<=', now())->orderBy('booksID', 'desc')->get();
        $translators = Translator::withCount('books')->where('translator.translatorStatus', 1)->orderBy('books_count', 'desc')->take(9)->get();
        $allbooks = Book::where('status', -1)->take(4)->whereDate('books.PublierLe', '<=', now())->orderBy('booksID', 'desc')->get();

        return view('editor.pages.index', compact('etudes', 'cours', 'books', 'toobooks', 'translators', 'allbooks'));
    }
    public function bookseditor()
    {

        $books = Book::where('status', -1)->where('type', 1)
            ->orderBy('booksID', 'desc')
            ->get();
        //echo '<pre>';
        //print_r($books);
        //die();
        return view('editor.pages.bookseditor', compact('books'));
    }
    public function articleeditor()
    {

        $books = Book::join('translator', 'books.translatorID', '=', 'translator.translatorID')
            ->where('status', -1)->where('type', 0)
            ->orderBy('booksID', 'desc')
            ->get();
        //echo '<pre>';
        //print_r($books);
        //die();
        return view('editor.pages.articleeditor', compact('books'));
    }
    public function editBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.editBooks', compact('book', 'translators', 'categories'));
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

        return redirect()->route('editor.pages.bookseditor')
            ->with('success', 'Livre modifié avec succès');
    }

    public function editArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.editArticle', compact('book', 'translators', 'categories'));
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

        return redirect()->route('editor.pages.articleeditor')
            ->with('success', 'Livre modifié avec succès');
    }

    public function etudeseditor()
    {

        $books = Book::where('status', -1)->where('type', 2)
            ->orderBy('booksID', 'desc')
            ->get();
        //echo '<pre>';
        //print_r($books);
        //die();
        return view('editor.pages.etudeseditor', compact('books'));
    }
    public function editEtudes($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.editEtudes', compact('book', 'translators', 'categories'));
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

        return redirect()->route('editor.pages.etudeseditor')
            ->with('success', 'Livre modifié avec succès');
    }
    public function viewArticle($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.viewArticle', compact('book', 'translators', 'categories'));
    }
    public function viewEtudes($id)
    {//echo'hiiii';die();
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.viewEtudes', compact('book', 'translators', 'categories'));
    }
    public function viewBooks($id)
    {
        $book = Book::findOrFail($id);

        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();
        $categories = Category::select('categoryID', 'categoryName')->get();

        return view('editor.pages.viewBooks', compact('book', 'translators', 'categories'));
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
        return view('editor.pages.etudesPart', compact('etudesPart', 'booksID'));
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
        return view('editor.pages.viewetudesPart', compact('etudesPart', 'categories'));
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
        return view('editor.pages.editetudesPart', compact('etudesPart', 'categories'));
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

        return redirect()->route('editor.pages.etudesPart', $etudesPart->booksID)
            ->with('success', 'تم تحديث جزء الدراسة بنجاح.');
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
        return view('editor.pages.booksPart', compact('Bookspart', 'booksID'));
    }

    public function viewbookspart($id)
    {
        $bookspart = Bookspart::join('category', 'bookspart.categoryID', '=', 'category.categoryID')
            ->join('translator', 'bookspart.translatorID', '=', 'translator.translatorID')
            ->join('books', 'bookspart.booksID', '=', 'books.booksID')
            ->where('bookspart.booksPartID', $id)
            ->first();

        return view('editor.pages.viewbookspart', compact('bookspart'));
    }
    public function editbookspart($id)
    {
        $bookspart = Bookspart::where('booksPartID', $id)->first();

        $categories = Category::select('categoryID', 'categoryName')->get();
        $translators = Translator::select('translatorID', 'translatorfirstName', 'translatorLastName')->get();

        return view('editor.pages.editbookspart', compact('bookspart', 'categories', 'translators'));
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

        return redirect()->route('editor.pages.booksPart', [
            'id' => $bookspart->booksID
        ]);
    }

    public function publish($id)
    {
        $book = Book::findOrFail($id);

        $book->status = -2; // 👈 هنا التغيير
        $book->save();
        if ($book->type == 1) {
            return redirect()->route('editor.pages.bookseditor')
                ->with('success', 'تم نشر الكتاب بنجاح');
        } else if ($book->type == 0) {
            return redirect()->route('editor.pages.articleeditor')
                ->with('success', 'تم نشر المقال بنجاح');
        } else if ($book->type == 2) {
            return redirect()->route('editor.pages.etudeseditor')
                ->with('success', 'تم نشر الدراسة بنجاح');
        }
        // return redirect()->back()->with('success', 'تم نشر الكتاب بنجاح');
    }



}