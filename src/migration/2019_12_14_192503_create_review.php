<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_ecommerce_reviews', function (Blueprint $table) {
            $table->id();
            $table->bigIncrements('id_produk');
            $table->bigIncrements('id_user');
            $table->double('rating');
            $table->text('keterangan');
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
        Schema::dropIfExists('bgr_ecommerce_reviews');
    }
}
