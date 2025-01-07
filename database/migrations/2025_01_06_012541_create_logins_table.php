<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('login', function (Blueprint $table) {
            $table->id();

            $table->string('login_nama')->nullable();
            $table->string('login_username')->unique()->nullable();
            $table->string('login_password')->nullable();
            $table->string('login_email')->unique()->nullable();
            $table->string('login_telepon')->nullable();
            $table->text('login_token')->nullable();
            $table->string('login_level')->nullable();
            $table->string('login_status')->nullable();

            $table->unsignedBigInteger('data_id')->nullable()->default(null);
            $table->foreign('data_id')->references('id')->on('data')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
