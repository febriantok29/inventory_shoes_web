<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Master\Product;
use App\Models\Master\Supplier;
use App\Models\Transactions\ProductStockTransaction;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPurchase extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_purchases';
    protected $fillable = ['product_id', 'supplier_id', 'transaction_stock_id', 'quantity', 'purchase_price', 'total_cost', 'description'];
    protected $dates = ['deleted_at', 'purchase_date'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function transactionStock()
    {
        return $this->belongsTo(ProductStockTransaction::class, 'transaction_stock_id');
    }
}
