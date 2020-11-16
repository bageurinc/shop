<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateKotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_kotas', function (Blueprint $table) {
            $table->bigIncrements('city_id');
            $table->unsignedBigInteger('province_id');
            $table->string('type');
            $table->string('city_name');
            $table->double('postal_code');
            $table->timestamps();
        });

        // DB::unprepared(file_get_contents(__DIR__.'/migration/db/kotas.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_kotas');
    }
}
