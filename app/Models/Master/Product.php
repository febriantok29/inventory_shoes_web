<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_products';
    protected $fillable = ['code', 'name', 'size', 'color', 'image_path', 'description', 'price', 'stock', 'product_category_id', 'supplier_id'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
}
