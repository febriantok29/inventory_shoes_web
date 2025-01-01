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

    public function details()
    {
        return $this->hasMany(SalesDetail::class, 'sales_transaction_id');
    }

    public function formatCurrency($value)
    {
        return 'Rp. ' . number_format($value, 0, ',', '.');
    }

    public function getFormattedTotalPriceAttribute()
    {
        return $this->formatCurrency($this->total_price);
    }

    public function getFormattedCustomerMoneyAttribute()
    {
        return $this->formatCurrency($this->customer_money);
    }

    public function getFormattedChangeAttribute()
    {
        return $this->formatCurrency($this->change);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->translatedFormat('l, d M Y H:i');
    }
}
