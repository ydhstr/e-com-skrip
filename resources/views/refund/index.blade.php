@extends('layout.app')

@section('title', 'Data Refund')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Refund
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a href="#modal-form" data-toggle="modal" class="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>No</th>
                        <th>Nama Refund</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('refund.store') }}" class="form-Refund" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="">ID Member</label>
                                <input value="{{ old('id_member') }}" type="text" class="form-control" name="id_member" placeholder="Nama Refund"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="">ID Order</label>
                                <input value="{{ old('id_order') }}" type="text" class="form-control" name="id_order" placeholder="id order"
                                    required>
                            </div>
                            <div value="{{ old('deskripsi') }}"
                            class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="30"
                                    rows="10" required></textarea>
                            </div>
                            <div value="{{ old('gambar') }}" class="form-group">
                                <label for="">Gambar</label>
                                <input type="file" class="form-control" name="gambar">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                           <!--  @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
      </div>
                            @endif -->
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(function() {
        $.ajax({
            url: '/api/refunds',
            success: function({
                data
            }) {

                let row;
                data.map(function(val, index) {
                    row += `
                        <tr>
                            <td width="150px">
                                <a href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">hapus</a>
                            </td>
                            <td>${index+1}</td>
                            <td>${val.id_member}</td>
                            <td>${val.id_order}</td>
                            <td>${val.deskripsi}</td>
                            <td width="200px"><img src="/uploads/${val.gambar}" width="150"></td>
                        </tr>
                        `;
                });

                $('tbody').append(row)
            }
        });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id')
            const token = localStorage.getItem('token')

            confirm_dialog = confirm('Apakah anda yakin?');

            if (confirm_dialog) {
                $.ajax({
                    url: '/api/refunds/' + id,
                    type: "DELETE",
                    headers: {
                        "Authorization": 'Bearer ' + token
                    },
                    success: function(data) {
                        if (data.message == 'success') {
                            alert('Data berhasil dihapus')
                            location.reload()
                        }
                    }
                });
            }


        });
/* 
        $('.modal-tambah').click(function() {
            $('#modal-form').modal('show')
            $('input[name="nama_Refund"]').val('')
            $('textarea[name="deskripsi"]').val('')

            $('.form-Refund').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: 'api/refunds',
                    type: 'POST',
                    data: frmdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": 'Bearer ' + token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert('Data berhasil ditambah')
                            location.reload();
                        }
                    },
                    fail : function(data){
                        console.log(data)
                    }
                })
            });
        });
 */
        $(document).on('click', '.modal-ubah', function() {
            $('#modal-form').modal('show')
            const id = $(this).data('id');

            $.get('/api/refunds/' + id, function({
                data
            }) {
                $('input[name="id_member"]').val(data.id_member);
                $('input[name="id_order"]').val(data.id_order);
                $('textarea[name="deskripsi"]').val(data.deskripsi);
            });

            $('.form-Refund').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: `api/refunds/${id}?_method=PUT`,
                    type: 'POST',
                    data: frmdata,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        "Authorization": 'Bearer ' + token
                    },
                    success: function(data) {
                        if (data.success) {
                            alert('Data berhasil diubah')
                            location.reload();
                        }
                    },
                   /*  fail : function(data){
                        console.log(data)
                    } */
                })
            });

        });

    });
</script>
@endpush
