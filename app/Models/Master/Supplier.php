<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'm_suppliers';
    protected $fillable = ['code', 'name', 'contact_number', 'email', 'address'];
}
