<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['nama_tugas'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
