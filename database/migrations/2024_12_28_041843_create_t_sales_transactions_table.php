<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSalesTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('t_sales_transactions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('transaction_date'); // Tanggal transaksi
            $table->integer('total_items')->default(0); // Total jumlah barang yang dibeli
            $table->decimal('total_price', 10, 2); // Total harga (sudah dikali jumlah)
            $table->decimal('customer_money', 10, 2); // Uang dari customer
            $table->decimal('change', 10, 2)->nullable(); // Kembalian (jika diperlukan)
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_sales_transactions');
    }
}
