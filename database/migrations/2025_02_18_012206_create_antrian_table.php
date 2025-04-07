<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->foreignId('poli_id')->constrained('poli')->onDelete('cascade');
            $table->integer('nomor_antrian');
            $table->enum('status', ['Belum Check-up', 'Sedang Check-up', 'Selesai'])->default('Belum Check-up');
            $table->date('tanggal_antrian')->default(now());
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('antrian');
    }
};
