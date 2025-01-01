<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMProductsTable extends Migration
{
    public function up()
    {
        Schema::create('m_products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->string('code')->unique(); // Kode unik untuk produk
            $table->text('description')->nullable(); // Deskripsi produk
            $table->foreignId('category_id')->constrained('m_categories')->onDelete('cascade'); // Relasi ke m_categories
            $table->integer('total_stock')->default(0); // Total stok produk
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_products');
    }
}
