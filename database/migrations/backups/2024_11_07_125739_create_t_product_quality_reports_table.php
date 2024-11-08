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
        Schema::create('t_product_quality_reports', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->text('issue_description')->nullable();
            $table->string('quality_status')->default('poor'); // Status seperti "poor", "damaged", dll.
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
        Schema::dropIfExists('t_product_quality_reports');
    }
};
