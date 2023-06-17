<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('dosen_penguji_id')->nullable();
            $table->foreign('dosen_penguji_id')->references('dosen_id')->on('dosens')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('mbkm_id')->nullable();
            $table->string('nama');
            $table->string('npm')->unique()->nullable();
            $table->string('email_mhs')->unique();
            $table->string('foto_profil')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('jurusan')->nullable();
            $table->integer('semester')->nullable();
            $table->float('ipk')->nullable();
            $table->enum('periode_smt', ['Ganjil', 'Genap']);
            $table->date('tgl_daftar')->nullable();
            $table->string('status')->nullable();
            $table->string('status_data')->nullable();
            $table->string('status_mhs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
