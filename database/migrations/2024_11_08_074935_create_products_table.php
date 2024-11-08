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
        Schema::create('m_products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Seperti SKU, kode produk yang diinputkan oleh user agar mudah mengidentifikasi produk. Misal: AJ untuk Air Jordan, YZ untuk Yeezy, etc.');
            $table->string('name')->comment('Nama produk, misal: Air Jordan, Yeezy, etc.');
            $table->string('size')->nullable()->comment('Ukuran produk jika ada, boleh dikosongkan');
            $table->string('color')->nullable()->comment('Warna produk jika ada, boleh dikosongkan');
            $table->string('image_path')->nullable()->comment('Path gambar produk jika ada, boleh dikosongkan');
            $table->text('description')->nullable()->comment('Keterangan produk jika ada, boleh dikosongkan');
            $table->decimal('price', 15, 2)->default(0)->comment('Harga satuan produk');
            $table->integer('stock')->default(0)->comment('Stok produk');
            $table->unsignedBigInteger('product_category_id')->comment('ID kategori produk');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('ID supplier produk');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');

            $table->foreign('product_category_id')->references('id')->on('m_product_categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('set null');
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
