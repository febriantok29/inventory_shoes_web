<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductQualityReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_product_quality_reports';
    protected $fillable = ['product_name', 'issue_description', 'quality_status', 'reported_date'];
}
