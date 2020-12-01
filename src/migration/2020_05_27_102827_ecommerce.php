<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use App\User;
class Ecommerce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bgr_kategori_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->index();
            $table->string('nama');
            $table->string('status')->default('aktif');
            $table->string('gambar')->nullable();
            $table->string('gambar_path')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bgr_sub_kategori_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_parent');
            $table->string('nama');
            $table->string('status')->default('aktif');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('bgr_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kategori')->index();
            $table->unsignedBigInteger('umkm_id')->index();
            $table->string('nama');
            $table->text('nama_seo');
            $table->double('berat');
            $table->double('stok')->nullable();
            $table->double('harga_jual')->nullable();
            $table->double('harga_modal')->nullable();
            $table->text('keterangan');
            $table->json('variant')->nullable();
            $table->boolean('preorder')->default(false);
            $table->text('gambar1');
            $table->text('gambar2')->nullable();
            $table->text('gambar3')->nullable();
            $table->text('gambar4')->nullable();
            $table->text('gambar5')->nullable();
            $table->text('gambar_path');
            $table->string('status')->default('aktif');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('email');
            $table->double('hp')->after('email');
            $table->text('alamat')->after('email')->nullable();
            $table->enum('jenis_kelamin',['pria','wanita'])->after('email')->nullable();
            $table->softDeletes();
        });

        $user = new User;
        $user->id               = 1;
        $user->name             = 'Ginanjar Maulana';
        $user->email            = 'ginda@bageur.id';
        $user->password         = Hash::make('123123');
        $user->username         = 'sesaat';
        $user->hp               = '085717133900';
        $user->alamat           = 'jl pancasan baru';
        $user->jenis_kelamin    = 'pria';
        $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bgr_kategori_produk');
        Schema::dropIfExists('bgr_produk');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('hp');
            $table->dropColumn('alamat');
            $table->dropColumn('jenis_kelamin');
        });
    }
}
