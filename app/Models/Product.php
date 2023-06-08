<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'image', 'product_name', 'purchase_price', 'sale_price', 'discount', 'status', 'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
