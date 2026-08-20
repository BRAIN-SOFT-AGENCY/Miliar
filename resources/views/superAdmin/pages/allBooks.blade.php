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
                    <th>البانر</th>
                    <th>حديث الساعة
                    </th>
                    <th>اخترنا لك
                    </th>
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
                                    <style>
                                      .resume-3-lines {
                                        display: -webkit-box;
                                        -webkit-line-clamp: 3;
                                        -webkit-box-orient: vertical;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                      }
                                    </style>
                                    <td>
                                      <div class="resume-3-lines">
                                        {{ $book->ResumeLivre }}
                                      </div>
                                    </td>


                                    <td>{{ optional($book->category)->categoryName }}</td>
                                    <td>{{ optional($book->translator)->translatorfirstName }}
                                      {{ optional($book->translator)->translatorlastName }}
                                    </td>
                                    <style>
                                      .switch {
                                        position: relative;
                                        display: inline-block;
                                        width: 50px;
                                        height: 26px;
                                        margin: 0;
                                      }

                                      .switch input {
                                        opacity: 0;
                                        width: 0;
                                        height: 0;
                                      }

                                      .slider {
                                        position: absolute;
                                        cursor: pointer;
                                        top: 0;
                                        left: 0;
                                        right: 0;
                                        bottom: 0;
                                        background-color: #ccc;
                                        transition: .3s;
                                        border-radius: 30px;
                                      }

                                      .slider:before {
                                        position: absolute;
                                        content: "";
                                        height: 20px;
                                        width: 20px;
                                        left: 3px;
                                        bottom: 3px;
                                        background-color: white;
                                        transition: .3s;
                                        border-radius: 50%;
                                      }

                                      .switch input:checked+.slider {
                                        background-color: #28a745;
                                      }

                                      .switch input:checked+.slider:before {
                                        transform: translateX(24px);
                                      }
                                    </style>
                                    <td>
                                      <label class="switch">
                                        <input type="checkbox" class="book-option-toggle" data-id="{{ $book->booksID }}"
                                          data-field="isbanner" {{ $book->isbanner == 1 ? 'checked' : '' }}>

                                        <span class="slider"></span>
                                      </label>
                                    </td>
                                    <td>
                                      <label class="switch">
                                        <input type="checkbox" class="book-option-toggle" data-id="{{ $book->booksID }}"
                                          data-field="conversation" {{ $book->conversation == 1 ? 'checked' : '' }}>

                                        <span class="slider"></span>
                                      </label>
                                    </td>

                                    <td>
                                      <label class="switch">
                                        <input type="checkbox" class="book-option-toggle" data-id="{{ $book->booksID }}"
                                          data-field="selection" {{ $book->selection == 1 ? 'checked' : '' }}>

                                        <span class="slider"></span>
                                      </label>
                                    </td>
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
              <style>
                .pagination {
                  display: flex !important;
                  justify-content: center !important;
                  align-items: center !important;
                  margin: 20px 0 !important;
                  padding-left: 0 !important;
                  list-style: none !important;
                  border-radius: 4px !important;
                  gap: 0 !important;
                }

                .pagination>li {
                  display: inline !important;
                }

                .pagination>li>a,
                .pagination>li>span {
                  position: relative !important;
                  float: left !important;
                  padding: 6px 12px !important;
                  margin-left: -1px !important;
                  line-height: 1.42857143 !important;
                  color: #337ab7 !important;
                  text-decoration: none !important;
                  background-color: #fff !important;
                  border: 1px solid #ddd !important;
                  font-size: 14px !important;
                }

                /* Premier bouton : Previous */
                .pagination>li:first-child>a,
                .pagination>li:first-child>span {
                  margin-left: 0 !important;
                  border-top-left-radius: 4px !important;
                  border-bottom-left-radius: 4px !important;
                }

                /* Dernier bouton : Next */
                .pagination>li:last-child>a,
                .pagination>li:last-child>span {
                  border-top-right-radius: 4px !important;
                  border-bottom-right-radius: 4px !important;
                }

                /* Page sélectionnée */
                .pagination>.active>a,
                .pagination>.active>span,
                .pagination>.active>a:hover,
                .pagination>.active>span:hover,
                .pagination>.active>a:focus,
                .pagination>.active>span:focus {
                  z-index: 3 !important;
                  color: #fff !important;
                  cursor: default !important;
                  background-color: #337ab7 !important;
                  border-color: #337ab7 !important;
                }

                /* Hover */
                .pagination>li>a:hover,
                .pagination>li>span:hover,
                .pagination>li>a:focus,
                .pagination>li>span:focus {
                  z-index: 2 !important;
                  color: #23527c !important;
                  background-color: #eee !important;
                  border-color: #ddd !important;
                }

                /* Previous / Next désactivé */
                .pagination>.disabled>span,
                .pagination>.disabled>span:hover,
                .pagination>.disabled>span:focus,
                .pagination>.disabled>a,
                .pagination>.disabled>a:hover,
                .pagination>.disabled>a:focus {
                  color: #777 !important;
                  cursor: not-allowed !important;
                  background-color: #fff !important;
                  border-color: #ddd !important;
                }
              </style>

              <div class="d-flex justify-content-center mt-3">
                {{ $books->links() }}
              </div>
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
      /*  $("#example1").DataTable({
          columnDefs: [
            { targets: [0, 5], searchable: false }
          ]
        });*/
      $("#example1").DataTable({
        "paging": false,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
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
  <script>
    $(document).on('change', '.book-option-toggle', function () {

      let checkbox = $(this);

      let booksID = checkbox.data('id');
      let field = checkbox.data('field');

      let value = checkbox.is(':checked') ? 1 : 0;

      $.ajax({

        url: "{{ route('superAdmin.books.toggleOption') }}",

        type: "POST",

        data: {
          _token: "{{ csrf_token() }}",
          booksID: booksID,
          field: field,
          value: value
        },

        success: function (response) {

          if (response.success) {

            $('#countBooks').text(response.countBooks);

            $('#countconversation').text(response.countconversation);

            $('#countselection').text(response.countselection);

            console.log(
              'Book ID:', booksID,
              'Field:', response.field,
              'Value:', response.value
            );

          } else {

            checkbox.prop('checked', false);

            alert(response.message);
          }
        },

        error: function (xhr) {

          checkbox.prop(
            'checked',
            !checkbox.is(':checked')
          );

          console.log(xhr.responseText);

          if (xhr.responseJSON && xhr.responseJSON.message) {

            alert(xhr.responseJSON.message);

          } else {

            alert('حدث خطأ أثناء تحديث البيانات');
          }
        }
      });

    });
  </script>
@endsection