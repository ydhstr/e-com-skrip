<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembayaran Transfer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Laporan Pembayaran Transfer</h5>
        <h6><p>Dari: {{ $dari }} - Sampai: {{ $sampai }}</p></h6>
    </center>

    <br>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Order</th>
                <th>Jumlah</th>
                <th>No Rekening</th>
                <th>Atas Nama</th>
                <th>Status</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>  
            @foreach ($report as $item)
            <tr>
                <td class="border px-6 py-4">{{ $loop->iteration }}</td>
                <td class="border px-6 py-4">{{ $item->created_at}}</td>
                <td class="border px-6 py-4">{{ $item->id_order }}</td>
                <td class="border px-6 py-4">{{ $item->jumlah }}</td>
                <td class="border px-6 py-4">{{ $item->no_rekening }}</td>
                <td class="border px-6 py-4">{{ $item->atas_nama }}</td>
                <td class="border px-6 py-4">{{ $item->status }}</td>
                <td class="border px-6 py-4">{{ $item->payment }}</td>
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