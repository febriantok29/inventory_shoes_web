<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Master\Product;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStockTransaction extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_stock_transactions';
    protected $fillable = ['product_id', 'type', 'quantity', 'description'];
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
