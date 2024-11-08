<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Update Product Categories
        Schema::table('m_product_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('m_product_categories', 'description')) {
                $table->text('description')->nullable()->after('name')->comment('Description of the product category');
            }
        });

        // Update Products
        Schema::table('m_products', function (Blueprint $table) {
            if (!Schema::hasColumn('m_products', 'product_category_id')) {
                $table->unsignedBigInteger('product_category_id')->after('id');
                $table->foreign('product_category_id')->references('id')->on('m_product_categories')->onDelete('cascade');
            }

            if (!Schema::hasColumn('m_products', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->after('product_category_id');
                $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('set null');
            }
        });

        // Update Sales
        Schema::table('t_sales', function (Blueprint $table) {
            if (!Schema::hasColumn('t_sales', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
                $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            }

            if (!Schema::hasColumn('t_sales', 'employee_id')) {
                $table->unsignedBigInteger('employee_id')->nullable()->after('product_id');
                $table->foreign('employee_id')->references('id')->on('m_employees')->onDelete('set null');
            }

            if (!Schema::hasColumn('t_sales', 'quantity')) {
                $table->integer('quantity')->default(1)->after('employee_id');
            }

            if (!Schema::hasColumn('t_sales', 'total_price')) {
                $table->decimal('total_price', 15, 2)->default(0)->after('quantity');
            }
        });

        // Update Damaged Products
        Schema::table('t_damaged_products', function (Blueprint $table) {
            if (!Schema::hasColumn('t_damaged_products', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
                $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            }

            if (!Schema::hasColumn('t_damaged_products', 'reported_by')) {
                $table->unsignedBigInteger('reported_by')->nullable()->after('product_id');
                $table->foreign('reported_by')->references('id')->on('m_employees')->onDelete('set null');
            }

            if (!Schema::hasColumn('t_damaged_products', 'reason')) {
                $table->text('reason')->nullable()->after('reported_by')->comment('Reason for product damage');
            }
        });

        // Update Product Stock Transactions
        Schema::table('t_product_stock_transactions', function (Blueprint $table) {
            if (!Schema::hasColumn('t_product_stock_transactions', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
                $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            }

            if (!Schema::hasColumn('t_product_stock_transactions', 'transaction_type')) {
                $table->enum('transaction_type', ['in', 'out'])->after('product_id')->comment('Type of stock transaction');
            }

            if (!Schema::hasColumn('t_product_stock_transactions', 'quantity')) {
                $table->integer('quantity')->after('transaction_type')->default(0);
            }
        });

        // Update Product Purchases
        Schema::table('t_product_purchases', function (Blueprint $table) {
            if (!Schema::hasColumn('t_product_purchases', 'product_id')) {
                $table->unsignedBigInteger('product_id')->after('id');
                $table->foreign('product_id')->references('id')->on('m_products')->onDelete('cascade');
            }

            if (!Schema::hasColumn('t_product_purchases', 'supplier_id')) {
                $table->unsignedBigInteger('supplier_id')->nullable()->after('product_id'); // Mengizinkan NULL
                $table->foreign('supplier_id')->references('id')->on('m_suppliers')->onDelete('set null');
            }

            if (!Schema::hasColumn('t_product_purchases', 'quantity')) {
                $table->integer('quantity')->default(1)->after('supplier_id');
            }

            if (!Schema::hasColumn('t_product_purchases', 'total_cost')) {
                $table->decimal('total_cost', 15, 2)->default(0)->after('quantity');
            }
        });

        // Update Product Sales Returns
        Schema::table('t_product_sales_returns', function (Blueprint $table) {
            if (!Schema::hasColumn('t_product_sales_returns', 'sale_id')) {
                $table->unsignedBigInteger('sale_id')->after('id');
                $table->foreign('sale_id')->references('id')->on('t_sales')->onDelete('cascade');
            }

            if (!Schema::hasColumn('t_product_sales_returns', 'reason')) {
                $table->text('reason')->nullable()->after('sale_id')->comment('Reason for product return');
            }
        });
    }

    public function down()
    {
        // Hapus foreign key di tabel terkait tanpa menghapus tabel m_products

        // t_sales
        Schema::table('t_sales', function (Blueprint $table) {
            if (Schema::hasColumn('t_sales', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('t_sales', 'employee_id')) {
                $table->dropForeign(['employee_id']);
                $table->dropColumn('employee_id');
            }

            if (Schema::hasColumn('t_sales', 'quantity')) {
                $table->dropColumn('quantity');
            }

            if (Schema::hasColumn('t_sales', 'total_price')) {
                $table->dropColumn('total_price');
            }
        });

        // t_damaged_products
        Schema::table('t_damaged_products', function (Blueprint $table) {
            if (Schema::hasColumn('t_damaged_products', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('t_damaged_products', 'reported_by')) {
                $table->dropForeign(['reported_by']);
                $table->dropColumn('reported_by');
            }

            if (Schema::hasColumn('t_damaged_products', 'reason')) {
                $table->dropColumn('reason');
            }
        });

        // t_product_stock_transactions
        Schema::table('t_product_stock_transactions', function (Blueprint $table) {
            if (Schema::hasColumn('t_product_stock_transactions', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('t_product_stock_transactions', 'transaction_type')) {
                $table->dropColumn('transaction_type');
            }

            if (Schema::hasColumn('t_product_stock_transactions', 'quantity')) {
                $table->dropColumn('quantity');
            }
        });

        // t_product_purchases
        Schema::table('t_product_purchases', function (Blueprint $table) {
            if (Schema::hasColumn('t_product_purchases', 'product_id')) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('t_product_purchases', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }

            if (Schema::hasColumn('t_product_purchases', 'quantity')) {
                $table->dropColumn('quantity');
            }

            if (Schema::hasColumn('t_product_purchases', 'total_cost')) {
                $table->dropColumn('total_cost');
            }
        });

        // t_product_sales_returns
        Schema::table('t_product_sales_returns', function (Blueprint $table) {
            if (Schema::hasColumn('t_product_sales_returns', 'sale_id')) {
                $table->dropForeign(['sale_id']);
                $table->dropColumn('sale_id');
            }

            if (Schema::hasColumn('t_product_sales_returns', 'reason')) {
                $table->dropColumn('reason');
            }
        });

        // m_products: Hapus foreign key constraints tanpa menghapus tabelnya
        Schema::table('m_products', function (Blueprint $table) {
            if (Schema::hasColumn('m_products', 'product_category_id')) {
                $table->dropForeign(['product_category_id']);
                $table->dropColumn('product_category_id');
            }

            if (Schema::hasColumn('m_products', 'supplier_id')) {
                $table->dropForeign(['supplier_id']);
                $table->dropColumn('supplier_id');
            }
        });

        // m_product_categories
        Schema::table('m_product_categories', function (Blueprint $table) {
            if (Schema::hasColumn('m_product_categories', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};
