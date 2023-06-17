<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Mahasiswa</title>

    <style>
        table {
            width: 95%;
            border-collapse: collapse;
            margin: 50px auto;
        }

        /* Zebra striping */
        tr:nth-of-type(odd) {
            background: #eee;
        }

        th {
            background: #3498db;
            color: white;
            font-weight: bold;
        }

        td,
        th {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 10px;
            font-family: 'Calibri';
        }
    </style>
</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            <img class="img-box img-bordered-sm" src="{{ public_path('images/.jpg') }}" alt="Logo"
                height="75px">
        </div>
        <div class="text-center justify-content-center" style="width: 50%; float: left;">
            <h2>Rekap Laporan MBKM Mahasiswa</h1>
        </div>
    </div>

    <table style="position: relative; top: 50px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NPM</th>
                <th>Fakultas</th>
                <th>Jurusan</th>
                <th>Semester</th>
                <th>IPK</th>
                <th>Jenis MBKM</th>
                <th>Status</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($mhs as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->email_mhs }}</td>
                    <td>{{ $item->npm }}</td>
                    <td>{{ $item->fakultas }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->semester }}</td>
                    <td>{{ $item->ipk }}</td>
                    <td>{{ $item->nama_mbkm }}</td>
                    @if ($item->status === $lengkap)
                        <td><span class="badge badge-success badge-pill badge-sm">{{ $item->status }}</span>
                        </td>
                    @elseif ($item->status === $blmlengkap)
                        <td><span class="badge badge-pill badge-danger badge-sm">{{ $item->status }}</span>
                        </td>
                    @else
                        <td><span class="badge badge-rounded badge-secondary badge-sm">{{ $blmlengkap }}</span>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
