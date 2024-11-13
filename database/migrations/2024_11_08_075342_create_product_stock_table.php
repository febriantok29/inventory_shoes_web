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
        Schema::create('t_product_stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('ID produk yang terkait');
            $table->enum('type', ['IN', 'OUT'])->comment('Tipe transaksi, IN untuk barang masuk, OUT untuk barang keluar');
            $table->integer('quantity')->default(0)->comment('Jumlah barang yang masuk/keluar');
            $table->text('description')->nullable()->comment('Deskripsi transaksi jika diperlukan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_product_stock_transactions');
    }
};
