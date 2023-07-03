<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
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
        DB::unprepared(file_get_contents("sql/db_kurikulum_obe_20230209_design.sql"));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_cpmk');
        Schema::dropIfExists('map_pl_cpl');
        Schema::dropIfExists('map_cpl_bk');
        Schema::dropIfExists('map_cpmk_mk');
        Schema::dropIfExists('map_bk_mk');
        Schema::dropIfExists('mata_kuliah');
        Schema::dropIfExists('cpmk');
        Schema::dropIfExists('bahan_kajian');
        Schema::dropIfExists('cpl');
        Schema::dropIfExists('profil_lulusan');
        Schema::dropIfExists('prodi');
    }
};
