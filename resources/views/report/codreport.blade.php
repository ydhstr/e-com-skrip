@extends('layout.app')

@section('title', 'Laporan Pembayaran COD')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Laporan Pembayaran COD
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
                        <th>Tanggal</th>
                        <th>Order</th>
                        <th>Jumlah</th>
                        <th>No Rekening</th>
                        <th>Atas Nama</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="card-footer">
                <div class="text-right">
                    <a href="#" class="btn btn-danger btn-sm"
                        id="export-pdf">
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

        const token = localStorage.getItem('token')

        $.ajax({
            url: `/api/reports/pembayaran?dari=${dari}&sampai=${sampai}`,
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
                            <td>${val.id_order}</td>
                            <td>${val.jumlah}</td>
                            <td>${val.no_rekening}</td>
                            <td>${val.atas_nama}</td>
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
