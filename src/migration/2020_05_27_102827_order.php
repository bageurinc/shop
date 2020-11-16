<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('bgr_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk')->index();
            $table->unsignedBigInteger('kota')->index();
            $table->unsignedBigInteger('provinsi')->index();
            $table->string('qty');
            $table->string('nama');
            $table->string('hp');
            $table->string('kodepos');
            $table->text('alamat');
            $table->double('berat');
            $table->double('harga');
            $table->string('kurir');
            $table->string('kurir_cost');
            $table->json('produk');
            $table->string('status')->default('unpaid');
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
        Schema::dropIfExists('bgr_order');
    }
}
