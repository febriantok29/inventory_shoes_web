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
        Schema::create('t_product_purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('ID produk yang terkait');
            $table->unsignedBigInteger('supplier_id')->comment('ID supplier yang terkait');
            $table->unsignedBigInteger('transaction_stock_id')->nullable()->comment('Log transaksi stok yang terkait');
            $table->integer('quantity')->default(1)->comment('Jumlah barang yang dibeli');
            $table->decimal('purchase_price', 15, 2)->default(0)->comment('Harga beli per unit');
            $table->decimal('total_cost', 15, 2)->default(0)->comment('Total biaya pembelian');
            $table->date('purchase_date')->comment('Tanggal pembelian');
            $table->text('description')->nullable()->comment('Deskripsi transaksi jika diperlukan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('cascade');
            $table->foreign('transaction_stock_id')->references('id')->on('t_product_stock_transactions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_product_purchases');
    }
};
