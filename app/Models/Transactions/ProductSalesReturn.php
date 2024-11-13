<?php

namespace App\Models\Transactions;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSalesReturn extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_sales_returns';
    protected $fillable = ['code', 'sales_id', 'transaction_stock_id', 'total_quantity', 'total_price', 'total', 'note', 'return_date',];
    protected $dates = ['return_date', 'deleted_at'];

    public function sales()
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }


    public function details()
    {
        return $this->hasMany(ProductSalesReturnDetail::class, 'product_sales_return_id');
    }
}
