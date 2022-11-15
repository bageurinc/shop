<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProvinsisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_provinsis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('province');
            $table->timestamps();
            $table->softDeletes();
        });
        DB::unprepared(file_get_contents(__DIR__.'/db/bgr_provinsis.sql'));

        // $provinsi        = base_path('db/provinsis.sql');
        // DB::unprepared(file_get_contents(__DIR__.'/migration/db/provinsis.sql'));

        // $kota = base_path('db/kotas.sql');
        // DB::unprepared(file_get_contents($kota));

        // $kecamatan = base_path('db/kecamatans.sql');
        // DB::unprepared(file_get_contents($kecamatan));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_provinsis');
    }
}
