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
        Schema::create('rujukan_rps', function (Blueprint $table) {
            $table->integer('id_rujukan_rps')->unsigned()->autoIncrement();
            $table->unsignedInteger('id_rps');
            $table->foreign('id_rps')
                ->references('id_rps')
                ->on('rps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->text('rujukan');
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
        Schema::dropIfExists('rujukan_rps');
    }
};
