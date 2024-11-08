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
        Schema::create('m_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->decimal('price', 15, 2);
            $table->integer('stock')->default(0);
            $table->foreignId('product_category_id')->constrained('m_product_categories')->onDelete('cascade');
            $table->foreignId('supplier_id')->nullable()->constrained('m_suppliers')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_products');
    }
};
