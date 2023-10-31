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
        Schema::table('map_pl_cpl', function (Blueprint $table) {
            $table->dropForeign('map_pl_cpl_ibfk_1');
            $table->dropForeign('map_pl_cpl_ibfk_2');
            $table->foreign('id_pl')
                ->references('id_pl')->on('profil_lulusan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_cpl')
                ->references('id_cpl')->on('cpl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('map_cpl_bk', function (Blueprint $table) {
            $table->dropForeign('map_cpl_bk_ibfk_1');
            $table->dropForeign('map_cpl_bk_ibfk_2');
            $table->foreign('id_cpl')
                ->references('id_cpl')->on('cpl')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_bk')
                ->references('id_bk')->on('bahan_kajian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('map_cpmk_mk', function (Blueprint $table) {
            $table->dropForeign('map_cpmk_mk_ibfk_1');
            $table->dropForeign('map_cpmk_mk_ibfk_2');
            $table->foreign('id_cpmk')
                ->references('id_cpmk')->on('cpmk')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_mk')
                ->references('id_mk')->on('mata_kuliah')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        Schema::table('map_bk_mk', function (Blueprint $table) {
            $table->dropForeign('map_bk_mk_ibfk_1');
            $table->dropForeign('map_bk_mk_ibfk_2');
            $table->foreign('id_bk')
                ->references('id_bk')->on('bahan_kajian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_mk')
                ->references('id_mk')->on('mata_kuliah')
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
    }
};
