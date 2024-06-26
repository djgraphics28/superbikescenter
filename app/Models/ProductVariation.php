<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'color', 'engine_cc', 'stock', 'image'
    ];

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Define the relationship with ProductStock
    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function getImageUrlAttribute()
    {
        return config('app.url').'/storage/'.$this->image;
    }
}
