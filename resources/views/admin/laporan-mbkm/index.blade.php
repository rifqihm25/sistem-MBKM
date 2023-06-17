<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Laporan Data MBKM</title>

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
            background: #ff0000;
            color: rgb(255, 255, 255);
            font-weight: bold;
        }

        td,
        th {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div style="width: 95%; margin: 0 auto;">
        <div style="width: 10%; float:left; margin-right: 20px;">
            <img class="img-box img-bordered-sm" src="{{ public_path('images/logo.jpg') }}" alt="user image"
                height="75px">
        </div>
        <div>
            <h2 class="text-center justify-content-center" style="margin-left: 90px">Rekap Laporan Data MBKM</h2>
        </div>
    </div>

    <table style="position: relative; top: 5px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Mbkm</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($mbkms as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->nama_mbkm }}</td>
                    <td>{{ $item->mahasiswas_count }}</td>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
