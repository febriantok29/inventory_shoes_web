<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductDetail extends Model
{
    use SoftDeletes;

    protected $table = 'm_product_details';

    protected $fillable = ['product_id', 'size', 'color', 'note', 'stock', 'price'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp. ' . number_format($this->price, 0, ',', '.');
    }
}
