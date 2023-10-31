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
        Schema::create('indikator_deskripsi_rps', function (Blueprint $table) {
            $table->integer('id_indikator_deskripsi_rps')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_deskripsi_rps');
            $table->foreign('id_deskripsi_rps')
                ->references('id_deskripsi_rps')
                ->on('deskripsi_rps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger('id_sub_cpmk');
            $table->foreign('id_sub_cpmk')
                ->references('id_sub_cpmk')
                ->on('sub_cpmk')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('indikator_deskripsi_rps');
    }
};
