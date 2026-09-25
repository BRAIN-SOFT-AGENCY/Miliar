@extends('superAdmin.layouts.app')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>تعديل النشرة الأسبوعية</h1>
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
            <form action="{{ route('superAdmin.newsweekly.update', $newsWeekly->idnewsweekly) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="box-body">
                <div class="form-group">
                  <label for="year">السنة</label>
                  <select id="year" name="year" class="form-control" required>
                    @for($year = 2000; $year <= now()->year + 1; $year++)
                      <option value="{{ $year }}" @selected(old('year', $newsWeekly->year) == $year)>{{ $year }}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label for="month">الشهر</label>
                  <select id="month" name="month" class="form-control" required>
                    @foreach(\App\Models\newsweekly::monthNames() as $monthNumber => $monthName)
                      <option value="{{ $monthNumber }}" @selected(old('month', $newsWeekly->month) == $monthNumber)>{{ $monthName }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="week">الأسبوع</label>
                  <select id="week" name="week" class="form-control" required>
                    @foreach(\App\Models\newsweekly::weekNames() as $weekNumber => $weekName)
                      <option value="{{ $weekNumber }}" @selected(old('week', $newsWeekly->week) == $weekNumber)>{{ $weekName }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="title">العنوان</label>
                  <input id="title" type="text" name="title" class="form-control" value="{{ old('title', $newsWeekly->title) }}" required>
                </div>
                <div class="form-group">
                  <label>الصورة الحالية</label>
                  <p><img src="{{ asset('includesAdmin/img/week/' . $newsWeekly->picture) }}" alt="{{ $newsWeekly->title }}" style="max-width:180px;max-height:120px;"></p>
                </div>
                <div class="form-group">
                  <label for="picture">استبدال الصورة (اختياري)</label>
                  <input id="picture" type="file" name="picture" class="form-control" accept="image/jpeg,image/png,image/webp">
                </div>
                <div class="form-group">
                  <label>الملف الحالي</label>
                  <p><a href="{{ asset('includesAdmin/pdf/weekly/' . $newsWeekly->pdf) }}" target="_blank">{{ $newsWeekly->pdf }}</a></p>
                </div>
                <div class="form-group">
                  <label for="pdf">استبدال ملف PDF (اختياري)</label>
                  <input id="pdf" type="file" name="pdf" class="form-control" accept="application/pdf,.pdf">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> حفظ التعديل</button>
                <a href="{{ route('superAdmin.pages.newsweekly') }}" class="btn btn-default">إلغاء</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
