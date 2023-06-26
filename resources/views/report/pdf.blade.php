<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Pesanan</title>
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
        <h5>Laporan Data Pesanan</h5>
        <h6>{{ request()->input('dari') }} - {{ request()->input('sampai') }}</h6>
    </center>

    <br>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah Dibeli</th>
                <th>Total Qty</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($reports as $index => $data)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $data->nama_barang }}</td>
            <td>{{ $data->harga }}</td>
            <td>{{ $data->jumlah_dibeli }}</td>
            <td>{{ $data->total_qty }}</td>
            <td>{{ $data->pendapatan }}</td>
        </tr>
    @empty
        <tr>
            <td class="text-center" colspan="6">Tidak ada data untuk ditampilkan</td>
        </tr>
    @endforelse
        </tbody>
    </table>
    </html>