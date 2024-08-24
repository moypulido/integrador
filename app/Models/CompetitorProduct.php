<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_id',
        'product_id',
        'title',
        'sku',
        'sku_provider',
        'price',
        'url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
