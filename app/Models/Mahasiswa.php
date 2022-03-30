<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = "mahasiswas"; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps = false;
    protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey

    protected $fillable = [
        'Nim',
        'Nama',
        'Email',
        'TanggalLahir',
        'Kelas',
        'Jurusan',
        'No_Handphone',
    ];
}
