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
        Schema::create('pembelian_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembelian_id')->constrained('pembelian')->cascadeOnDelete(); // kode based on relationship
            $table->foreignId('obat_id')->constrained('obat')->cascadeOnDelete(); // kode based on relationship
            $table->integer('jumlah'); // jumlah obat yang dibeli
            $table->unsignedBigInteger('harga_satuan'); // harga satuan (snapshot, rupiah)
            $table->unsignedBigInteger('subtotal'); // subtotal = harga_satuan * jumlah (rupiah)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian_detail');
    }
};