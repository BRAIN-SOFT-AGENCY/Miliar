@extends('translator.layouts.app')

@section('content')
<div class="content-wrapper">

    <script>
      // ===== compteur de mots =====
      let wordCounts = {
        Titre: 0,
        article: 0,
        ResumeLivre: 0
      };

      function countWords(text) {
        text = (text || '').trim();
        if (!text) return 0;
        text = text.replace(/<[^>]*>/g, ' ');
        text = text.replace(/&nbsp;|&#160;/gi, ' ');
        text = text.replace(/[.,،؛;:!?؟…"“”"'()\[\]{}<>«»\/\\|ـ_-]+/g, ' ');
        return text.split(/\s+/u).filter(word => word.length > 0).length;
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

        let hiddenEl = document.getElementById('nbremots');
        if (hiddenEl) hiddenEl.value = total;
      }
    </script>

    <section class="content-header">
        <h1><small>تعديل جزء الكتاب</small></h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-edit"></i>
                            تعديل جزء الكتاب
                        </h3>
                    </div>

                    <form action="{{ route('translator.bookspart.update', $bookspart->booksPartID) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="box-body">
                            <div class="row">
                                <!-- IMAGE -->
                                <div class="col-md-4 text-center">
                                    <label>صورة الكتاب</label>
                                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">
                                        <img id="previewImage"
                                             src="{{ asset('includesAdmin/img/books/' . $bookspart->booksPartImage) }}"
                                             style="width:150px;height:150px;margin-bottom:10px">
                                        <input type="file"
                                               name="booksPartImage"
                                               class="form-control"
                                               onchange="preview(event)"      accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/jpeg,image/png,image/gif,image/webp,image/avif">
                                    </div>
                                </div>

                                <!-- FORM -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>عنوان الكتاب</label>
                                        <input type="hidden" name="booksID" value="{{ $bookspart->booksID }}">
                                        <input type="text"
                                               name="booksPartTitre"
                                               id="booksPartTitre"
                                               class="form-control"
                                               value="{{ $bookspart->booksPartTitre }}"
                                               required
                                               oninput="updateWordCount('Titre', 'TitreWordCount', this.value)">
                                        <small id="TitreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                                    </div>

                                    <div class="form-group">
                                        <label>القسم</label>
                                        <select name="categoryID" class="form-control" required>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->categoryID }}"
                                                    {{ $bookspart->categoryID == $category->categoryID ? 'selected' : '' }}>
                                                    {{ $category->categoryName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <input type="hidden" name="translatorID" value="{{ $bookspart->translatorID }}">

                                    <div class="form-group">
                                        <label>اسم المؤلف</label>
                                        <input type="text" name="booksPartNomAuteur" class="form-control"
                                               value="{{ $bookspart->booksPartNomAuteur }}">
                                    </div>

                                    <div class="form-group">
                                        <label>دار النشر</label>
                                        <input type="text" name="bookspartMaisonEdition" class="form-control"
                                               value="{{ $bookspart->bookspartMaisonEdition }}">
                                    </div>

                                    <div class="form-group">
                                        <label>تاريخ الإصدار</label>
                                        <input type="date" name="bookspartDateSortie" class="form-control"
                                               value="{{ $bookspart->bookspartDateSortie }}">
                                    </div>

                                    <div class="form-group">
                                        <label>نسخة الطباعة</label>
                                        <input type="text" name="bookspartVersionImprimable" class="form-control"
                                               value="{{ $bookspart->bookspartVersionImprimable }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>الكتاب</label>
                                <textarea id="editor" name="bookpartarticle">{{ $bookspart->bookpartarticle }}</textarea>
                                <small id="articleWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                            </div>

                            <button type="button" id="generateSummary" class="btn btn-primary">
                                توليد ملخص بالذكاء الاصطناعي
                            </button>

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

                                // compteur initial
                                try {
                                  let initialText = editor.getData().replace(/<[^>]*>/g, ' ');
                                  updateWordCount('article', 'articleWordCount', initialText);
                                } catch (e) {
                                  console.error('Erreur compteur initial CKEditor:', e);
                                }

                                // mise à jour en direct
                                editor.model.document.on('change:data', () => {
                                  let plainText = editor.getData().replace(/<[^>]*>/g, ' ');
                                  updateWordCount('article', 'articleWordCount', plainText);
                                });
                              }).catch(error => {
                                console.error('Erreur initialisation CKEditor:', error);
                              });

                              // bouton IA
                              document.getElementById('generateSummary').addEventListener('click', function () {
                                let btn = this;
                                let articleContent = editorInstance.getData();
                                if (!articleContent.trim()) {
                                  alert('الرجاء إدخال الكتاب');
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
                                  document.getElementById('bookspartResumeLivre').value = data.summary;
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

                            <div class="form-group">
                                <label>ملخص الكتاب</label>
                                <textarea id="bookspartResumeLivre" name="bookspartResumeLivre" rows="4"
                                    class="form-control" required
                                    oninput="updateWordCount('ResumeLivre', 'ResumeLivreWordCount', this.value)">{{ $bookspart->bookspartResumeLivre }}</textarea>
                                <small id="ResumeLivreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                            </div>

                            <div class="form-group">
                                <label>رفع ملف PDF</label>
                                <input type="file" name="bookspartpdf_file" class="form-control">
                                @if($bookspart->bookspartpdf_file)
                                    <p>
                                        📄 الملف الحالي:
                                        <a href="{{ asset('includesAdmin/pdf/books/' . $bookspart->bookspartpdf_file) }}"
                                           target="_blank">
                                            عرض PDF
                                        </a>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="box-footer text-center">
                            <input type="hidden" name="nbremots" id="nbremots"
                                   value="{{ old('nbremots', $bookspart->nbremots ?? 0) }}">

                            <div class="alert alert-info" style="font-weight:bold">
                                <span id="totalWordCount">عدد الكلمات الإجمالي في هذه الصفحة هو: 0</span>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-save"></i> حفظ المسودة
                            </button>

                            <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">
                                رجوع
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
  updateWordCount('Titre', 'TitreWordCount', document.getElementById('booksPartTitre').value);
  updateWordCount('ResumeLivre', 'ResumeLivreWordCount', document.getElementById('bookspartResumeLivre').value);
});
</script>
@endsection