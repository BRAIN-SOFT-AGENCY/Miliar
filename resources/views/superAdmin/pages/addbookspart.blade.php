@extends('superAdmin.layouts.app')

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
        let total = wordCounts.Titre + wordCounts.article + wordCounts.ResumeLivre; // 🔥 pas de "extrait" ici
        document.getElementById('totalWordCount').innerText = 'عدد الكلمات الإجمالي في هذه الصفحة هو: ' + total;
        document.getElementById('nbremots').value = total;
      }
    </script>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small> </small>
      </h1>

    </section>
    <div class="row mb-3">
      <div class="col-md-1"></div>


      <div class="col-md-1"></div>
    </div>

    <section class="content">

      <div class="row">
        <div class="col-md-10 col-md-offset-1">

          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-book"></i>
                إضافة جزء للكتاب
              </h3>
            </div>

            @if(session('success'))
              <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
              </div>
            @endif

            <form action="{{ route('superAdmin.bookspart.store') }}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="box-body">

                <div class="row">

                  <!-- صورة الكتاب -->
                  <div class="col-md-4 text-center">

                    <label>صورة الكتاب</label>

                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">

                      <img id="previewImage" src="{{ asset('includesAdmin/img/books/default.jpg') }}"
                        style="width:150px;height:150px;margin-bottom:10px">

                      <input type="file" name="booksPartImage" class="form-control" onchange="preview(event)"
                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/jpeg,image/png,image/gif,image/webp,image/avif">

                    </div>

                  </div>


                  <div class="col-md-8">

                    <div class="form-group">
                      <label>عنوان الكتاب</label>
                      <input type="hidden" name="booksID" class="form-control" value="{{ $booksID }}" required>

                      <input type="text" name="booksPartTitre" id="booksPartTitre" class="form-control" required
                        oninput="updateWordCount('Titre', 'TitreWordCount', this.value)">
                      <small id="TitreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                    </div>
                    <div class="form-group">
                      <label>القسم</label>
                      <select name="categoryID" class="form-control" required>
                        <option value="">-- اختر القسم --</option>
                        @foreach($categories as $category)
                          <option value="{{ $category->categoryID }}">{{ $category->categoryName }}</option>
                        @endforeach
                      </select>
                    </div>



                    <div class="form-group">
                      <label>المترجم</label>
                      <select name="translatorID" class="form-control" required>
                        <option value="">-- اختر المترجم --</option>
                        @foreach($translators as $translator)
                          <option value="{{ $translator->translatorID }}">
                            {{ $translator->translatorfirstName }} {{ $translator->translatorLastName }}
                          </option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label>اسم المؤلف</label>
                      <input type="text" name="booksPartNomAuteur" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>دار النشر</label>
                      <input type="text" name="bookspartMaisonEdition" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>تاريخ الإصدار</label>
                      <input type="date" name="bookspartDateSortie" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label>نسخة الطباعة</label>
                      <input type="text" name="bookspartVersionImprimable" class="form-control">
                    </div>

                  </div>

                </div>


                <div class="form-group">
                  <label>الكتاب</label>
                  <textarea id="editor" name="bookpartarticle"></textarea>
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
                      writer.setAttribute(
                        'dir',
                        'rtl',
                        editor.editing.view.document.getRoot()
                      );
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

                  // bouton IA
                  document.getElementById('generateSummary').addEventListener('click', function () {

                    let btn = this;
                    let articleContent = editorInstance.getData();

                    if (!articleContent.trim()) {
                      alert('الرجاء إدخالالكتاب ');
                      return;
                    }

                    btn.disabled = true;
                    btn.innerHTML = 'جاري التوليد...';

                    fetch("{{ url('/generate-summary') }}", {   // 🔥 IMPORTANT FIX URL
                      method: 'POST',
                      headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json', // 🔥 IMPORTANT
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                      },
                      body: JSON.stringify({
                        article: articleContent
                      })
                    })
                      .then(async response => {

                        let text = await response.text(); // 🔥 IMPORTANT FIX

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
                  <label>ملخص الكتاب </label>
                  <textarea id="bookspartResumeLivre" name="bookspartResumeLivre" rows="4" class="form-control" required
                    oninput="updateWordCount('ResumeLivre', 'ResumeLivreWordCount', this.value)"></textarea>
                  <small id="ResumeLivreWordCount" class="text-muted d-block mt-1">عدد الكلمات هو: 0</small>
                </div>

                <div class="form-group">
                  <label>رفع ملف PDF</label>
                  <input type="file" name="bookspartpdf_file" class="form-control">
                </div>

              </div>

              <div class="box-footer text-center">
                <input type="hidden" name="nbremots" id="nbremots" value="0">

                <div class="alert alert-info" style="font-weight:bold">
                  <span id="totalWordCount">عدد الكلمات الإجمالي في هذه الصفحة هو: 0</span>
                </div>

                <button type="submit" class="btn btn-success btn-lg">
                  <i class="fa fa-save"></i> حفظ الكتاب
                </button>

                <a href="#" class="btn btn-default btn-lg">
                  <i class="fa fa-arrow-right"></i> رجوع
                </a>

              </div>

            </form>

          </div>
        </div>
      </div>

    </section>
    <script>

      function preview(event) {
        var reader = new FileReader();

        reader.onload = function () {
          var output = document.getElementById('previewImage');
          output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);

      }

    </script>

  </div>

@endsection

@section('scripts')

@endsection