<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPurchase extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_purchases';
    protected $fillable = ['product_name', 'quantity', 'purchase_price', 'supplier_name', 'purchase_date'];
}
