<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('m_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Kode unik untuk kategori
            $table->string('name'); // Nama kategori
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_categories');
    }
}
