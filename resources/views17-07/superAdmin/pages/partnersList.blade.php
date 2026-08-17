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
            <a href="{{route('superAdmin.addpartnersList')}}" class="btn btn-success">
              <i class="fa fa-book"></i> أضف شريك
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
              <h3 class="box-title">قائمة الشركاء</h3>
            </div>

            <div class="box-body">

              <table id="example1" class="table table-bordered table-striped">

                <thead>
                  <tr>
                    <th> الصورة </th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($partners as $partner)

                    <tr>

                      <td>
                        <img src="{{ asset('includesAdmin/img/part/' . $partner->partnersPicture) }}" width="100">
                      </td>




                      <td style="display:flex; gap:5px; justify-content:center;">



                        <a href="{{ route('partnersList.delete', $partner->partnersID) }}" class="btn btn-danger btn-xs"
                          onclick="return confirm('هل أنت متأكد من حذف هذا الشريك')" data-toggle="tooltip" title="حذف شريك">

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