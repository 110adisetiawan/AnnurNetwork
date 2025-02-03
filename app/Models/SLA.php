<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    protected $table = 'SLA';
    protected $fillable = ['nama_sla', 'description', 'time'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
