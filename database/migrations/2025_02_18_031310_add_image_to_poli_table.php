<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->string('image')->nullable(); // Menambahkan kolom image
        });
    }
    
    public function down()
    {
        Schema::table('poli', function (Blueprint $table) {
            $table->dropColumn('image'); // Menghapus kolom image jika rollback
        });
    }
    
};
