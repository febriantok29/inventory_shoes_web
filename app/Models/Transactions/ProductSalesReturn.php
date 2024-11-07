<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSalesReturn extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_sales_returns';
    protected $fillable = ['product_name', 'quantity', 'customer_name', 'return_reason', 'return_date'];
}
