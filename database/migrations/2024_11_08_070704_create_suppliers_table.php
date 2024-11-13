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
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->comment('Kode supplier, diinputkan oleh user agar mudah mengidentifikasi supplier. Misal: GUD, SUP, etc.');
            $table->string('name')->comment('Nama supplier, misal: PT. ABC, CV. XYZ, etc.');
            $table->text('address')->nullable()->comment('Alamat supplier');
            $table->string('contact_number')->nullable()->comment('Nomor telepon supplier');
            $table->string('email')->nullable()->comment('Alamat email supplier');
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
        Schema::dropIfExists('m_suppliers');
    }
};
