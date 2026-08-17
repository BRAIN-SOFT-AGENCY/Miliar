@extends('translator.layouts.app')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> معلومات المترجم
      </h1>
    </section>


    <section class="content">

      <div class="row">

        <div class="col-md-8 col-md-offset-2">

          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">
                بيانات الحساب
              </h3>
            </div>


            <div class="box-body">


              <div class="text-center">

                @if($translator->translatorPicture)

                  <img src="{{ asset('includesAdmin/img/translator/' . $translator->translatorPicture) }}"
                    class="img-circle" width="120" height="120">

                @else

                  <img src="{{ asset('includesAdmin/img/translator/default.jpg') }}" class="img-circle" width="120"
                    height="120">

                @endif

              </div>


              <br>


              <table class="table table-bordered">

                <tr>
                  <th width="30%">الاسم الأول</th>
                  <td>
                    {{ $translator->translatorfirstName }}
                  </td>
                </tr>


                <tr>
                  <th>اللقب</th>
                  <td>
                    {{ $translator->translatorLastName }}
                  </td>
                </tr>


                <tr>
                  <th>البريد الإلكتروني</th>
                  <td>
                    {{ $translator->translatorEmail }}
                  </td>
                </tr>


                <tr>
                  <th>الحالة</th>

                  <td>

                    @if($translator->translatorStatus == 1)

                      <span class="label label-success">
                        مفعل
                      </span>

                    @else

                      <span class="label label-danger">
                        غير مفعل
                      </span>

                    @endif

                  </td>

                </tr>


              </table>

              <div class="row" style="margin-top: 3%;">
                <div class="col-md-4">
                </div>
                <div class="col-md-2">
                  <a href="{{ route('translator.updatepwd') }}" class="btn btn-warning">

                    <i class="fa fa-key"></i>
                    تغيير كلمة المرور

                  </a>
                </div>
                <div class="col-md-4">
                </div>
              </div>



            </div>

          </div>


        </div>

      </div>

    </section>

  </div>

@endsection