<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('newsmonthly') && Schema::hasColumn('newsmonthly', 'week')) {
            Schema::table('newsmonthly', function (Blueprint $table) {
                $table->renameColumn('week', 'month');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('newsmonthly') && Schema::hasColumn('newsmonthly', 'month')) {
            Schema::table('newsmonthly', function (Blueprint $table) {
                $table->renameColumn('month', 'week');
            });
        }
    }
};