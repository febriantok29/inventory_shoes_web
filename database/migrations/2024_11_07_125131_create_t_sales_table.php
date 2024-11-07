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
         Schema::create('t_sales', function (Blueprint $table) {
             $table->id();
             $table->date('sale_date');
             $table->string('customer_name');
             $table->decimal('total_amount', 15, 2);
             $table->timestamps();
             $table->softDeletes();
         });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sales');
    }
};
