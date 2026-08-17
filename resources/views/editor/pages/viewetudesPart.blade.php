@extends('editor.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1><small></small></h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-eye"></i> مشاهدة جزء الدراسة
                            </h3>
                        </div>

                        <div class="box-body">

                            <!-- Image -->
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <label>صورة الدراسة</label>
                                    <div style="border:1px dashed #ccc;padding:15px;border-radius:10px">
                                        <img src="{{ asset('includesAdmin/img/books/' . ($etudesPart->etudespartImage ?? 'default.jpg')) }}"
                                            style="width:150px;height:150px;margin-bottom:10px">
                                    </div>
                                </div>

                                <div class="col-md-8">

                                    <div class="form-group">
                                        <label>عنوان الدراسة :</label> {{ $etudesPart->etudespartTitre }}


                                    </div>

                                    <div class="form-group">
                                        <label>القسم :</label> {{ $etudesPart->category->categoryName ?? '-' }}

                                    </div>

                                    <div class="form-group">
                                        <label>اسم المؤلف :</label> {{ $etudesPart->etudespartNomAuteur ?? '-' }}

                                    </div>

                                    <div class="form-group">
                                        <label>المصدر :</label> {{ $etudesPart->etudespartMaisonEdition ?? '-' }}


                                    </div>

                                    <div class="form-group">
                                        <label>تاريخ الإصدار :</label> {{ $etudesPart->etudespartDateSortie }}


                                    </div>

                                </div>
                            </div>

                            <hr>

                            <!-- Article -->
                            <div class="form-group">
                                <label>الدراسة</label>
                                <div style="border:1px solid #eee;padding:15px;border-radius:5px">
                                    {!! $etudesPart->etudespartarticle !!}
                                </div>
                            </div>

                            <hr>

                            <!-- Résumé -->
                            <div class="form-group">
                                <label>ملخص الدراسة</label>
                                <div style="border:1px solid #eee;padding:15px;border-radius:5px">
                                    {{ $etudesPart->etudespartResumeLivre }}
                                </div>
                            </div>

                        </div>

                        <div class="box-footer text-center">
                            <a href="{{ route('editor.pages.etudesPart', $etudesPart->booksID) }}"
                                class="btn btn-default btn-lg">
                                <i class="fa fa-arrow-right"></i> رجوع
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection