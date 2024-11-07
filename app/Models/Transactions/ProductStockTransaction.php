<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStockTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_stock_transactions';
    protected $fillable = ['product_name', 'quantity', 'transaction_type', 'transaction_date'];
}
