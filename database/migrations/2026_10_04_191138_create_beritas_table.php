<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id')->nullable()->constrained('kategori_beritas')->nullOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('isi');
            $table->string('gambar')->nullable();      // nama file di public/assets/images/web_berita
            $table->unsignedInteger('views')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
