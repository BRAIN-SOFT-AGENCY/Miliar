<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('newsmonthly', function (Blueprint $table) {
            $table->id('idnewsMonthly');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->string('pdf');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsmonthly');
    }
};