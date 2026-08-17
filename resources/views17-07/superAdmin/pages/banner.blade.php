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
            <?php if ($countBooks < 5) {
              ?>
            <a href="{{route('superAdmin.pages.addbanner')}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف بانر
            </a>
            <?php
  } else {
              ?>
            <p style="color: red;">تم الوصول إلى الحد الأقصى لعدد البنرات، يرجى حذف بعض البنرات الحالية لإضافة بانر جديد.
            </p>
            <?php
  } ?>


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
              <h3 class="box-title">قائمة الكتب</h3>
            </div>

            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th>عنوان الكتاب</th>
                    <th>اسم المؤلف</th>
                    <th>دار النشر</th>
                    <th>تاريخ الإصدار</th>
                    <th>نسخة الطباعة</th>
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

                      <td>{{ $book->NomAuteur }}</td>


                      <td>{{ $book->MaisonEdition }}</td>

                      <td>{{ $book->DateSortie }}</td>

                      <td>{{ $book->VersionImprimable }}</td>

                      <td>

                        @if($book->pdf_file)
                          <a href="{{ asset('includesAdmin/pdf/books/' . $book->pdf_file) }}" class="btn btn-success btn-xs">
                            تحميل
                          </a>
                        @else
                          <span class="text-muted">لا يوجد</span>
                        @endif

                      </td>

                      <td style="display:flex; gap:5px; justify-content:center;">


                   
                        <a href="{{ route('banner.delete', $book->booksID) }}" class="btn btn-danger btn-xs"
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