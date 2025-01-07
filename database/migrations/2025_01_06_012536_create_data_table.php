<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();

            $table->string('data_nama')->nullable();
            $table->string('data_no_id_card')->nullable();
            $table->string('data_divisi')->nullable();
            $table->string('data_dept')->nullable();
            $table->string('data_jabatan')->nullable();
            $table->text('data_qr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
