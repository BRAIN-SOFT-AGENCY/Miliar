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

            <a href="{{route('translator.pages.addbookspart', $booksID)}}" class="btn btn-success">
              <i class="fa fa-book"></i> إضافة جزء للكتاب
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
              <h3 class="box-title">قائمة الأجزاء للكتاب </h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> العنوان</th>
                    <th>اسم المؤلف</th>
                    <th>تاريخ الإصدار</th>
                    <th>PDF</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($Bookspart as $book)

                    <tr>

                      <td>
                        <img src="{{ asset('includesAdmin/img/books/' . $book->booksPartImage) }}" width="100">
                      </td>

                      <td>{{ $book->booksPartTitre }}</td>

                      <td>{{ $book->booksPartNomAuteur }}</td>

                      <td>{{ $book->booksPartDateSortie }}</td>


                      <td>

                        @if($book->bookspartpdf_file)
                          <a href="{{ asset('includesAdmin/pdf/books/' . $book->bookspartpdf_file) }}"
                            style="background-color: #d57410;    border-color: #d57410;" target="_blank"
                            class="btn btn-success btn-xs">
                            تحميل
                          </a>
                        @else
                          <span class="text-muted">لا يوجد</span>
                        @endif

                      </td>

                      <td style="display:flex; gap:5px; justify-content:center;">

                        <!-- VIEW -->
                        <a href="{{ route('translator.bookspart.view', $book->booksPartID) }}" class="btn btn-warning btn-xs"
                          title="عرض">
                          <i class="fa fa-eye"></i>
                        </a>

                        <!-- EDIT -->
                        <a href="{{ route('translator.bookspart.edit', $book->booksPartID) }}"
                          class="btn btn-success btn-xs" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('booksPart.delete', $book->booksPartID) }}" class="btn btn-danger btn-xs"
                          onclick="return confirm('هل أنت متأكد من حذف هذا الكتاب؟')" title="حذف">

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