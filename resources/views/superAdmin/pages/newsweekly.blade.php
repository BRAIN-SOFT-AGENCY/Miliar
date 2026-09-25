@extends('superAdmin.layouts.app')

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>النشرات الأسبوعية</h1>
    </section>

    <section class="content">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="    direction: ltr;">
              <a href="{{ route('superAdmin.pages.addNewsWeekly') }}" class="btn btn-success">
                <i class="fa fa-plus"></i> إضافة نشرة أسبوعية
              </a>
            </div>
            <div class="box-body">
              <table id="weeklyTable" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>السنة</th>
                    <th>الشهر</th>
                    <th>الأسبوع</th>
                    <th>PDF</th>
                    <th>الإجراءات</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($newsWeekly as $weekly)
                    <tr>
                      <td>{{ $weekly->year }}</td>
                      <td>{{ $weekly->month_name }}</td>
                      <td>{{ $weekly->week_name }}</td>
                      <td>
                        <a href="{{ asset('includesAdmin/pdf/weekly/' . $weekly->pdf) }}" target="_blank" class="btn btn-info btn-xs">
                          <i class="fa fa-file-pdf-o"></i> فتح PDF
                        </a>
                      </td>
                      <td>
                        <a href="{{ route('superAdmin.newsweekly.edit', $weekly->idnewsweekly) }}" class="btn btn-warning btn-xs" title="تعديل">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{ route('superAdmin.newsweekly.delete', $weekly->idnewsweekly) }}" class="btn btn-danger btn-xs" title="حذف" onclick="return confirm('هل أنت متأكد من حذف هذه النشرة؟')">
                          <i class="fa fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('scripts')
  <script>
    $(function () {
      $('#weeklyTable').DataTable();
    });
  </script>
@endsection
