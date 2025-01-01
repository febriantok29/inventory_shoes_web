<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSalesTransactionDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('t_sales_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_transaction_id')->constrained('t_sales_transactions')->onDelete('cascade'); // Relasi ke t_sales_transactions
            $table->foreignId('product_detail_id')->constrained('m_product_details')->onDelete('cascade'); // Relasi ke m_product_details
            $table->integer('quantity'); // Jumlah produk yang dibeli
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_sales_transaction_details');
    }
}
