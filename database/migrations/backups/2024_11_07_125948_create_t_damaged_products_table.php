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
        Schema::create('t_damaged_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('damage_description')->nullable();
            $table->integer('quantity')->default(1);
            $table->date('reported_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_damaged_products');
    }
};
