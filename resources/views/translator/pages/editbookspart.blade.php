@extends('translator.layouts.app')

@section('content')
<div class="content-wrapper">

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

                                        <input type="hidden"
                                               name="booksID"
                                               value="{{ $bookspart->booksID }}">

                                        <input type="text"
                                               name="booksPartTitre"
                                               class="form-control"
                                               value="{{ $bookspart->booksPartTitre }}"
                                               required>
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

                                    <input type="hidden"
                                           name="translatorID"
                                           value="{{ $bookspart->translatorID }}">

                                    <div class="form-group">
                                        <label>اسم المؤلف</label>
                                        <input type="text"
                                               name="booksPartNomAuteur"
                                               class="form-control"
                                               value="{{ $bookspart->booksPartNomAuteur }}">
                                    </div>

                                    <div class="form-group">
                                        <label>دار النشر</label>
                                        <input type="text"
                                               name="bookspartMaisonEdition"
                                               class="form-control"
                                               value="{{ $bookspart->bookspartMaisonEdition }}">
                                    </div>

                                    <div class="form-group">
                                        <label>تاريخ الإصدار</label>
                                        <input type="date"
                                               name="bookspartDateSortie"
                                               class="form-control"
                                               value="{{ $bookspart->bookspartDateSortie }}">
                                    </div>

                                    <div class="form-group">
                                        <label>نسخة الطباعة</label>
                                        <input type="text"
                                               name="bookspartVersionImprimable"
                                               class="form-control"
                                               value="{{ $bookspart->bookspartVersionImprimable }}">
                                    </div>

                                </div>

                            </div>

                     

                     
                  <div class="form-group">
                  <label>الكتاب</label>
                  <textarea id="editor" name="bookpartarticle">{{ $bookspart->bookpartarticle }}</textarea>
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
                      alert('الرجاء إدخال الكتاب');
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
                    class="form-control" required>{{ $bookspart->bookspartResumeLivre }}</textarea>
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
</script>
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
});
</script>
@endsection