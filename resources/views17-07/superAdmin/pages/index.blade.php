@extends('superAdmin.layouts.app')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        <small> </small>
      </h1>
      <ol class="breadcrumb">
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Statistiques principales -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>موقع مليار</h3>
              <p> الواب</p>
            </div>
            <div class="icon">
              <i class="fa fa-globe"></i>
            </div>
            <a href="https://maxu123.com/miliar/" class="small-box-footer" target="_blank">
              عرض موقع مليار <i class="fa fa-arrow-circle-left"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $books->count(); ?></h3>
              <p>الكتب</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="#" class="small-box-footer">
              عرض الكتب <i class="fa fa-arrow-circle-left"></i>
            </a>
          </div>
        </div>



        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $cours->count(); ?></h3>
              <p>المقالات</p>
            </div>
            <div class="icon">
              <i class="fa fa-file-text"></i>

            </div>
            <a href="#" class="small-box-footer">
              عرض المقالات <i class="fa fa-arrow-circle-left"></i>
            </a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $etudes->count(); ?></h3>
              <p>الدراسات</p>
            </div>
            <div class="icon">
              <i class="fa fa-search"></i>
            </div>
            <a href="#" class="small-box-footer">
              عرض الدراسات <i class="fa fa-arrow-circle-left"></i>
            </a>
          </div>
        </div>

      </div>

      <!-- Main row -->
      <div class="row">

        <!-- الكتب الأخيرة -->

        <section class="col-md-7">

          <div class="box box-primary">

            <div class="box-header d-flex justify-content-between align-items-center">
              <h3 class="box-title"> أخر الكتب اللتي لم يتم تعديلها </h3>

            </div>

            <div class="box-body table-responsive">

              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> العنوان</th>
                    <th>الملخص </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($toobooks as $book)

                    <tr>

                      <td>
                        <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" width="100">
                      </td>

                      <td>{{ $book->Titre }}</td>
                      <td style="    width: 100%;">
                        <div class="resume-short">
                          {{ $book->ResumeLivre }}
                        </div>
                      </td>
                      <style>
                        .resume-short {
                          display: -webkit-box;
                          -webkit-line-clamp: 2;
                          /* nombre de lignes */
                          -webkit-box-orient: vertical;
                          overflow: hidden;
                          text-overflow: ellipsis;
                          line-height: 1.8;
                        }
                      </style>

                    </tr>

                  @endforeach
                </tbody>
              </table>

            </div>

          </div>

        </section>

        <!-- المترجمون -->
        <section class="col-lg-5">

          <div class="box box-success">

            <div class="box-header">
              <h3 class="box-title">المترجمون النشطون</h3>
            </div>

            <div class="box-body">

              <ul class="list-group">

                @foreach($translators as $translator)
                  <li class="list-group-item">
                    {{ $translator->translatorfirstName }} {{ $translator->translatorLastName }}
                    <span class="label label-success pull-left">{{ $translator->books_count }} ترجمة</span>
                  </li>
                @endforeach

              </ul>

            </div>

          </div>
        </section>



        <section class="col-lg-12">

          <div class="box box-warning">

            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-language"></i> أخر الترجمات اللتي لم يتم تعديلها
              </h3>
            </div>

            <div class="box-body table-responsive">
              <table class="table table-hover">

                <thead>
                  <tr>
                    <th>#</th>
                    <th>العنوان</th>
                    <th>الملخص</th>
                    <th>النوع</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($allbooks as $key => $book)

                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $book->Titre }}</td>
                      <td style="    width: 70%;">
                        <div class="resume-short">
                          {{ $book->ResumeLivre }}
                        </div>
                      </td>
                      <style>
                        .resume-short {
                          display: -webkit-box;
                          -webkit-line-clamp: 2;
                          /* nombre de lignes */
                          -webkit-box-orient: vertical;
                          overflow: hidden;
                          text-overflow: ellipsis;
                          line-height: 1.8;
                        }
                      </style>
                      <td>
                        @if($book->type == 0)
                          <span class="label label-primary">مقال</span>
                        @elseif($book->type == 1)
                          <span class="label label-success">كتاب</span>
                        @elseif($book->type == 2)
                          <span class="label label-warning">دراسة</span>
                        @endif
                      </td>
                    </tr>

                  @endforeach

                </tbody>

              </table>

            </div>

          </div>

        </section>

      </div>

    </section>
  </div><!-- /.content-wrapper -->
@endsection

@section('scripts')
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('includesAdmin/dist/js/pages/dashboard.js') }}"></script>
@endsection