<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pembelian Member</title>
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
        <h5>Laporan Pembelian Member</h5>
        <h6><p>Dari: {{ $dari }} - Sampai: {{ $sampai }}</p></h6>
    </center>

    <br>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Member</th>
                <th>Email</th>
                <th>Jumlah Dibeli</th>
                <th>Total Pembelian</th>
            </tr>
        </thead>
        <tbody>  
            @foreach ($report as $item)
            <tr>
                <td class="border px-6 py-4">{{ $loop->iteration }}</td>
                <td class="border px-6 py-4">{{ $item->nama_member }}</td>
                <td class="border px-6 py-4">{{ $item->email }}</td>
                <td class="border px-6 py-4">{{ $item->total_jumlah }}</td>
                <td class="border px-6 py-4">{{ $item->total_total }}</td>
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