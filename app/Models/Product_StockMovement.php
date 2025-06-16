<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_StockMovement extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'product_supplier_id', 'movement_type', 'quantity', 'damage_status', 'damage_reason'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Product_Supplier::class);
    }
}
