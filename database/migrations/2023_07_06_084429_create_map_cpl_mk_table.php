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
        Schema::create('map_cpl_mk', function (Blueprint $table) {
            $table->id("id_map_cpl_mk")->unsigned();
            $table->unsignedInteger('id_cpl');
            $table->unsignedInteger('id_mk');
            $table->foreign('id_cpl')
                ->references('id_cpl')
                ->on('cpl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_mk')
                ->references('id_mk')
                ->on('mata_kuliah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->boolean('active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('map_cpl_mk');
    }
};
