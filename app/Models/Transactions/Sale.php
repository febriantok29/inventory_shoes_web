<?php

namespace App\Models\Transactions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transactions\SaleDetail;
use App\Models\Master\Employee;

class Sale extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 't_sales';
    protected $fillable = ['invoice', 'employee_id', 'customer_name', 'total_amount', 'total_price', 'note', 'transaction_date'];
    protected $dates = ['deleted_at', 'transaction_date'];

    public function details()
    {
        return $this->hasMany(SaleDetail::class, 'sales_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
