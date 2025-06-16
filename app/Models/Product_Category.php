<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'product_categories';

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
