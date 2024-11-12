<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\Transactions\Sale;
use App\Models\Master\Product;

class SaleDetail extends BaseModel
{
    use HasFactory;

    protected $table = 't_sales_details';

    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'price',
        'total',
        'note'
    ];

    protected $dates = ['deleted_at'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
