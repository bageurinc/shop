<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateKecamatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_kecamatans', function (Blueprint $table) {
            $table->bigIncrements('subdistrict_id');
            $table->unsignedBigInteger('city_id');
            $table->string('subdistrict_name');
            $table->timestamps();
        });

        // DB::unprepared(file_get_contents(__DIR__.'/migration/db/kecamatans.sql'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_kecamatans');
    }
}
