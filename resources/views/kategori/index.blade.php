@extends('layout.app')

@section('title', 'Data Kategori')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Kategori
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-2">
            <a href="#modal-form" data-toggle="modal" class="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <div id="pagination-links"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('categories.store') }}" class="form-kategori" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label for="">Nama Kategori</label>
                                <input value="{{ old('nama_kategori') }}" type="text" class="form-control" name="nama_kategori" placeholder="Nama Kategori"
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
        url: '/api/categories',
        success: function(response) {
            let data = response.data;
            let row = '';

            data.data.forEach(function(val, index) {
                row += `
                    <tr>
                        <td width="150px">
                            <a href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                            <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">hapus</a>
                        </td>
                        <td>${index + 1}</td>
                        <td>${val.nama_kategori}</td>
                        <td>${val.deskripsi}</td>
                        <td width="200px"><img src="/uploads/${val.gambar}" width="150"></td>
                    </tr>
                `;
            });

            $('tbody').html(row);

            // Display pagination links
            $('#pagination-links').html(data.links);
        }
    });

    // Event listener for pagination links
    $(document).on('click', '#pagination-links a', function(event) {
        event.preventDefault();

        // Get the URL from the pagination link
        let url = $(this).attr('href');

        // Make an AJAX request to the new URL
        $.ajax({
            url: url,
            success: function(response) {
                let data = response.data;
                let row = '';

                data.data.forEach(function(val, index) {
                    row += `
                        <tr>
                            <td width="150px">
                                <a href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">hapus</a>
                            </td>
                            <td>${index + 1}</td>
                            <td>${val.nama_kategori}</td>
                            <td>${val.deskripsi}</td>
                            <td width="200px"><img src="/uploads/${val.gambar}" width="150"></td>
                        </tr>
                    `;
                });

                $('tbody').html(row);

                // Display pagination links
                $('#pagination-links').html(data.links);
            }
        });
    });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id')
            const token = localStorage.getItem('token')

            confirm_dialog = confirm('Apakah anda yakin?');

            if (confirm_dialog) {
                $.ajax({
                    url: '/api/categories/' + id,
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
            $('input[name="nama_kategori"]').val('')
            $('textarea[name="deskripsi"]').val('')

            $('.form-kategori').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: 'api/categories',
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

            $.get('/api/categories/' + id, function({
                data
            }) {
                $('input[name="nama_kategori"]').val(data.nama_kategori);
                $('textarea[name="deskripsi"]').val(data.deskripsi);
            });

            $('.form-kategori').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: `api/categories/${id}?_method=PUT`,
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
                    fail : function(data){
                        console.log(data)
                    }
                })
            });

        });

    });
</script>
@endpush
