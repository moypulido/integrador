<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketplace_id',
        'title',
        'sku',
        'sku_provider',
        'price',
        'min_price',
        'url',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'min_price' => 'decimal:2',
    ];

    public function competitorProducts()
    {
        return $this->hasMany(CompetitorProduct::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }
}
