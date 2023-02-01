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
        <h5>Laporan Data Pesanan

        </h5>
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
           
@push('js')
<script>
    $(function() {

        const dari = '{{ request()->input('dari') }}'
        const sampai = '{{ request()->input('sampai') }}'

        function rupiah(angka){
            const format = angka.toString().split('').reverse().join('');
            const convert = format.match(/\d{1,3}/g);
            return 'Rp ' + convert.join('.').split('').reverse().join('')
        }

        const token = localStorage.getItem('token')

        $.ajax({
            url: `/api/reports?dari=${dari}&sampai=${sampai}`,
            headers: {
                "Authorization": 'Bearer ' + token
            },
            success: function({
                data
            }) {
                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${val.nama_barang}</td>
                            <td>${rupiah(val.harga)}</td>
                            <td>${val.jumlah_dibeli}</td>
                            <td>${val.total_qty}</td>
                            <td>${rupiah(val.pendapatan)}</td>
                        </tr>
                        `;
                });
                $('tbody').append(row)
            }
        });

    });
</script>
@endpush
                <tr>
                    <td class="text-center" colspan="7">Tidak ada data untuk ditampilkan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>
