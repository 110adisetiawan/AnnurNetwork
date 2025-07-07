<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['custom_id', 'karyawan_id', 'sla_id', 'priority_id', 'task_id', 'customer_name', 'costumer_address', 'image_address', 'latitude_ticket', 'longitude_ticket', 'image_address', 'latitude_karyawan', 'longitude_karyawan', 'status', 'start_date', 'end_date', 'note', 'closed_by'];

    protected static function booted()
    {
        static::creating(function ($ticket) {
            $namaTugas = $ticket->task?->nama_tugas ?? 'Tugas';
            $tanggal = now()->format('d-m-Y');
            // Hitung berapa banyak transaksi dengan tipe & tanggal yang sama
            $countToday = self::whereDate('created_at', now())
                ->where('task_id', $ticket->task_id)
                ->count() + 1;

            $ticket->custom_id = str_pad($countToday, 3, '0', STR_PAD_LEFT) . "/{$namaTugas}/{$tanggal}";
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sla()
    {
        return $this->belongsTo(Sla::class, 'sla_id');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
