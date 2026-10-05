<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('medsos', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('url');
            $table->string('ikon')->nullable();   // nama file di public/assets/images/medsos
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('medsos');
    }
};
