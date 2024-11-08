<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transactions\SaleDetail;

class Sale extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_sales';
    protected $fillable = ['customer_name', 'total_amount', 'total_price', 'created_by', 'updated_by'];

    public function details()
    {
        return $this->hasMany(SaleDetail::class, 'sales_id');
    }
}
