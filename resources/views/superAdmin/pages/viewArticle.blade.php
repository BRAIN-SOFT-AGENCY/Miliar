@extends('superAdmin.layouts.app')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        تفاصيل المقال
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


                <!-- Image -->
                <div class="col-md-4 text-center">

                  <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" class="img-thumbnail"
                    style="width:250px;height:250px;object-fit:cover">

                </div>



                <!-- Informations -->
                <div class="col-md-8">


                  <div class="form-group">
                    <label>
                      <i class="fa fa-book"></i>
                      عنوان المقال : {{ $book->Titre }}

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
                      المترجم : {{ 
                                                      $book->translator->translatorfirstName ?? ''
                                                  }}

                      {{ 
                                                      $book->translator->translatorLastName ?? ''
                                                  }}
                    </label>



                  </div>




                  <div class="form-group">

                    <label>
                      المصدر : {{ $book->MaisonEdition }}

                    </label>



                  </div>




                  <div class="form-group">

                    <label>
                      تاريخ الإصدار : {{ $book->DateSortie }}

                    </label>



                  </div>


                </div>


              </div>



              <hr>


              <!-- Article -->

              <div class="form-group">

                <label>
                  <i class="fa fa-file-text"></i>
                  المقال :
                </label>


                <div class="well" style="line-height:2;text-align:right">

                  {!! $book->article !!}

                </div>

              </div>




              <!-- Resume -->

              <div class="form-group">

                <label>
                  ملخص المقال :
                </label>


                <div class="well" style="line-height:2;text-align:right">

                  {{ $book->ResumeLivre }}

                </div>

              </div>
              <div class="form-group">

                <label>
                  مقتطف :
                </label>


                <div class="well" style="line-height:2;text-align:right">

                  {{ $book->extrait }}

                </div>

              </div>
            

            </div>



            <div class="box-footer text-center">


              <!--a href="{{ route('superAdmin.pages.article') }}" class="btn btn-default btn-lg">

                  <i class="fa fa-arrow-right"></i>
                  رجوع

                </a-->





            </div>


          </div>


        </div>
      </div>


    </section>


  </div>


@endsection