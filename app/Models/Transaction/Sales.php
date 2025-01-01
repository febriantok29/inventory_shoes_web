<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    protected $table = 't_sales_transactions';

    protected $fillable = [
        'transaction_date',
        'total_items',
        'total_price',
        'customer_money',
        'change',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    protected $dates = [
        'transaction_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function details()
    {
        return $this->hasMany(SalesDetail::class, 'sales_transaction_id');
    }

    public function getFormattedTotalPriceAttribute()
    {
        return 'Rp. ' . number_format($this->total_price, 0, ',', '.');
    }

    public function getFormattedCustomerMoneyAttribute()
    {
        return 'Rp. ' . number_format($this->customer_money, 0, ',', '.');
    }

    public function getFormattedChangeAttribute()
    {
        return 'Rp. ' . number_format($this->change, 0, ',', '.');
    }
}
