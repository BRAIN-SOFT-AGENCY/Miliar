@extends('editor.layouts.app')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        <i class="fa fa-book"></i> تفاصيل الكتاب
      </h1>
    </section>


    <section class="content">

      <div class="row">

        <div class="col-md-10 col-md-offset-1">


          <div class="box box-primary">


            <div class="box-header with-border text-center">

              <h3 class="box-title">
                {{ $book->Titre }}
              </h3>

            </div>



            <div class="box-body" dir="rtl">


              <div class="row">


                <!-- صورة الكتاب -->

                <div class="col-md-4 text-center">


                  <label>
                    صورة الكتاب
                  </label>


                  <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">


                    <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" style="
            width:220px;
            height:220px;
            object-fit:cover;
            border-radius:10px;
            ">


                  </div>


                </div>





                <!-- معلومات الكتاب -->

                <div class="col-md-8">



                  <div class="form-group">

                    <label>
                      عنوان الكتاب : {{ $book->Titre }}

                    </label>

                  </div>




                  <div class="form-group">

                    <label>
                      اسم المؤلف : {{ $book->NomAuteur }}

                    </label>



                  </div>





                  <div class="form-group">

                    <label>
                      القسم : {{ $book->category->categoryName ?? '' }}

                    </label>


                  </div>






                  <div class="form-group">

                    <label>
                      المترجم : {{ $book->translator->translatorfirstName ?? '' }}

                      {{ $book->translator->translatorLastName ?? '' }}

                    </label>



                  </div>







                  <div class="form-group">

                    <label>
                      دار النشر : {{ $book->MaisonEdition }}

                    </label>



                  </div>







                  <div class="form-group">

                    <label>
                      تاريخ الإصدار : {{ $book->DateSortie }}

                    </label>



                  </div>






                  <div class="form-group">

                    <label>
                      نسخة الطباعة : {{ $book->VersionImprimable }}

                    </label>



                  </div>



                </div>


              </div>




              <hr>




              <!-- الكتاب -->

              <div class="form-group">

                <label>
                  <i class="fa fa-file-text"></i>
                  الكتاب :
                </label>


                <div class="well" style="
            min-height:200px;
            line-height:2;
            text-align:right;
            ">

                  {!! $book->article !!}

                </div>


              </div>






              <!-- الملخص -->

              <div class="form-group">

                <label>
                  ملخص الكتاب :
                </label>


                <div class="well" style="
            line-height:2;
            text-align:right;
            ">

                  {{ $book->ResumeLivre }}

                </div>


              </div>







              <!-- PDF -->

              <div class="form-group">

                <label>
                  ملف PDF :
                </label>


                @if($book->pdf_file)

                  <br>

                  <a href="{{ asset('includesAdmin/pdf/books/' . $book->pdf_file) }}" target="_blank"
                    class="btn btn-danger">

                    <i class="fa fa-file-pdf-o"></i>

                    عرض ملف PDF

                  </a>


                @else

                  <p>
                    لا يوجد ملف PDF
                  </p>

                @endif


              </div>



            </div>





            <div class="box-footer text-center">



              <a href="{{ route('editor.pages.bookseditor') }}" class="btn btn-default btn-lg">

                <i class="fa fa-arrow-right"></i>
                رجوع

              </a>



            </div>



          </div>


        </div>


      </div>


    </section>


  </div>


@endsection