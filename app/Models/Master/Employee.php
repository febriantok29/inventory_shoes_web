<?php

namespace App\Models\Master;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    protected $table = 'm_employees';

    protected $fillable = ['code', 'username', 'password', 'name', 'email', 'phone', 'address', 'photo', 'position', 'role', 'last_login', 'created_by', 'updated_by', 'deleted_by'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['last_login' => 'datetime'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public static function generateCode()
    {
        $employee = self::orderBy('code', 'DESC')->first();
        if (!$employee) {
            return 'EMP001';
        }

        $code = explode('EMP', $employee->code);
        return 'EMP' . sprintf('%03d', $code[1] + 1);
    }
}
