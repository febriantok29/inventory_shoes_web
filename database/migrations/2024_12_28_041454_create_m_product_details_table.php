<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMProductDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('m_product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('m_products')->onDelete('cascade'); // Relasi ke m_products
            $table->string('size'); // Ukuran produk
            $table->string('color'); // Warna produk
            $table->string('note')->nullable(); // Catatan tambahan
            $table->integer('stock')->default(0); // Stok untuk detail produk
            $table->decimal('price', 10, 2); // Harga per unit
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_product_details');
    }
}
