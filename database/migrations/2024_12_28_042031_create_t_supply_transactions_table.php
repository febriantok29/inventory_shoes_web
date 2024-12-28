<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTSupplyTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('t_supply_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_id')->constrained('m_suppliers')->onDelete('cascade'); // Relasi ke m_suppliers
            $table->timestamp('transaction_date'); // Tanggal transaksi
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_supply_transactions');
    }
}
