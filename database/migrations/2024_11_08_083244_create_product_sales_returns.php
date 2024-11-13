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
        Schema::create('t_product_sales_returns', function (Blueprint $table) {
            $table->id();
            // In sales named `Invoice`, what is `code` for in this table?
            $table->string('code')->unique()->comment('Otomatis diisi oleh sistem berdasarkan format: PR-<bulan><tahun>/<sales_id>/{increment}. Misal: PR-112021/1/1');
            $table->unsignedBigInteger('sales_id')->comment('ID penjualan yang terkait');
            $table->date('return_date')->comment('Tanggal pengembalian barang');
            $table->integer('total_quantity')->default(0)->comment('Total barang yang dikembalikan');
            $table->decimal('total_price', 15, 2)->default(0)->comment('Total harga barang yang dikembalikan');
            $table->decimal('total', 15, 2)->default(0)->comment('Total harga dikali jumlah barang yang dikembalikan');
            $table->string('note', 255)->nullable()->comment('Catatan pengembalian barang');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            // Foreign keys
            $table->foreign('sales_id')->references('id')->on('t_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_product_sales_returns');
    }
};
