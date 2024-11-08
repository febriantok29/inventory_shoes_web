<?php
namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\Product;

class SaleDetail extends Model
{
    use HasFactory;

    protected $table = 't_sales_details';

    protected $fillable = [
        'sales_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sales_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
