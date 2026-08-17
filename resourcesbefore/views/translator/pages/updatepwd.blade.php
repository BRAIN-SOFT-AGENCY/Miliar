@extends('translator.layouts.app')

@section('content')

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        <i class="fa fa-key"></i>
        تغيير كلمة المرور
      </h1>
    </section>


    <section class="content">

      <div class="row">

        <div class="col-md-6 col-md-offset-3">


          <div class="box box-primary">


            <div class="box-body">


              <form method="POST" action="{{ route('translator.updatepwd.store') }}">

                @csrf

                @if($errors->any())

                  <div class="alert alert-danger">

                    <ul>

                      @foreach($errors->all() as $error)

                        <li>
                          {{ $error }}
                        </li>

                      @endforeach

                    </ul>

                  </div>

                @endif
                @if(session('success'))

                  <div class="alert alert-success">
                    <i class="fa fa-check"></i>
                    {{ session('success') }}
                  </div>

                @endif
                <div class="form-group">

                  <label>
                    كلمة المرور الحالية
                  </label>

                  <input type="password" name="old_password" class="form-control">

                </div>


                <div class="form-group">

                  <label>
                    كلمة المرور الجديدة
                  </label>

                  <input type="password" name="password" class="form-control">

                </div>



                <div class="form-group">

                  <label>
                    تأكيد كلمة المرور
                  </label>

                  <input type="password" name="password_confirmation" class="form-control">

                </div>



                <button class="btn btn-success">

                  <i class="fa fa-save"></i>
                  حفظ

                </button>


              </form>


            </div>


          </div>


        </div>

      </div>


    </section>


  </div>


@endsection