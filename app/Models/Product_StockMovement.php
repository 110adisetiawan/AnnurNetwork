<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product_StockMovement extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'custom_id', 'user_id', 'product_supplier_id', 'movement_type', 'quantity', 'damage_status', 'damage_reason', 'transaction_date', 'damage_reason'];
    protected $table = 'product_stock_movements';

    protected static function booted()
    {
        static::creating(function ($movement) {
            $prefix = match ($movement->movement_type) {
                'masuk'  => 'IN',
                'keluar' => 'OUT',
                default  => 'XX',
            };

            if ($movement->damage_status === 'damaged') {
                $prefix = 'B';
            }

            $date = Carbon::parse($movement->transaction_date)->format('dmY');

            // Hitung berapa banyak transaksi dengan tipe & tanggal yang sama
            $countToday = self::whereDate('created_at', now())
                ->where('movement_type', $movement->movement_type)
                ->count() + 1;

            $movement->custom_id = "{$prefix}/{$date}/" . str_pad($countToday, 5, '0', STR_PAD_LEFT);
        });
    }

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

    public function isInbound()
    {
        return $this->movement_type === 'in';
    }

    public function isOutbound()
    {
        return $this->movement_type === 'out';
    }
}
