<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('t_product_quality_reports', function (Blueprint $table) {
            // Menambahkan relasi ke m_products
            if (!Schema::hasColumn('t_product_quality_reports', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
                $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            }

            // Menambahkan kolom tambahan untuk laporan kualitas
            if (!Schema::hasColumn('t_product_quality_reports', 'report_date')) {
                $table->date('report_date')->after('product_id')->comment('Tanggal laporan kualitas');
            }

            if (!Schema::hasColumn('t_product_quality_reports', 'quality_issue')) {
                $table->text('quality_issue')->nullable()->after('report_date')->comment('Deskripsi masalah kualitas');
            }

            if (!Schema::hasColumn('t_product_quality_reports', 'quality_status')) {
                $table->enum('quality_status', ['acceptable', 'damaged', 'needs_restock'])->default('acceptable')->after('quality_issue')->comment('Status kualitas produk');
            }

            // Menambahkan kolom reported_by jika ingin mencatat pelapor (opsional)
            if (!Schema::hasColumn('t_product_quality_reports', 'reported_by')) {
                $table->unsignedBigInteger('reported_by')->nullable()->after('quality_status');
                $table->foreign('reported_by')->references('id')->on('m_employees')->onDelete('set null');
            }

            // Menghapus kolom product_name jika ada
            if (Schema::hasColumn('t_product_quality_reports', 'product_name')) {
                $table->dropColumn('product_name');
            }
        });
    }

    public function down()
    {
        Schema::table('t_product_quality_reports', function (Blueprint $table) {
            // Mengembalikan perubahan jika dilakukan rollback
            if (Schema::hasColumn('t_product_quality_reports', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('t_product_quality_reports', 'report_date')) {
                $table->dropColumn('report_date');
            }

            if (Schema::hasColumn('t_product_quality_reports', 'quality_issue')) {
                $table->dropColumn('quality_issue');
            }

            if (Schema::hasColumn('t_product_quality_reports', 'quality_status')) {
                $table->dropColumn('quality_status');
            }

            if (Schema::hasColumn('t_product_quality_reports', 'reported_by')) {
                $table->dropForeign(['reported_by']);
                $table->dropColumn('reported_by');
            }

            // Menambahkan kembali kolom product_name jika dihapus
            $table->string('product_name')->nullable();
        });
    }
};
