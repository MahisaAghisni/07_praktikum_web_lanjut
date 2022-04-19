<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 12pt;
        }

    </style>
    <center>
        <h2>KARTU HASIL STUDI (KHS)</h2>
    </center>
    <br>
    <b>Nama:</b> {{ $mahasiswas->Nama }}<br>
    <b>NIM: </b>{{ $mahasiswas->Nim }}<br>
    <b>Kelas: </b> {{ $mahasiswas->kelas->nama_kelas }}<br>

    <br><br><br>

    <table class="table table-bordered">
        <tr>
            <th>Matakuliah</th>
            <th>SKS</th>
            <th>Semester</th>
            <th>Nilai</th>
        </tr>
        <br>
        @foreach ($mahasiswas->matakuliah as $nilai)
            <tr>
                <td>{{ $nilai->nama_matkul }}</td>
                <td>{{ $nilai->sks }}</td>
                <td>{{ $nilai->semester }}</td>
                <td>{{ $nilai->pivot->nilai }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
