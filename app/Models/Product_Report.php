<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Report extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id', 'product_stock_movement_id', 'report_date', 'details'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stockMovement()
    {
        return $this->belongsTo(Product_StockMovement::class);
    }
}
