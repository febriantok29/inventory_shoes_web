<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSupplyTransactionDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('t_supply_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supply_transaction_id')->constrained('t_supply_transactions')->onDelete('cascade'); // Relasi ke t_supply_transactions
            $table->foreignId('product_id')->constrained('m_products')->onDelete('cascade'); // Relasi ke m_products
            $table->integer('quantity'); // Jumlah produk yang disuplai
            $table->decimal('price', 10, 2); // Harga per unit saat suplai
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_supply_transaction_details');
    }
}
