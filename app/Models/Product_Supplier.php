<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_info', 'address'];
    protected $table = 'product_suppliers';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
