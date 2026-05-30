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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->id();
            $table->string('nota')->unique(); // generate unique nota.
            $table->dateTime('tanggal_nota');
            $table->foreignId('supplier_id')->constrained('supplier')->cascadeOnDelete();
            $table->unsignedBigInteger('diskon')->default(0);
            $table->unsignedBigInteger('subtotal'); // total harga sebelum diskon
            $table->unsignedBigInteger('total_harga'); // total harga akhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
