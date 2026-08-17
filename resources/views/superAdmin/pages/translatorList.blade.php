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
            <a href="{{route('superAdmin.pages.addtranslatorList')}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف مترجم
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
              <h3 class="box-title">قائمة المترجمين</h3>
            </div>

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th> الاسم الأول </th>
                    <th> الاسم الثاني</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($Translators as $Translator)

                                  <tr>

                                    <td>
                                      <img src="{{ asset('includesAdmin/img/translator/' . $Translator->translatorPicture) }}"
                                        width="100">
                                    </td>

                                    <td>{{ $Translator->translatorfirstName }}</td>

                                    <td>{{ $Translator->translatorLastName }}</td>


                                    <td style="display:flex; gap:5px; justify-content:center;">

                                      <?php  if ($Translator->translatorStatus == 0) {
                                      ?>
                                      <a href="{{ route('translatorList.accepted', $Translator->translatorID) }}"
                                        class="btn btn-success btn-xs" onclick="return confirm('هل أنت متأكد من إضافة هذا المترجم')"
                                        data-toggle="tooltip" title="إضافة مترجم">

                                        <i class="fa fa-check"></i>

                                      </a>
                                      <?php
                    } else {

                    } ?>

                                      <a href="{{ route('translatorList.delete', $Translator->translatorID) }}"
                                        class="btn btn-danger btn-xs" onclick="return confirm('هل أنت متأكد من حذف هذا المترجم')"
                                        data-toggle="tooltip" title="حذف مترجم">

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