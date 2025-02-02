<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    protected $fillable = [
        'nama_device',
        'serial_number',
        'ip_address',
        'status',
        'latitude',
        'longitude'
    ];
}
