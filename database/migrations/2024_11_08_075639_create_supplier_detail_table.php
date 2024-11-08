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
        Schema::create('m_supplier_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->comment('ID supplier yang terkait');
            $table->unsignedBigInteger('product_id')->comment('ID produk yang terkait');
            $table->string('is_available', 1)->default('Y')->comment('Status ketersediaan produk di supplier, Y: available, N: not available');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_supplier_details');
    }
};
