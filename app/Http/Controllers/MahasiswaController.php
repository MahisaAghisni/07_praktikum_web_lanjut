<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Kelas;

class MahasiswaController extends Controller
{

    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // js 7
        // $mahasiswas = Mahasiswa::paginate(5);
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        // return view('mahasiswa.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);

        // js 9
        $mahasiswas = Mahasiswa::with('kelas')->get();
        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswas' => $mahasiswas, 'posts' => $posts]);
    }

    public function create()
    {
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.create', ['kelas' => $kelas]);
    }

    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required', 'Nama' => 'required', 'Email' => 'required', 'TanggalLahir' => 'required',
            'Kelas' => 'required', 'Jurusan' => 'required', 'No_Handphone' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Email = $request->get('Email');
        $mahasiswa->TanggalLahir = $request->get('TanggalLahir');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk menambahkan data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        // $Mahasiswa = Mahasiswa::find($Nim);
        // return view('mahasiswa.detail', compact('Mahasiswa'));

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail', ['Mahasiswa' => $Mahasiswa]);
    }


    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        // $Mahasiswa = Mahasiswa::find($Nim);
        // return view('mahasiswa.edit', compact('Mahasiswa'));

        $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.edit', compact('Mahasiswa', 'kelas'));
    }


    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required', 'Nama' => 'required', 'Email' => 'required', 'TanggalLahir' => 'required',
            'Kelas' => 'required', 'Jurusan' => 'required', 'No_Handphone' => 'required',
        ]);

        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $mahasiswa->Nim = $request->get('Nim');
        $mahasiswa->Nama = $request->get('Nama');
        $mahasiswa->Email = $request->get('Email');
        $mahasiswa->TanggalLahir = $request->get('TanggalLahir');
        $mahasiswa->Jurusan = $request->get('Jurusan');
        $mahasiswa->No_Handphone = $request->get('No_Handphone');

        $kelas = new Kelas;
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk menambahkan data dengan relasi belongsTo
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::find($Nim)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswas = Mahasiswa::where('Nama', 'like', "%" . $keyword . "%")->paginate(5);
        return view('mahasiswa.index', compact('mahasiswas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function khs($Nim)
    {

        $mahasiswas = Mahasiswa::where('nim', $Nim)->first();
        return view('mahasiswa.nilai', ['mahasiswas' => $mahasiswas]);
    }
}
