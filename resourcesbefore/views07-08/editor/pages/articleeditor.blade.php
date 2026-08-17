@extends('editor.layouts.app')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <small> </small>
      </h1>

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">قائمة المقالات</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> العنوان</th>
                    <th>الملخص </th>
                    <th> المترجم</th>
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
                                    <td>{{ $book->translator->translatorfirstName }} {{ $book->translator->translatorLastName }}</td>


                                    <td style="display:flex; gap:5px; justify-content:center;">

                                      <a href="{{ route('editor.article.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                                        data-toggle="tooltip" title="مشاهدة">
                                        <i class="fa fa-eye"></i>
                                      </a>
                                      <?php  if ($book->type == 0) { ?>
                                      <a href="{{ route('editor.article.edit', $book->booksID) }}" class="btn btn-success btn-xs"
                                        data-toggle="tooltip" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <form action="{{ route('editor.books.publish', $book->booksID) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-xs"
                                          style="background-color: #a1038d;    border-color: #a1038d;"
                                          onclick="return confirm('هل أنت متأكد من نشر هذا المقال')">
                                          <i class="fa fa-share"></i>
                                        </button>
                                      </form>
                                      <?php

                    } else if ($book->type == 1) { ?>
                                      <a href="{{ route('editor.books.edit', $book->booksID) }}" class="btn btn-warning btn-xs"
                                        data-toggle="tooltip" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <form action="{{ route('editor.books.publish', $book->booksID) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-xs"
                                          style="background-color: #a1038d;    border-color: #a1038d;"
                                          onclick="return confirm('هل أنت متأكد من نشر هذا المقال')">
                                          <i class="fa fa-share"></i>
                                        </button>
                                      </form>
                                      <?php

                      } ?>




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