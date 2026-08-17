<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">

    <title>إعادة تعيين كلمة المرور</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body>


    <div class="container mt-5">


        <div class="row justify-content-center">

            <div class="col-md-5">


                <div class="card shadow p-4">


                    <h3 class="text-center mb-4">
                        إعادة تعيين كلمة المرور
                    </h3>



                    @if(session('error'))

                        <div class="alert alert-danger">
                            {{session('error')}}
                        </div>

                    @endif



                    <form method="POST" action="{{route('translator.update.password')}}">

                        @csrf


                        <input type="hidden" name="email" value="{{$email}}">

                        <input type="hidden" name="token" value="{{$token}}">



                        <div class="mb-3">

                            <label>
                                كلمة المرور الجديدة
                            </label>

                            <input type="password" name="password" class="form-control" required>

                        </div>




                        <div class="mb-3">

                            <label>
                                تأكيد كلمة المرور
                            </label>

                            <input type="password" name="password_confirmation" class="form-control" required>

                        </div>



                        <button class="btn btn-primary w-100">

                            حفظ كلمة المرور

                        </button>


                    </form>


                </div>


            </div>


        </div>


    </div>


</body>

</html>