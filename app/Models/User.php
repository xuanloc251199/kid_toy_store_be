<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Chú ý dòng này
use Laravel\Sanctum\HasApiTokens; // Thêm dòng này

class User extends Authenticatable
{
    use HasFactory, HasApiTokens; // Thêm HasApiTokens vào đây

    protected $table = 'users';

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'number_phone',
        'address',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
