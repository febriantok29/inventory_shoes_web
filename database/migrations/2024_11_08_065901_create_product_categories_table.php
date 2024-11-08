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
        Schema::create('m_product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Kode kategori sepatu, agar user mudah mengidentifikasi kategori sepatu. Misal: SNE, BOT, SAN, etc.');
            $table->string('name')->comment('Nama kategori sepatu, misal: Sneakers, Boots, Sandals, etc.');
            $table->text('description')->nullable()->comment('Penjelasan singkat mengenai kategori sepatu');
            $table->unsignedBigInteger('created_by')->nullable()->comment('ID user yang membuat data');
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable()->comment('ID user yang terakhir kali mengupdate data');
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable()->comment('ID user yang menghapus data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_product_categories');
    }
};
