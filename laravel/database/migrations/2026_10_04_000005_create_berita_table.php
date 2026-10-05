<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->string('gambar')->nullable();      // nama file di public/assets/images/web_berita
            $table->foreignId('kategori_id')->nullable()
                  ->constrained('kategori_berita')->nullOnDelete();
            $table->dateTime('tanggal')->index();
            $table->unsignedInteger('views')->default(0);
            $table->string('status', 20)->default('published')->index(); // published | draft
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
