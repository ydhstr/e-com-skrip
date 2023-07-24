@extends('layout.app')

@section('title', 'Laporan Kerusakan Barang')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Laporan Kerusakan Barang
        </h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
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
                        <div class="row">
                            <div class="col-md-3">
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
                        <th>Nama Member</th>
                        <th>No Order</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div class="card-footer">
                <div class="text-right">
                    <a href="{{ route('rusakan', ['dari' => request()->input('dari'), 'sampai' => request()->input('sampai')]) }}" class="btn btn-danger btn-sm">
                    <!-- <a href="javascript:window.print();" class="btn btn-danger btn-sm"> -->
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
            url: `/api/reports/rusak?dari=${dari}&sampai=${sampai}`,
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
                            <td>${val.nama_member}</td>
                            <td>${val.id_order}</td>
                            <td>${val.deskripsi}</td>
                            <td width="200px"><img src="/uploads/${val.gambar}" width="125"></td>
                        </tr>
                        `;
                });
                $('tbody').append(row)
            }
        });

    });
</script>

@endpush
