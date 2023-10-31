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
        Schema::create('rps', function (Blueprint $table) {
            $table->integer('id_rps')->unsigned()->autoIncrement();
            $table->string("no_doc", 20);
            $table->unsignedTinyInteger('revisi');
            $table->unsignedInteger('id_mk');
            $table->foreign('id_mk')
                ->references('id_mk')
                ->on('mata_kuliah')
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
        Schema::dropIfExists('rps');
    }
};
