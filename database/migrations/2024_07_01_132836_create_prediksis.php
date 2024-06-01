<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prediksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_produk')->unsigned()->nullable();
            $table->bigInteger('id_filter_penjualan_perbulan')->unsigned()->nullable();
            $table->string('nama');
            $table->string('id_kategori');
            $table->integer('harga');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prediksis');
    }
};
