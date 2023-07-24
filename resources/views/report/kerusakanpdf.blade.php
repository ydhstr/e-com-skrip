<!DOCTYPE html>
<html>

<head>
    <title>Laporan Kerusakan Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="shortcut icon" href="/uploads/favicon.png">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
        .p1 {
        font-family: "Times New Roman", Times, serif;
    }

    body {
        font-family: arial;
        background-color: #fff;
    }

    .rangkasurat {
        width: 980px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
    }

    table {
        border-bottom: 5px solid #000;
        padding: 2px
    }

    .tengah {
        text-align: center;
        line-height: 5px;
    }
</style>
<center>
    <div class="rangkasurat">
        <table width="100%">
            <tr>
                <td><img src="/uploads/kop.png" width="200px"></td>
                <td class="tengah">
                    <h1 class="p1">BALAI STANDARDISASI DAN PELAYANAN</h1>
                    <h1 class="p1">JASA INDUSTRI</h1>
                    <h1 class="p1">SAHABAT IKM</h1>
                    <h5 class="p1">Jalan Panglima Batur No.2, Kota Banjarbaru Telepon (0511)4774861</h5>
                </td>
            </tr>
        </table>
    </div>
</center>
<br>
<h5><center><b>Laporan Kerusakan Barang</b></center></h5>
    <h6><center><p>Dari: {{ $dari }}  Sampai: {{ $sampai }}</p></center></h6>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                        <th>No</th>
                        <th>Nama Member</th>
                        <th>No Order</th>
                        <th>deskripsi</th>
                        <th>Gambar</th>
            </tr>
        </thead>
        <tbody>  
            @foreach ($report as $item)
            <tr>
                <td class="border px-6 py-4">{{ $loop->iteration }}</td>
                <td class="border px-6 py-4">{{ $item->nama_member }}</td>
                <td class="border px-6 py-4">{{ $item->id_order }}</td>
                <td class="border px-6 py-4">{{ $item->deskripsi }}</td>
                <td width="200px"><img src="/uploads/{{ $item->gambar }}" alt="Gambar" width="125px"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        window.onload = function() {
            window.print();
        };
    </script> 
    </html>