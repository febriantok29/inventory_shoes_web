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
        Schema::create('t_sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique()->comment('Nomor invoice penjualan');
            $table->unsignedBigInteger('employee_id')->comment('ID karyawan yang melakukan penjualan');
            $table->string('customer_name')->comment('Nama customer yang melakukan pembelian. Boleh kosong jika customer tidak ingin memberikan nama');
            $table->integer('total_amount')->default(0)->comment('Total barang yang terjual');
            $table->integer('total_price')->default(0)->comment('Total harga barang yang terjual');
            $table->date('transaction_date')->comment('Tanggal penjualan');
            $table->text('note')->nullable()->comment('Catatan penjualan jika diperlukan');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            $table->foreign('employee_id')->references('id')->on('m_employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sales');
    }
};
