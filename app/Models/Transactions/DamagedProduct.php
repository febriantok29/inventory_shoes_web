<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DamagedProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_damaged_products';
    protected $fillable = ['product_name', 'damage_description', 'quantity', 'reported_date'];
}
