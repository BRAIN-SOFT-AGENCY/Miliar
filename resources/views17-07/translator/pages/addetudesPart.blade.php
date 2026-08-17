@extends('translator.layouts.app')

@section('content')
  <div class="content-wrapper">
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
                <i class="fa fa-book"></i> إضافة جزء من الدراسة
              </h3>
            </div>

            @if(session('success'))
              <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
              </div>
            @endif

            <form action="{{ route('translator.etudesPart.store') }}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="box-body">

                <div class="row">

                  <!-- صورة الكتاب -->
                  <div class="col-md-4 text-center">

                    <label>صورة الدراسة</label>

                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">

                      <img id="previewImage" src="{{ asset('includesAdmin/img/books/default.jpg') }}"
                        style="width:150px;height:150px;margin-bottom:10px">

                      <input type="file" name="etudespartImage" class="form-control" onchange="preview(event)"
                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/jpeg,image/png,image/gif,image/webp,image/avif">

                    </div>

                  </div>


                  <div class="col-md-8">

                    <div class="form-group">
                      <label>عنوان الدراسة</label>
                      <input type="hidden" name="booksID" class="form-control" value="{{ $booksID }}" required>

                      <input type="text" name="etudespartTitre" class="form-control" required>
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

                    <!--div class="form-group">
                                          <label>المترجم</label>
                                          <select name="translatorID" class="form-control" required>
                                            <option value="">-- اختر المترجم --</option>
                                            @foreach($translators as $translator)
                                              <option value="{{ $translator->translatorID }}">
                                                {{ $translator->translatorfirstName }} {{ $translator->translatorLastName }}
                                              </option>
                                            @endforeach
                                          </select>
                                        </div-->


                    <input type="hidden" name="translatorID"
                      value="{{ Auth::guard('translator')->user()->translatorID }}">
                    <div class="form-group">
                      <label>اسم المؤلف</label>
                      <input type="text" name="etudespartNomAuteur" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>المصدر </label>
                      <input type="text" name="etudespartMaisonEdition" class="form-control">
                    </div>

                    <div class="form-group">
                      <label>تاريخ الإصدار</label>
                      <input type="date" name="etudespartDateSortie" class="form-control" required>
                    </div>



                  </div>

                </div>
                <div class="form-group">
                  <label>الدراسة</label>
                  <textarea id="editor" name="etudespartarticle"></textarea>
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

                  });

                  // bouton IA
                  document.getElementById('generateSummary').addEventListener('click', function () {

                    let btn = this;
                    let articleContent = editorInstance.getData();

                    if (!articleContent.trim()) {
                      alert('الرجاء إدخال المقال');
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

                        document.getElementById('etudespartResumeLivre').value = data.summary;

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
                  <label>ملخص الدراسة</label>
                  <textarea id="etudespartResumeLivre" name="etudespartResumeLivre" rows="4" class="form-control"
                    required></textarea>
                </div>


              </div>

              <div class="box-footer text-center">

                <button type="submit" class="btn btn-success btn-lg">
                  <i class="fa fa-save"></i> حفظ جزء الدراسة
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