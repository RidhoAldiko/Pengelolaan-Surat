<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        table.static{
            position: relative;
            border: 1px solid black;
        }
    </style>
    <title>Cetak Pegawai - {{ $pegawai->nama_pegawai }}</title>
</head>
<body>
    <div class="form-group">
        <p style="margin-left: 34%;"><b>LAMPIRAN : KEPUTUSAN BADAN KEPEGAWAIAN NEGARA</b></p>
        <p style="margin-left: 48%;"><b>NOMOR    : 11 TAHUN 2012</b></p>
        <p style="margin-left: 48%;"><b>TANGGAL  : 17 JUNI 2012</b></p>
    </div>
    <div class="form-group">
        <center><h3>DAFTAR RIWAYAT HIDUP</h3></center>
        <table class="static" align="center" rules="all" border="1px" style="width:95%;">
        <tr>
            <td>1</td>
            <td>NAMA LENGKAP</td>
            <td>{{ $pegawai->nama_pegawai }}</td>
        </tr>
        <tr>
            <td>2</td>
            <td>NIP</td>
            <td>{{ $pegawai->nip_pegawai }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>PANGKAT DAN GOLONGAN RUANG</td>
            <td>{{ $pegawai->jabatan->nama_jabatan }} / {{ $pegawai->golongan->nama_golongan }}</td>
        </tr>
        <tr>
            <td>4</td>
            <td>TEMPAT / TANGGAL LAHIR</td>
            <td>{{ date('d-m-Y',strtotime($pegawai->tanggal_lahir)) }} / {{ $pegawai->tempat_lahir }}</td>
        </tr>
        <tr>
            <td>5</td>
            <td>JENIS KELAMIN</td>
            <td>{{ $pegawai->jenis_kelamin }}</td>
        </tr>
        <tr>
            <td>6</td>
            <td>AGAMA</td>
            <td>{{ $pegawai->agama }}</td>
        </tr>
        <tr>
            <td>7</td>
            <td>STATUS PERKAWINAN</td>
            <td>{{ $pegawai->status_perkawinan }}</td>
        </tr>
        {{-- <tr>
            <td rowspan="5">8</td>
            <td rowspan="5">ALAMAT RUMAH</td>
            <td>a.jalan</td>
            <td>{{ $pegawai->alamat->jalan }}</td>
        </tr>
        <tr>
            <td>a.jalan</td>
            <td></td>
        </tr> --}}
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>