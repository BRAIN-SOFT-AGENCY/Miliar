<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('translator_reset_tokens', function (Blueprint $table) {

            $table->id();

            $table->string('translatorEmail');

            $table->string('token', 100);

            $table->timestamp('created_at')->nullable();

            $table->index('translatorEmail');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('translator_reset_tokens');
    }
};