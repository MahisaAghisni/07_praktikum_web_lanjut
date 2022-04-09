<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;


class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas'; // Eloquent akan membuat model mahasiswa menyimpan record di tabel mahasiswas
    public $timestamps = false;
    protected $primaryKey = 'Nim'; // Memanggil isi DB Dengan primarykey

    protected $fillable = [
        'Nim',
        'Nama',
        'Email',
        'TanggalLahir',
        'kelas_id',
        'Jurusan',
        'No_Handphone',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function matakuliah()
    {
        return $this->belongsToMany(MataKuliah::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id')->withPivot('nilai');
    }
}
