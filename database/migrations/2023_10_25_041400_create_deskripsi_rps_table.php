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
        Schema::create('deskripsi_rps', function (Blueprint $table) {
            $table->integer('id_deskripsi_rps')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_rps');
            $table->unsignedSmallInteger('pertemuan');
            $table->unsignedInteger('id_bk')->nullable();
            $table->string('bentuk_pembelajaran_synchronous', 256)->nullable();
            $table->string('bentuk_pembelajaran_asynchronous', 256)->nullable();
            $table->text('waktu')->nullable();
            $table->text('tugas_dan_penilaian')->nullable();
            $table->timestamps();

            $table->foreign('id_rps')
                ->references('id_rps')
                ->on('rps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_bk')
                ->references('id_bk')
                ->on('bahan_kajian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deskripsi_rps');
    }
};
