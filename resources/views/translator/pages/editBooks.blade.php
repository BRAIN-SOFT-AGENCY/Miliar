@extends('translator.layouts.app')

@section('content')

  <div class="content-wrapper">

    ```
    <!-- ========================================================= -->
    <!-- COMPTEUR DE MOTS -->
    <!-- ========================================================= -->

    <script>

      let wordCounts = {
        Titre: 0,
        article: 0,
        ResumeLivre: 0,
        extrait: 0
      };


      // =========================================================
      // COMPTER LES MOTS
      // =========================================================

      function countWords(text) {

        text = (text || '').trim();

        if (!text) {
          return 0;
        }

        // Supprimer les balises HTML
        text = text.replace(/<[^>]*>/g, ' ');

        // Transformer les espaces HTML
        text = text.replace(/&nbsp;|&#160;/gi, ' ');

        // Supprimer la ponctuation
        text = text.replace(
          /[.,،؛;:!?؟…"“”"'()\[\]{}<>«»\/\\|ـ_-]+/g,
          ' '
        );

        // Compter les mots
        return text
          .split(/\s+/u)
          .filter(word => word.length > 0)
          .length;
      }


      // =========================================================
      // METTRE A JOUR UN COMPTEUR
      // =========================================================

      function updateWordCount(fieldKey, elementId, text) {

        let count = countWords(text);

        wordCounts[fieldKey] = count;

        let element = document.getElementById(elementId);

        if (element) {

          element.innerText =
            'عدد الكلمات هو: ' + count;
        }

        updateTotalWordCount();
      }


      // =========================================================
      // CALCUL TOTAL
      // =========================================================

      function updateTotalWordCount() {

        let total =
          wordCounts.Titre +
          wordCounts.article +
          wordCounts.ResumeLivre +
          wordCounts.extrait;


        let totalElement =
          document.getElementById('totalWordCount');


        if (totalElement) {

          totalElement.innerText =
            'عدد الكلمات الإجمالي في هذه الصفحة هو: ' + total;
        }


        // IMPORTANT :
        // valeur envoyée au Controller Laravel

        let hiddenElement =
          document.getElementById('nbremots');


        if (hiddenElement) {

          hiddenElement.value = total;
        }
      }

    </script>


    <!-- ========================================================= -->
    <!-- HEADER -->
    <!-- ========================================================= -->

    <section class="content-header">

      <h1>
        <small></small>
      </h1>

    </section>


    <div class="row mb-3">

      <div class="col-md-1"></div>

      <div class="col-md-1"></div>

    </div>


    <!-- ========================================================= -->
    <!-- CONTENT -->
    <!-- ========================================================= -->

    <section class="content">

      <div class="row">

        <div class="col-md-10 col-md-offset-1">

          <div class="box box-primary">


            <!-- ================================================= -->
            <!-- HEADER -->
            <!-- ================================================= -->

            <div class="box-header with-border">

              <h3 class="box-title">

                <i class="fa fa-book"></i>

                تعديل الكتاب

              </h3>

            </div>


            <!-- ================================================= -->
            <!-- SUCCESS -->
            <!-- ================================================= -->

            @if(session('success'))

              <div class="alert alert-success">

                <i class="fa fa-check-circle"></i>

                {{ session('success') }}

              </div>

            @endif


            <!-- ================================================= -->
            <!-- FORM -->
            <!-- ================================================= -->

            <form action="{{ route('translator.books.update', $book->booksID) }}" method="POST"
              enctype="multipart/form-data">

              @csrf


              <div class="box-body">


                <!-- ================================================= -->
                <!-- IMAGE + INFORMATION -->
                <!-- ================================================= -->

                <div class="row">


                  <!-- IMAGE -->
                  <div class="col-md-4 text-center">

                    <label>
                      صورة الكتاب
                    </label>


                    <div style="
                                          border:1px dashed #ccc;
                                          padding:15px;
                                          border-radius:10px
                                      ">

                      <img id="previewImage" src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" style="
                                              width:150px;
                                              height:150px;
                                              margin-bottom:10px
                                          ">


                      <input type="file" name="Image" class="form-control" onchange="preview(event)"
                        accept=".jpg,.jpeg,.png,.gif,.webp,.avif,image/jpeg,image/png,image/gif,image/webp,image/avif">


                      <p style="
                                              margin-top:10px;
                                              color:gray
                                          ">

                        الصورة الحالية :

                        {{ $book->Image }}

                      </p>

                    </div>

                  </div>


                  <!-- INFORMATION -->
                  <div class="col-md-8">


                    <!-- ===================================== -->
                    <!-- TITRE -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        عنوان الكتاب
                      </label>


                      <input type="hidden" name="status" class="form-control" value="-3" required>


                      <input type="hidden" name="type" class="form-control" value="1" required>


                      <input type="hidden" name="isbanner" class="form-control" value="0" required>


                      <input type="text" name="Titre" id="Titre" class="form-control" value="{{ $book->Titre }}" required
                        oninput="
                                              updateWordCount(
                                                  'Titre',
                                                  'TitreWordCount',
                                                  this.value
                                              )
                                          ">


                      <small id="TitreWordCount" class="text-muted d-block mt-1">
                        عدد الكلمات هو: 0
                      </small>

                    </div>



                    <!-- ===================================== -->
                    <!-- AUTHOR -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        اسم المؤلف
                      </label>


                      <input type="text" name="NomAuteur" class="form-control" value="{{ $book->NomAuteur }}">

                    </div>



                    <!-- ===================================== -->
                    <!-- CATEGORY -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        القسم
                      </label>


                      <select name="categoryID" class="form-control" required>

                        <option value="">
                          -- اختر القسم --
                        </option>


                        @foreach($categories as $category)

                          <option value="{{ $category->categoryID }}" {{ $book->categoryID == $category->categoryID ? 'selected' : '' }}>

                            {{ $category->categoryName }}

                          </option>

                        @endforeach

                      </select>

                    </div>



                    <!-- ===================================== -->
                    <!-- TRANSLATOR -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <input type="hidden" name="translatorID" value="{{ $book->translatorID }}">

                    </div>



                    <!-- ===================================== -->
                    <!-- PUBLISHER -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        دار النشر
                      </label>


                      <input type="text" name="MaisonEdition" class="form-control" value="{{ $book->MaisonEdition }}">

                    </div>



                    <!-- ===================================== -->
                    <!-- DATE -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        تاريخ الإصدار
                      </label>


                      <input type="date" name="DateSortie" class="form-control" value="{{ $book->DateSortie }}">

                    </div>



                    <!-- ===================================== -->
                    <!-- PRINT VERSION -->
                    <!-- ===================================== -->

                    <div class="form-group">

                      <label>
                        نسخة الطباعة
                      </label>


                      <input type="text" name="VersionImprimable" class="form-control"
                        value="{{ $book->VersionImprimable }}">

                    </div>


                  </div>

                </div>


                <!-- ================================================= -->
                <!-- BOOK CONTENT -->
                <!-- ================================================= -->

                <div class="form-group">

                  <label>
                    الكتاب
                  </label>


                  <textarea id="editor" name="article">{{ $book->article }}</textarea>


                  <small id="articleWordCount" class="text-muted d-block mt-1">
                    عدد الكلمات هو: 0
                  </small>

                </div>



                <!-- ================================================= -->
                <!-- AI SUMMARY -->
                <!-- ================================================= -->

                <button type="button" id="generateSummary" class="btn btn-primary">

                  توليد ملخص بالذكاء الاصطناعي

                </button>


                <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>


                <script>

                  let editorInstance;


                  // =================================================
                  // CKEDITOR
                  // =================================================

                  ClassicEditor
                    .create(
                      document.querySelector('#editor'),
                      {
                        language: 'ar',
                      }
                    )
                    .then(editor => {

                      editorInstance = editor;


                      // RTL
                      editor.editing.view.change(writer => {

                        writer.setAttribute(
                          'dir',
                          'rtl',
                          editor.editing.view.document.getRoot()
                        );

                      });


                      // =============================================
                      // COMPTER LE LIVRE AU CHARGEMENT
                      // =============================================

                      updateWordCount(
                        'article',
                        'articleWordCount',
                        editor.getData()
                      );


                      // =============================================
                      // COMPTER EN TEMPS REEL
                      // =============================================

                      editor.model.document.on(
                        'change:data',
                        () => {

                          updateWordCount(
                            'article',
                            'articleWordCount',
                            editor.getData()
                          );

                        }
                      );

                    })
                    .catch(error => {

                      console.error(
                        'Erreur initialisation CKEditor:',
                        error
                      );

                    });



                  // =================================================
                  // GENERATION DU RESUME AVEC IA
                  // =================================================

                  document
                    .getElementById('generateSummary')
                    .addEventListener(
                      'click',
                      function () {


                        let btn = this;


                        let articleContent =
                          editorInstance.getData();


                        if (!articleContent.trim()) {

                          alert(
                            'الرجاء إدخال الكتاب'
                          );

                          return;
                        }


                        btn.disabled = true;

                        btn.innerHTML =
                          'جاري التوليد...';



                        fetch(
                          "{{ url('/generate-summary') }}",
                          {

                            method: 'POST',

                            headers: {

                              'Content-Type':
                                'application/json',

                              'Accept':
                                'application/json',

                              'X-CSRF-TOKEN':
                                '{{ csrf_token() }}'

                            },

                            body: JSON.stringify({

                              article:
                                articleContent

                            })

                          }
                        )


                          .then(
                            async response => {

                              let text =
                                await response.text();


                              let data;


                              try {

                                data =
                                  JSON.parse(text);

                              }
                              catch (e) {

                                console.error(
                                  "Server returned HTML instead of JSON:"
                                );

                                console.log(text);

                                throw new Error(
                                  "Erreur serveur (HTML reçu au lieu de JSON)"
                                );

                              }


                              if (!response.ok) {

                                throw new Error(
                                  data.error ||
                                  'Erreur IA'
                                );

                              }


                              return data;

                            }
                          )


                          .then(data => {


                            // =========================================
                            // METTRE LE RESUME
                            // =========================================

                            document
                              .getElementById(
                                'ResumeLivre'
                              )
                              .value =
                              data.summary;


                            // =========================================
                            // METTRE A JOUR COMPTEUR RESUME
                            // =========================================

                            updateWordCount(
                              'ResumeLivre',
                              'ResumeLivreWordCount',
                              data.summary
                            );

                          })


                          .catch(error => {

                            console.error(error);

                            alert(
                              error.message
                            );

                          })


                          .finally(() => {

                            btn.disabled = false;

                            btn.innerHTML =
                              'توليد ملخص بالذكاء الاصطناعي';

                          });

                      }
                    );

                </script>



                <!-- ================================================= -->
                <!-- CKEDITOR STYLE -->
                <!-- ================================================= -->

                <style>
                  .ck-editor__editable {

                    min-height: 300px;

                    direction: rtl !important;

                    text-align: right !important;

                  }
                </style>



                <!-- ================================================= -->
                <!-- RESUME -->
                <!-- ================================================= -->

                <div class="form-group">

                  <label>
                    ملخص الكتاب
                  </label>


                  <textarea id="ResumeLivre" name="ResumeLivre" rows="4" class="form-control" required oninput="
                                      updateWordCount(
                                          'ResumeLivre',
                                          'ResumeLivreWordCount',
                                          this.value
                                      )
                                  ">{{ $book->ResumeLivre }}</textarea>


                  <small id="ResumeLivreWordCount" class="text-muted d-block mt-1">
                    عدد الكلمات هو: 0
                  </small>

                </div>



                <!-- ================================================= -->
                <!-- EXTRAIT -->
                <!-- ================================================= -->

                <div class="form-group">

                  <label>
                    مقتطف
                  </label>


                  <textarea id="extrait" name="extrait" rows="4" class="form-control" required oninput="
                                      updateWordCount(
                                          'extrait',
                                          'extraitWordCount',
                                          this.value
                                      )
                                  ">{{ $book->extrait }}</textarea>


                  <small id="extraitWordCount" class="text-muted d-block mt-1">
                    عدد الكلمات هو: 0
                  </small>

                </div>



                <!-- ================================================= -->
                <!-- PDF -->
                <!-- ================================================= -->

                <div class="form-group">

                  <label>
                    رفع ملف PDF
                  </label>


                  <input type="file" name="pdf_file" class="form-control">


                  <p style="
                                      margin-top:10px;
                                      color:gray
                                  ">

                    PDF الحالي :

                    {{ $book->pdf_file }}

                  </p>

                </div>


              </div>


              <!-- ================================================= -->
              <!-- FOOTER -->
              <!-- ================================================= -->

              <div class="box-footer text-center">


                <!-- ============================================= -->
                <!-- NBREMOTS -->
                <!-- ============================================= -->

                <input type="hidden" name="nbremots" id="nbremots" value="0">


                <!-- ============================================= -->
                <!-- TOTAL -->
                <!-- ============================================= -->

                <div class="alert alert-info" style="font-weight:bold">

                  <span id="totalWordCount">

                    عدد الكلمات الإجمالي في هذه الصفحة هو: 0

                  </span>

                </div>


                <!-- ============================================= -->
                <!-- SAVE -->
                <!-- ============================================= -->

                <button type="submit" class="btn btn-success btn-lg">

                  <i class="fa fa-save"></i>

                  حفظ المسودة

                </button>


              </div>


            </form>

          </div>

        </div>

      </div>

    </section>


    <!-- ========================================================= -->
    <!-- IMAGE PREVIEW + INITIALIZATION -->
    <!-- ========================================================= -->

    <script>

      // =========================================================
      // PREVIEW IMAGE
      // =========================================================

      function preview(event) {

        var reader =
          new FileReader();


        reader.onload = function () {

          var output =
            document.getElementById('previewImage');

          output.src =
            reader.result;

        };


        reader.readAsDataURL(
          event.target.files[0]
        );

      }



      // =========================================================
      // INITIALISER LES COMPTEURS
      // =========================================================

      document.addEventListener(
        'DOMContentLoaded',
        function () {


          // ================================================
          // TITRE
          // ================================================

          let titre =
            document.getElementById('Titre');

          if (titre) {

            updateWordCount(
              'Titre',
              'TitreWordCount',
              titre.value
            );

          }


          // ================================================
          // RESUME
          // ================================================

          let resume =
            document.getElementById('ResumeLivre');

          if (resume) {

            updateWordCount(
              'ResumeLivre',
              'ResumeLivreWordCount',
              resume.value
            );

          }


          // ================================================
          // EXTRAIT
          // ================================================

          let extrait =
            document.getElementById('extrait');

          if (extrait) {

            updateWordCount(
              'extrait',
              'extraitWordCount',
              extrait.value
            );

          }

        }
      );

    </script>
    ```

  </div>

@endsection

@section('scripts')

  <script>

    $(function () {

      $('.textarea').wysihtml5();

    });

  </script>

@endsection