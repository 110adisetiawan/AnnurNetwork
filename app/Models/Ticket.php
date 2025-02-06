<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $fillable = ['karyawan_id', 'sla_id', 'priority_id', 'task_id', 'customer_name', 'costumer_address', 'image_address', 'latitude_ticket', 'longitude_ticket', 'image_address', 'latitude_karyawan', 'longitude_karyawan', 'status', 'start_date', 'end_date', 'note', 'closed_by'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    public function sla()
    {
        return $this->belongsTo(SLA::class);
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
