@extends('layout.app')

@section('title', 'Data Pembayaran')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Pembayaran
        </h4>
    </div>
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
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(function() {
        $.ajax({
            url: '/api/payments',
            success: function({
                data
            }) {

                let row;
                data.map(function(val, index) {
                    tgl = new Date(val.created_at)
                    tgl.setMonth(tgl.getMonth() + 1);
                    tgl_lengkap = `${tgl.getDate()}-${tgl.getMonth()}-${tgl.getFullYear()}`
                    row += `
                        <tr>
                            <td>${index+1}</td>
                            <td>${tgl_lengkap}</td>
                            <td>${val.id_order}</td>
                            <td>${val.jumlah}</td>
                            <td>${val.no_rekening}</td>
                            <td>${val.atas_nama}</td>
                            <td>${val.status}</td>
                            <td>${val.payment}</td>

                        </tr>
                        `;
                });

                $('tbody').append(row)
            }
        });
</script>
@endpush
