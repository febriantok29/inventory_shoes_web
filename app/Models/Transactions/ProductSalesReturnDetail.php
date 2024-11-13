<?php

namespace App\Models\Transactions;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSalesReturnDetail extends BaseModel
{
    use SoftDeletes;

    protected $table = 't_product_sales_returns_details';

    protected $fillable = [
        'transaction_stock_id',
        'product_sales_return_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'note',
    ];

    protected $dates = ['deleted_at'];


    public function transactionStock()
    {
        return $this->hasOne(ProductStockTransaction::class, 'id', 'transaction_stock_id');
    }

    public function productSalesReturn()
    {
        return $this->belongsTo(ProductSalesReturn::class, 'product_sales_return_id');
    }
}
