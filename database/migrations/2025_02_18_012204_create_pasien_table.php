<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('pasien');
    }
};
