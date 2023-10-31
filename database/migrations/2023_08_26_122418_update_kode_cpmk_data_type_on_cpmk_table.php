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
        Schema::table('cpmk', function (Blueprint $table) {
            $table->dropColumn('kode_cpmk');
        });
        Schema::table('cpmk', function (Blueprint $table) {
            $table->string('kode_cpmk', 7)->after('id_cpl');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
