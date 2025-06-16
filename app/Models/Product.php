<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'sku', 'product_category_id', 'product_supplier_id', 'stock', 'price', 'condition', 'damage_description'];

    public function product_category()
    {
        return $this->belongsTo(Product_Category::class);
    }

    public function product_supplier()
    {
        return $this->belongsTo(Product_Supplier::class);
    }

    public function product_stockMovements()
    {
        return $this->hasMany(Product_StockMovement::class);
    }
}
