<?php

namespace App\Models\Transaction;

use App\Models\Master\ProductDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesDetail extends Model
{
    use SoftDeletes;

    protected $table = 't_sales_transaction_details';

    protected $fillable = [
        'sales_transaction_id',
        'product_detail_id',
        'quantity',
    ];

    public function sales()
    {
        return $this->belongsTo(Sales::class, 'sales_transaction_id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id');
    }
}
