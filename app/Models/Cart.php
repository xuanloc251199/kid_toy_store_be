<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    // Các trường có thể được gán hàng loạt
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // Định nghĩa mối quan hệ với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định nghĩa mối quan hệ với bảng products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
