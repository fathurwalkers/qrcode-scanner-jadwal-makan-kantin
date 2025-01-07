<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();

            $table->date('jadwal_tanggal')->nullable();
            $table->string('jadwal_cek_subuh')->nullable();
            $table->string('jadwal_cek_pagi')->nullable();
            $table->string('jadwal_cek_siang')->nullable();
            $table->string('jadwal_cek_malam')->nullable();
            $table->time('jadwal_jam_subuh')->nullable();
            $table->time('jadwal_jam_pagi')->nullable();
            $table->time('jadwal_jam_siang')->nullable();
            $table->time('jadwal_jam_malam')->nullable();
            $table->string('jadwal_status')->nullable();

            $table->unsignedBigInteger('karyawan_id')->nullable()->default(null);
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->unsignedBigInteger('periode_id')->nullable()->default(null);
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
