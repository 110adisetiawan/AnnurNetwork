<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Product_Category;
use App\Models\Product_Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'ONT'],
            ['name' => 'ONU'],
            ['name' => 'ODP'],
            ['name' => 'Splitter'],
            ['name' => 'Router'],
            ['name' => 'Switch'],
            ['name' => 'AP'],
            ['name' => 'CPE'],
            ['name' => 'Kabel Fiber Optik'],
            ['name' => 'Kabel UTP'],
            ['name' => 'Konektor Fiber Optik'],
            ['name' => 'Konektor RJ45'],
            ['name' => 'Power Supply'],
            ['name' => 'Server'],
            ['name' => 'Laptop'],
        ];

        Product_Category::insert($categories);

        $suppliers = [
            ['name' => 'PT. Elektronik Jaya', 'contact_info' => '082123456789', 'address' => 'Jakarta'],
            ['name' => 'Furniture Indah', 'contact_info' => '081987654321', 'address' => 'Surabaya'],
            ['name' => 'Fashion Trend', 'contact_info' => '081234567890', 'address' => 'Bandung'],
            ['name' => 'Makanan Sehat', 'contact_info' => '082345678901', 'address' => 'Yogyakarta'],
            ['name' => 'Tulis Cepat', 'contact_info' => '083456789012', 'address' => 'Semarang'],
        ];

        Product_Supplier::insert($suppliers);

        $products = [
            ['name' => 'Laptop ASUS', 'sku' => 'ELE001', 'product_category_id' => 1, 'product_supplier_id' => 1, 'stock' => 50, 'price' => 10000000, 'condition' => 'normal'],
            ['name' => 'Meja Kayu', 'sku' => 'FUR002', 'product_category_id' => 2, 'product_supplier_id' => 2, 'stock' => 30, 'price' => 2000000, 'condition' => 'normal'],
            ['name' => 'Kaos Polos', 'sku' => 'PAK003', 'product_category_id' => 3, 'product_supplier_id' => 3, 'stock' => 100, 'price' => 50000, 'condition' => 'normal'],
            ['name' => 'Nasi Box', 'sku' => 'MAK004', 'product_category_id' => 4, 'product_supplier_id' => 4, 'stock' => 200, 'price' => 25000, 'condition' => 'normal'],
            ['name' => 'Pulpen Biru', 'sku' => 'ALT005', 'product_category_id' => 5, 'product_supplier_id' => 5, 'stock' => 300, 'price' => 5000, 'condition' => 'normal'],
        ];

        Product::insert($products);
    }
}
