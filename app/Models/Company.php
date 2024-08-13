<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    // Daftar atribut yang dapat diisi secara massal
    protected $fillable = [
        'name', // Tambahkan nama kolom di sini
        // Tambahkan kolom lain yang ingin diisi secara massal
    ];
}
