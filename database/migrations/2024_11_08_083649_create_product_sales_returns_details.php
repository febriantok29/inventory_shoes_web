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
        Schema::create('t_product_sales_returns_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_sales_return_id')->comment('ID retur penjualan produk');
            $table->unsignedBigInteger('product_id')->comment('ID produk yang terkait');
            $table->integer('quantity')->default(1)->comment('Jumlah barang yang diretur');
            $table->decimal('price', 15, 2)->comment('Harga produk saat diretur');
            $table->decimal('total', 15, 2)->comment('Total harga produk saat diretur');
            $table->string('note', 255)->nullable()->comment('Catatan retur penjualan produk');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            // Foreign keys
            $table->foreign('product_sales_return_id')->references('id')->on('t_product_sales_returns')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_product_sales_returns_details');
    }
};
