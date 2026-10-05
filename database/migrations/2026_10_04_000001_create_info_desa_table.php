<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('info_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_singkat');            // Jalatrang
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('alamat')->nullable();
            $table->string('telepon', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('maps_url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('info_desa');
    }
};
