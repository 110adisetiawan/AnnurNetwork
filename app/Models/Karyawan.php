<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'karyawans';
    protected $fillable = ['nama', 'alamat', 'no_hp', 'email', 'password', 'foto', 'status'];
}
