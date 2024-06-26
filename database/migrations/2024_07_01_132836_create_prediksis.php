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
            $table->string('nama');
            $table->bigInteger('id_kategori')->unsigned()->nullable();
            $table->bigInteger('id_periode')->unsigned()->nullable();
            $table->decimal('ma')->nullable();
            $table->decimal('mad')->nullable();
            $table->decimal('mse')->nullable();
            $table->decimal('mape')->nullable();
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
