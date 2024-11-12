<?php

namespace App\Models\Master;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_product_categories';

    protected $fillable = ['code', 'name', 'description'];

    protected $dates = ['deleted_at'];
}
