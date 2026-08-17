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


      <div class="col-md-1"></div>
    </div>

    <section class="content">

      <div class="row">
        <div class="col-md-10 col-md-offset-1">

          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="fa fa-book"></i> إضافة شريك جديد
              </h3>
            </div>

            @if(session('success'))
              <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('success') }}
              </div>
            @endif

            <form action="{{ route('superAdmin.addpartnersList.store') }}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="box-body">

                <div class="row">
                  <div class="col-md-4 text-center">
                  </div>
                  <!-- صورة المترجم -->
                  <div class="col-md-4 text-center">

                    <label>صورة الشريك</label>

                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">

                      <img id="previewImage" src="{{ asset('includesAdmin/img/part/default.jpg') }}"
                        style="width:150px;height:150px;margin-bottom:10px">

                      <input type="file" name="partnersPicture" class="form-control" onchange="preview(event)">

                    </div>

                  </div>
                  <div class="col-md-4 text-center">
                  </div>


                </div>


              </div>

              <div class="box-footer text-center">

                <button type="submit" class="btn btn-success btn-lg">
                  <i class="fa fa-save"></i> حفظ المترجم
                </button>

             

              </div>

            </form>

          </div>
        </div>
      </div>

    </section>
    <script>

      function preview(event) {
        var reader = new FileReader();

        reader.onload = function () {
          var output = document.getElementById('previewImage');
          output.src = reader.result;
        };

        reader.readAsDataURL(event.target.files[0]);

      }

    </script>

  </div>

@endsection

@section('scripts')

@endsection