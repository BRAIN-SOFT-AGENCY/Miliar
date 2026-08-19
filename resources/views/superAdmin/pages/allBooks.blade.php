@extends('superAdmin.layouts.app')

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



          </div>
        </section>
      </div>

      <div class="col-md-1"></div>
    </div>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">قائمة المنشورات</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th>نوع المنشور</th>
                    <th> الصورة </th>
                    <th>عنوان الكتاب</th>
                    <th>الملخص </th>
                    <th>الصنف</th>
                    <th> المترجم</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($books as $book)

                                  <tr>
                                    <td><?php  if ($book->type == 0) { ?>
                                      <span style="color:#bb0727">مقال</span>
                                      <?php  } elseif ($book->type == 1) { ?>
                                      <span style="color:#025a5a">كتاب</span>

                                      <?php

                    } elseif ($book->type == 2) { ?>
                                      <span style="color:#bcbf0f">دراسة</span>

                                      <?php

                    }   ?>
                                    </td>

                                    <td>
                                      <img src="{{ asset('includesAdmin/img/books/' . $book->Image) }}" width="100">
                                    </td>

                                    <td>{{ $book->Titre }}</td>

                                    <td>{{ $book->ResumeLivre }}</td>


                                    <td>{{ optional($book->category)->categoryName }}</td>
                                    <td>{{ optional($book->translator)->translatorfirstName }}
                                      {{ optional($book->translator)->translatorlastName }}</td>
                                    <td style="display:flex; gap:5px; justify-content:center;">

                                      <a href="{{ route('books.deleteall', $book->booksID) }}" class="btn btn-danger btn-xs"
                                        onclick="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')" data-toggle="tooltip" title="حذف">

                                        <i class="fa fa-trash"></i>

                                      </a>

                                      <?php  if ($book->type == 1) { ?>

                                      <a href="{{ route('superAdmin.pages.booksPart', ['id' => $book->booksID, 'allbooks' => 1]) }}"
                                        class="btn btn-primary btn-xs" data-toggle="tooltip" title="إضافة جزء">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                      <?php  } else if ($book->type == 2) { ?>
                                      <a href="{{ route('superAdmin.pages.etudesPart', ['id' => $book->booksID, 'allbooks' => 1]) }}"
                                        class="btn btn-primary btn-xs" data-toggle="tooltip" title="إضافة جزء">
                                        <i class="fa fa-plus"></i>
                                      </a>
                                      <?php    } ?>






                                      <?php  if ($book->type == 1) { ?>

                                      <a href="{{ route('admin.books.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                                        data-toggle="tooltip" title="مشاهدة">
                                        <i class="fa fa-eye"></i>
                                      </a>
                                      <a href="{{ route('superAdmin.books.edit', [$book->booksID, 'link' => 1]) }}"
                                        class="btn btn-success btn-xs" data-toggle="tooltip" title="تعديل" style="    padding: 5px;">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <?php  } else if ($book->type == 2) { ?>
                                      <a href="{{ route('admin.etudes.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                                        data-toggle="tooltip" title="مشاهدة">
                                        <i class="fa fa-eye"></i>
                                      </a>
                                      <a href="{{ route('superAdmin.etudes.edit', [$book->booksID, 'link' => 1]) }}"
                                        class="btn btn-success btn-xs" data-toggle="tooltip" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                      </a>
                                      <?php    } else if ($book->type == 0) { ?>

                                      <a href="{{ route('admin.article.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                                        data-toggle="tooltip" title="مشاهدة">
                                        <i class="fa fa-eye"></i>
                                      </a>
                                      <a href="{{ route('superAdmin.article.edit', [$book->booksID, 'link' => 1]) }}"
                                        class="btn btn-success btn-xs" data-toggle="tooltip" title="تعديل">
                                        <i class="fa fa-edit"></i>
                                      </a>
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
      $("#example1").DataTable({
        columnDefs: [
          { targets: [0, 5], searchable: false }
        ]
      });
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