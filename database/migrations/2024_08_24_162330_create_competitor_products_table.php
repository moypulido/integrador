<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitorProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('competitor_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marketplace_id');
            $table->unsignedBigInteger('product_id');
            $table->string('title');
            $table->string('sku')->unique();
            $table->string('sku_provider');
            $table->decimal('price', 8, 2);
            $table->string('url')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('competitor_products');
    }
}
