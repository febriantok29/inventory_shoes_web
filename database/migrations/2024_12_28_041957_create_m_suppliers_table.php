<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama supplier
            $table->string('email')->nullable(); // Email supplier
            $table->string('phone')->nullable(); // Nomor telepon supplier
            $table->string('address')->nullable(); // Alamat supplier
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_suppliers');
    }
}
