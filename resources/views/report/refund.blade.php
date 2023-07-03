@extends('layout.app')

@section('title', 'Laporan Order Refund')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Laporan Order Refund
        </h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="form-group">
                        <label for="">Dari</label>
                        <input type="date" name="dari" id="dari" class="form-control"
                            value="{{request()->input('dari')}}">
                    </div>
                    <div class="form-group">
                        <label for="">Sampai</label>
                        <input type="date" name="sampai" id="sampai" class="form-control"
                            value="{{request()->input('sampai')}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        @if (request()->input('dari'))
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pesanan</th>
                        <th>Invoice</th>
                        <th>Member</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{ route('kembali', ['dari' => request()->input('dari'), 'sampai' => request()->input('sampai')]) }}" class="btn btn-danger btn-sm"
                        id="export-pdf" target="_blank">
                        <i class="fa fa-file-pdf"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection


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
            url: `/api/reports/orderrefund?dari=${dari}&sampai=${sampai}`,
            headers: {
                "Authorization": 'Bearer ' + token
            },
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
                            <td>${val.invoice}</td>
                            <td>${val.nama_member}</td>
                            <td>${rupiah(val.grand_total)}</td>
                            <td>${val.status}</td>
                        </tr>
                        `;
                });
                $('tbody').append(row)
            }
        });

    });
</script>
@endpush
