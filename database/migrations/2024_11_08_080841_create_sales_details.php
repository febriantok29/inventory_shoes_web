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
        Schema::create('t_sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sales_id'); // Relasi ke t_sales
            $table->unsignedBigInteger('product_id'); // Relasi ke m_products
            $table->integer('quantity')->default(1);
            $table->decimal('price', 15, 2);
            $table->decimal('total', 15, 2);
            $table->string('note', 255)->nullable()->comment('Catatan penjualan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            // Foreign keys
            $table->foreign('sales_id')->references('id')->on('t_sales')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sales_details');
    }
};
