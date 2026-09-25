@extends('superAdmin.layouts.app')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>إضافة نشرة شهرية</h1>
    </section>

    <section class="content">
      @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="box box-primary">
            <form action="{{ route('superAdmin.newsMonthly.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="year">السنة</label>
                  <select id="year" name="year" class="form-control" required>
                    <option value="">اختر السنة</option>
                    @for($year = 2000; $year <= now()->year + 1; $year++)
                      <option value="{{ $year }}" @selected(old('year', now()->year) == $year)>{{ $year }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label for="month">الشهر</label>
                  <select id="month" name="month" class="form-control" required>
                    <option value="">اختر الشهر</option>
                    @foreach(\App\Models\newsmonthly::monthNames() as $monthNumber => $monthName)
                      <option value="{{ $monthNumber }}" @selected(old('month') == $monthNumber)>{{ $monthName }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="title">العنوان</label>
                  <input id="title" type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                  <label for="picture">الصورة</label>
                  <input id="picture" type="file" name="picture" class="form-control" accept="image/jpeg,image/png,image/webp" required>
                </div>
                <div class="form-group">
                  <label for="pdf">ملف PDF</label>
                  <input id="pdf" type="file" name="pdf" class="form-control" accept="application/pdf,.pdf" required>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> حفظ</button>
                <a href="{{ route('superAdmin.pages.newsMonthly') }}" class="btn btn-default">إلغاء</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
