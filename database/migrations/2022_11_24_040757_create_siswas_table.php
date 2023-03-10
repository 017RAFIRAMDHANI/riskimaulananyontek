<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // membuat skema tabel di database dengan menggunakan Laravel migration.
        Schema::create('siswa', function (Blueprint $table) {
            //  Kode $table->unique('nis') menandakan bahwa kolom nis harus unik,
            //  artinya tidak boleh ada data duplikat pada kolom ini.
            // table->tipe data = untuk membuat kolom field pada db sesuai tipe data
            $table->integer('nis');
            $table->unique('nis');
            $table->string('nama');
            $table->string('jurusan');
            $table->string('kelas');
            $table->date('TTL');
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
