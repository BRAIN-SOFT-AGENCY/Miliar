@extends('translator.layouts.app')

@section('content')
<div class="content-wrapper">

    <script>
      // ===== compteur de mots (défini en tout premier, avant tout usage) =====
      let wordCounts = {
        Titre: 0,
        article: 0,
        ResumeLivre: 0
      };

      function countWords(text) {
        text = (text || '').trim();

        if (!text) return 0;

        // حذف HTML
        text = text.replace(/<[^>]*>/g, ' ');

        // تحويل HTML entities الشائعة إلى مسافات
        text = text.replace(/&nbsp;|&#160;/gi, ' ');

        // حذف علامات الترقيم العربية والإنجليزية
        text = text.replace(/[.,،؛;:!?؟…"“”"'()\[\]{}<>«»\/\\|ـ_-]+/g, ' ');

        // تقسيم النص حسب المسافات والأسطر
        return text
          .split(/\s+/u)
          .filter(word => word.length > 0)
          .length;
      }

      function updateWordCount(fieldKey, elementId, text) {
        let count = countWords(text);
        wordCounts[fieldKey] = count;
        let el = document.getElementById(elementId);
        if (el) el.innerText = 'عدد الكلمات هو: ' + count;
        updateTotalWordCount();
      }

      function updateTotalWordCount() {
        let total = wordCounts.Titre + wordCounts.article + wordCounts.ResumeLivre;
        let el = document.getElementById('totalWordCount');
        if (el) el.innerText = 'عدد الكلمات الإجمالي في هذه الصفحة هو: ' + total;

        let hiddenEl = document.getElementById('nbremots'); // 🔥 mise à jour du champ hidden
        if (hiddenEl) hiddenEl.value = total;
      }
    </script>

    <section class="content-header">
        <h1><small> </small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-edit"></i> تعديل جزء الدراسة
                        </h3>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('translator.etudes.updateetudesPart', $etudesPart->etudespartID) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="box-body">
                            <div class="row">
                                <!-- Image -->
                                <div class="col-md-4 text-center">
                                    <label>صورة الدراسة</label>
                                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">
                                        <img id="previewImage" 
                                             src="{{ asset('includesAdmin/img/books/'.$etudesPart->etudespartImage ?? 'includesAdmin/img/books/default.jpg') }}" 
                                             style="width:150px;height:150px;margin-bottom:10px">
                                        <input type="file" name="etudespartImage" class="form-control" onchange="preview(event)"      accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/jpeg,image/png,image/gif,image/webp,image/avif">
                                        <small class="text-muted">اتركه فارغاً إذا لم ترغب في تغيير الصورة</small>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>عنوان الدراسة</label>
                                        <input type="hidden" name="booksID" value="{{ $etudesPart->booksID }}" required>
                                        <input type="text" name="etudespartTitre" id="etudespartTitre" class="form-control" 
                                               value="{{ old('etudespartTitre', $etudesPart->etudespartTitre) }}" required
                                               oninput="updateWordCount('Titre', 'TitreWordCount', this.value)">
                                        <small id="TitreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                                    </div>

                                    <div class="form-group">
                                        <label>القسم</label>
                                        <select name="categoryID" class="form-control" required>
                                            <option value="">-- اختر القسم --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->categoryID }}" 
                                                    {{ old('categoryID', $etudesPart->categoryID) == $category->categoryID ? 'selected' : '' }}>
                                                    {{ $category->categoryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- translatorID caché -->
                                    <input type="hidden" name="translatorID" value="{{ Auth::guard('translator')->user()->translatorID }}">

                                    <div class="form-group">
                                        <label>اسم المؤلف</label>
                                        <input type="text" name="etudespartNomAuteur" class="form-control" 
                                               value="{{ old('etudespartNomAuteur', $etudesPart->etudespartNomAuteur) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>المصدر</label>
                                        <input type="text" name="etudespartMaisonEdition" class="form-control" 
                                               value="{{ old('etudespartMaisonEdition', $etudesPart->etudespartMaisonEdition) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>تاريخ الإصدار</label>
                                        <input type="date" name="etudespartDateSortie" class="form-control" 
                                               value="{{ old('etudespartDateSortie', $etudesPart->etudespartDateSortie) }}" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Article (CKEditor) -->
                            <div class="form-group">
                                <label>الدراسة</label>
                                <textarea id="editor" name="etudespartarticle">{{ old('etudespartarticle', $etudesPart->etudespartarticle) }}</textarea>
                                <small id="articleWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                            </div>

                            <!-- Bouton IA -->
                            <button type="button" id="generateSummary" class="btn btn-primary">
                                توليد ملخص بالذكاء الاصطناعي
                            </button>

                            <!-- Scripts CKEditor + IA -->
                            <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
                            <script>
                                let editorInstance;
                                ClassicEditor.create(document.querySelector('#editor'), {
                                    language: 'ar',
                                }).then(editor => {
                                    editorInstance = editor;
                                    editor.editing.view.change(writer => {
                                        writer.setAttribute('dir', 'rtl', editor.editing.view.document.getRoot());
                                    });

                                    // compteur initial (les fonctions sont déjà définies en haut de la page)
                                    try {
                                        let initialText = editor.getData().replace(/<[^>]*>/g, ' ');
                                        updateWordCount('article', 'articleWordCount', initialText);
                                    } catch (e) {
                                        console.error('Erreur compteur initial CKEditor:', e);
                                    }

                                    // mise à jour en direct à chaque modification
                                    editor.model.document.on('change:data', () => {
                                        let plainText = editor.getData().replace(/<[^>]*>/g, ' ');
                                        updateWordCount('article', 'articleWordCount', plainText);
                                    });

                                }).catch(error => {
                                    console.error('Erreur initialisation CKEditor:', error);
                                });

                                document.getElementById('generateSummary').addEventListener('click', function () {
                                    let btn = this;
                                    let articleContent = editorInstance.getData();
                                    if (!articleContent.trim()) {
                                        alert('الرجاء إدخال المقال');
                                        return;
                                    }
                                    btn.disabled = true;
                                    btn.innerHTML = 'جاري التوليد...';

                                    fetch("{{ url('/generate-summary') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'Accept': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: JSON.stringify({ article: articleContent })
                                    })
                                    .then(async response => {
                                        let text = await response.text();
                                        let data;
                                        try {
                                            data = JSON.parse(text);
                                        } catch (e) {
                                            console.error("Server returned HTML instead of JSON:");
                                            console.log(text);
                                            throw new Error("Erreur serveur (HTML reçu au lieu de JSON)");
                                        }
                                        if (!response.ok) {
                                            throw new Error(data.error || 'Erreur IA');
                                        }
                                        return data;
                                    })
                                    .then(data => {
                                        document.getElementById('etudespartResumeLivre').value = data.summary;
                                        updateWordCount('ResumeLivre', 'ResumeLivreWordCount', data.summary);
                                    })
                                    .catch(error => {
                                        console.error(error);
                                        alert(error.message);
                                    })
                                    .finally(() => {
                                        btn.disabled = false;
                                        btn.innerHTML = 'توليد ملخص بالذكاء الاصطناعي';
                                    });
                                });
                            </script>

                            <style>
                                .ck-editor__editable {
                                    min-height: 300px;
                                    direction: rtl !important;
                                    text-align: right !important;
                                }
                            </style>

                            <!-- Résumé -->
                            <div class="form-group">
                                <label>ملخص الدراسة</label>
                                <textarea id="etudespartResumeLivre" name="etudespartResumeLivre" rows="4" class="form-control" required
                                    oninput="updateWordCount('ResumeLivre', 'ResumeLivreWordCount', this.value)">{{ old('etudespartResumeLivre', $etudesPart->etudespartResumeLivre) }}</textarea>
                                <small id="ResumeLivreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                            </div>
                        </div>

                        <div class="box-footer text-center">
                            <input type="text" name="nbremots" id="nbremots" value="0">

                            <div class="alert alert-info" style="font-weight:bold">
                                <span id="totalWordCount">عدد الكلمات الإجمالي في هذه الصفحة هو: 0</span>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-save"></i> حفظ المسودة  
                            </button>
                            <a href="{{ route('translator.pages.etudesPart',$etudesPart->booksID) }}" class="btn btn-default btn-lg">
                                <i class="fa fa-arrow-right"></i> رجوع
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function preview(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('previewImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // ===== initialisation au chargement (champs déjà remplis en update) =====
    document.addEventListener('DOMContentLoaded', function () {
        updateWordCount('Titre', 'TitreWordCount', document.getElementById('etudespartTitre').value);
        updateWordCount('ResumeLivre', 'ResumeLivreWordCount', document.getElementById('etudespartResumeLivre').value);
        // "article" (CKEditor) est initialisé dans le .then() de ClassicEditor.create
    });
</script>
@endsection

@section('scripts')
@endsection