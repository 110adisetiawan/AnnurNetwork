<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sla extends Model
{
    protected $table = 'sla';
    protected $fillable = ['nama_sla', 'description', 'time'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
