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
        Schema::create('pengampuan', function (Blueprint $table) {
            $table->id("id_pengampuan")->unsigned();
            $table->foreignId('user_id')->constrained()->onDelete("cascade");
            $table->unsignedInteger('id_mk');

            $table->foreign('id_mk')
                ->references('id_mk')
                ->on('mata_kuliah')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengampuan');
    }
};
