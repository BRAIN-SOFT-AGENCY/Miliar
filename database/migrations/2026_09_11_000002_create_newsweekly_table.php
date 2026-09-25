<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('newsweekly', function (Blueprint $table) {
            $table->id('idnewsweekly');
            $table->unsignedSmallInteger('year');
            $table->unsignedTinyInteger('month');
            $table->unsignedTinyInteger('week');
            $table->string('pdf');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsweekly');
    }
};