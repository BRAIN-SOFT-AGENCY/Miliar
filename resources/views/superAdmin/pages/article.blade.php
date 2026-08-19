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

            <a href="{{route('superAdmin.pages.addArticle')}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف مقال
            </a>

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
              <h3 class="box-title">قائمة المقالات</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th>عنوان المقال</th>
                    <th>الملخص </th>
                    <th>الصنف</th>
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

                      <td>{{ $book->category->categoryName }}</td>

                      <td>{{ $book->translator->translatorfirstName }} {{ $book->translator->translatorlastName }}</td>

                      <td style="display:flex; gap:5px; justify-content:center;">
                        <a href="{{ route('admin.article.view', $book->booksID) }}" class="btn btn-warning btn-xs"
                          data-toggle="tooltip" title="مشاهدة">
                          <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('superAdmin.article.edit', [$book->booksID, 'link' => 0]) }}"
                          class="btn btn-success btn-xs" data-toggle="tooltip" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-xs"
                          style="background-color:#a1038d;border-color:#a1038d;" data-toggle="modal"
                          data-target="#publishModal{{ $book->booksID }}" style="    padding: 5px;">
                          <i class="fa fa-share"></i>
                        </button>
                        <div class="modal fade" id="publishModal{{ $book->booksID }}" tabindex="-1" role="dialog"
                          aria-hidden="true">
                          <div class="modal-dialog" role="document">

                            <div class="modal-content">

                              <form action="{{ route('books.publish', $book->booksID) }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                  <h5 class="modal-title">اختر تاريخ النشر
                                  </h5>

                                  <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                  </button>

                                </div>

                                <div class="modal-body">

                                  <label>تاريخ النشر</label>

                                  <input type="datetime-local" name="PublierLe" class="form-control"
                                    value="{{ date('Y-m-d\TH:i') }}" required>

                                </div>

                                <div class="modal-footer">
                                  <button type="submit" class="btn btn-primary">
                                    إضافة
                                  </button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                    إلغاء
                                  </button>



                                </div>

                              </form>

                            </div>

                          </div>
                        </div>

                        <a href="{{ route('books.delete', $book->booksID) }}" class="btn btn-danger btn-xs"
                          onclick="return confirm('هل أنت متأكد من حذف هذا المقال؟')" data-toggle="tooltip" title="حذف">

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