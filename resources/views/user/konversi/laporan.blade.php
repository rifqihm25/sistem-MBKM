<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Konversi Mahasiswa</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: none;
        }

        th {
            background: none;
            color: rgb(0, 0, 0);
            font-weight: bold;
        }

        td,
        th {
            padding: 8px;
            border: 1px solid #000000;
            text-align: center;
            font-size: 15px;
        }
    </style>
</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            <img class="img-box img-bordered-sm" src="{{ public_path('images/.jpg') }}" alt="Logo"
                height="75px">
        </div>
        <div>
            <h2 class="text-center justify-content-center" style="margin-left: 30%">Form Konversi Mahasiswa</h2>
        </div>
    </div>

    <table>
        <tr style="background-color: white">
            <td for="nama" style="text-align: left; border: none; font-size: 15px; width: 150px; font-weight: bold">Nama Mahasiswa</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->nama }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="npm" style="text-align: left; border: none; font-size: 15px; font-weight: bold">NPM</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->npm }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="no_telepon" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Nomor Telepon</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->no_telepon }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="fakultas" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Fakultas</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->fakultas }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="jurusan" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Program Studi</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->jurusan }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="semester" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Semester</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->semester }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="jenis_mbkm" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Jenis MBKM</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->nama_mbkm }}</td>
        </tr>
        <tr style="background-color: white">
            <td for="created_at" style="text-align: left; border: none; font-size: 15px; font-weight: bold">Tanggal Konversi</td>
            <td style="text-align: left; border: none; font-size: 15px;">:</td>
            <td style="text-align: left; border: none; font-size: 15px;">{{ $mhs->created_at->format('d-m-Y') }}</td>
        </tr>
    </table>

    <table style="position: relative; top: 5px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                <th>Nilai Mutu</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($konversi as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->matakuliah }}</td>
                    <td>{{ $item->sks }}</td>
                    <td>{{ $item->nilai_mutu }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
