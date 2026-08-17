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

      <div class="col-md-10" style="text-align: left;">
        <section>
          <div class="d-flex gap-2 justify-content-left">

            <a href="{{route('translator.pages.addetudesPart', $booksID)}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف أجزاء للدراسة
            </a>

          </div>
        </section>
      </div>

      <div class="col-md-1"></div>
    </div> <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> قائمة أجزاء الدراسة</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> العنوان</th>
                    <th>الملخص </th>
                    <th>تاريخ النشر</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($etudesPart as $book)

                    <tr>

                      <td>
                        <img src="{{ asset('includesAdmin/img/books/' . $book->etudespartImage) }}" width="100">
                      </td>

                      <td>{{ $book->etudespartTitre }}</td>

                      <td style="    width: 100%;">
                        <div class="resume-short">
                          {{ $book->etudespartResumeLivre }}
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
                      <td>{{ $book->etudespartPublierLe }}</td>




                      <td style="display:flex; gap:5px; justify-content:center;">

                        <a href="{{ route('translator.etudesPart.view', $book->etudespartID) }}"
                          class="btn btn-warning btn-xs" data-toggle="tooltip" title="مشاهدة">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('translator.etudesPart.edit', $book->etudespartID) }}"
                          class="btn btn-success btn-xs" data-toggle="tooltip" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('translator.etudesPart.delete', $book->etudespartID) }}"
                          class="btn btn-danger btn-xs" onclick="return confirm('هل أنت متأكد من حذف هذه الدراسة ')"
                          data-toggle="tooltip" title="حذف">

                          <i class="fa fa-trash"></i>

                        </a>

                      </td>

                    </tr>

                  @endforeach

                </tbody>



              </table>

              <script>
                $(function () {
                  $('[data-toggle="tooltip"]').tooltip();
                });
              </script>
            </div>

          </div>

        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection

@section('scripts')
  <!-- page script -->
  <script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
      });
    });
  </script>
@endsection