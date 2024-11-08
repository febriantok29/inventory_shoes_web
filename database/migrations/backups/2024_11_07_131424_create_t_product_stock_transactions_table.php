<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('t_product_stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->integer('quantity');
            $table->enum('transaction_type', ['addition', 'reduction']);
            $table->date('transaction_date');
            $table->timestamps();
            $table->softDeletes();
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
