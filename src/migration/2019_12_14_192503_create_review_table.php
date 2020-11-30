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
            $table->unsignedBigInteger('id_produk');
            $table->unsignedBigInteger('id_user');
            $table->string('nama');
            $table->string('email');
            $table->double('rating');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
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
