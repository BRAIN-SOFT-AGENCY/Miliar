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

            <a href="{{route('translator.pages.addbooks')}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف كتاب
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
              <h3 class="box-title">قائمة الكتب</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> العنوان</th>
                    <th>الملخص </th>
                    <th>تاريخ النشر</th>
                    <th>PDF</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($books as $book)

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
                      <td>{{ $book->PublierLe }}</td>


                      <td>

                        @if($book->pdf_file)
                          <a href="{{ asset('includesAdmin/pdf/books/' . $book->pdf_file) }}" class="btn btn-success btn-xs"
                            style="background-color: #d57410;    border-color: #d57410;" target="_blank">
                            تحميل
                          </a>
                        @else
                          <span class="text-muted">لا يوجد</span>
                        @endif

                      </td>

                      <td style="display:flex; gap:5px; justify-content:center;">

                        <a href="{{ route('translator.pages.booksPart', $book->booksID) }}" class="btn btn-primary btn-xs"
                          data-toggle="tooltip" title="إضافة جزء">
                          <i class="fa fa-plus"></i>
                        </a>
                        <a href="{{ route('translator.books.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                          data-toggle="tooltip" title="مشاهدة">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('translator.books.edit', $book->booksID) }}" class="btn btn-success btn-xs"
                          data-toggle="tooltip" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('translator.books.publish', $book->booksID) }}" method="POST"
                          style="display:inline;">
                          @csrf
                          <button type="submit" class="btn btn-warning btn-xs"
                            style="background-color: #a1038d;    border-color: #a1038d;"
                            onclick="return confirm('هل أنت متأكد من نشر هذا الكتاب؟')">
                            <i class="fa fa-share"></i>
                          </button>
                        </form>
                        <a href="{{ route('translator.books.delete', $book->booksID) }}" class="btn btn-danger btn-xs"
                          onclick="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')" data-toggle="tooltip" title="حذف">

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