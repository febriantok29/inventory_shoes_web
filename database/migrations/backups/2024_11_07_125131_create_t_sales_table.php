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
            $table->string('customer_name')->nullable()->comment('Name of the customer');
            $table->integer('total_amount')->default(0)->comment('Total quantity of items in the sale');
            $table->decimal('total_price', 15, 2)->default(0)->comment('Total price of all items in the sale');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
