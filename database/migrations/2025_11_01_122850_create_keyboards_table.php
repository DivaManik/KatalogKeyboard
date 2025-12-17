<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyboardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyboards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name'); // Nama keyboard
            $table->string('brand'); // Brand keyboard
            $table->string('switch_type')->nullable(); // Jenis switch
            $table->string('layout')->nullable(); // Layout, misal 60%, TKL, dll
            $table->enum('connection', ['wired', 'wireless', 'hybrid'])->default('wired'); // Jenis koneksi
            $table->boolean('hot_swappable')->default(false); // Apakah hot-swappable
            $table->integer('price')->nullable(); // Harga dalam rupiah
            $table->date('release_date')->nullable(); // Tanggal rilis
            $table->text('description')->nullable(); // Deskripsi produk
            $table->string('image_url')->nullable(); // Gambar produk
            $table->string('buy_link')->nullable(); // Link pembelian
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
        Schema::dropIfExists('keyboards');
    }
}
