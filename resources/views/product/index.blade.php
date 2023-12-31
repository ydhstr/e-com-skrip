@extends('layout.app')

@section('title', 'Data Barang')

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="card-title">
            Data Barang
        </h4>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-4">
            <a href="#modal-form" data-toggle="modal" class="btn btn-primary modal-tambah">Tambah Data</a>
        </div>
        <div class="table-responsive">
            <div class="d-flex justify-content-end mb-4">
                <form action="{{ route('products.index') }}" method="GET" class="form-inline">
                    <div class="d-flex justify-content-end">
                    <div class="form-group mr-2">
                        <input type="text" name="search" class="form-control" placeholder="Search" id="search-input">
                    </div>
                </div>
                </form>
            </div>
            
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Subkategori</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Bahan</th>
                        <th>Sku</th>
                        <th>Ukuran</th>
                        <th>Stock</th>
                        <th>Warna</th>
                        <th style="text-align: center;">Gambar</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
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
                        <form action="{{ route('products.store') }}" class="form-kategori" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="id_kategori" id="id_kategori" class="form-control">
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->nama_kategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">SubKategori</label>
                                <select name="id_subkategori" id="id_subkategori" class="form-control">
                                    @foreach ($subcategories as $category)
                                    <option value="{{$category->id}}">{{$category->nama_subkategori}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Barang</label>
                                <input value="{{ old('nama_barang') }}" type="text" class="form-control" name="nama_barang" placeholder="Nama Barang">
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input value="{{ old('harga') }}" type="number" class="form-control" name="harga" placeholder="Harga">
                            </div>
                            <div class="form-group">
                                <label for="">Diskon</label>
                                <input value="{{ old('diskon') }}" type="number" class="form-control" name="diskon" placeholder="Diskon">
                            </div>
                            <div class="form-group">
                                <label for="">Bahan</label>
                                <input value="{{ old('bahan') }}" type="text" class="form-control" name="bahan" placeholder="Bahan">
                            </div>
                            <div class="form-group">
                                <label for="">Tags</label>
                                <input value="{{ old('tags') }}" type="text" class="form-control" name="tags" placeholder="Tags">
                            </div>
                            <div class="form-group">
                                <label for="">Sku</label>
                                <input value="{{ old('sku') }}" type="text" class="form-control" name="sku" placeholder="Sku">
                            </div>
                            <div class="form-group">
                                <label for="">Warna</label>
                                <input value="{{ old('warna') }}" type="text" class="form-control" name="warna" placeholder="Warna">
                            </div>
                            <div class="form-group">
                                <label for="">Ukuran</label>
                                <input value="{{ old('ukuran') }}" type="text" class="form-control" name="ukuran" placeholder="Ukuran">
                            </div>
                            <div class="form-group">
                                <label for="">Stock</label>
                                <input value="{{ old('stock') }}" type="text" class="form-control" name="stock" placeholder="Stock">
                            </div>
                            <div value="{{ old('deskripsi') }}" class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" placeholder="Deskripsi" class="form-control" id="" cols="30"
                                    rows="10" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Gambar</label>
                                <input value="{{ old('gambar') }}" type="file" class="form-control" name="gambar">
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
    function loadData(page, search) {
            $.ajax({
                url: '/api/products',
                data: { page: page, search: search },
                success: function(response) {
                let data = response.data;

                if (Array.isArray(data)) {
                    let row = '';
                    const perPage = response.pagination.per_page;
                    const startIndex = (page - 1) * perPage;

                    data.forEach(function(val, index) {
                        row += `
                            <tr>
                                <td>
                                    <a href="#modal-form" data-id="${val.id}" class="btn btn-warning modal-ubah">Edit</a>
                                    <a href="#" data-id="${val.id}" class="btn btn-danger btn-hapus">hapus</a>
                                </td>
                                <td>${index+1}</td>
                                <td>${val.category.nama_kategori}</td>
                                <td>${val.subcategory.nama_subkategori}</td>
                                <td>${val.nama_barang}</td>
                                <td>${val.harga}</td>
                                <td>${val.diskon}</td>
                                <td>${val.bahan}</td>
                                <td>${val.sku}</td>
                                <td>${val.ukuran}</td>
                                <td>${val.stock}</td>
                                <td>${val.warna}</td>
                                <td><img src="/uploads/${val.gambar}" width="150"></td>
                            </tr>
                        `;
                    });

                    $('tbody').html(row);
                } else {
                    console.error('Invalid data format:', data);
                }

                if (page === 1) {$('.pagination').remove();}

                if (response.pagination) {
                    let pagination = `
                        <ul class="pagination">
                    `;

                     if (response.pagination && page === 1) {
        let pagination = `
            <ul class="pagination">
        `;}
                    if (response.pagination.current_page > 1) {
                        pagination += `
                            <li class="page-item">
                                <a class="page-link previous" href="#" data-page="${response.pagination.current_page - 1}">Previous</a>
                            </li>
                        `;
                    }
                    for (let i = 1; i <= response.pagination.last_page; i++) {
                        pagination += `
                            <li class="page-item ${i === response.pagination.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>
                        `;
                    }
                    if (response.pagination.current_page < response.pagination.last_page) {
                        pagination += `
                            <li class="page-item">
                                <a class="page-link next" href="#" data-page="${response.pagination.current_page + 1}">Next</a>
                            </li>
                        `;
                    }
                    pagination += `
                        </ul>
                    `;
                    $('.table-responsive').append(pagination);
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax request error:', error);
            }
        });
    }

    $(document).on('click', '.page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        $('.pagination').remove(); // Remove the existing pagination
        loadData(page);
    });

    // Load initial data
    loadData(1);

    $(document).on('click', '.previous, .next', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        $('.pagination').remove(); // Remove the existing pagination
        loadData(page);
        window.scrollTo(0, 0); // Scroll to the top of the page
    });

    $(document).on('click', '.next', function(e) {
        e.preventDefault();
        const currentPage = $('.active a').data('page');
        const lastPage = $('.page-item:last-child a').data('page');
        if (currentPage === lastPage) {
            $('.page-item:last-child').addClass('disabled');
        } else {
            $('.page-item:last-child').removeClass('disabled');
        }
    });

    $(document).on('click', '.previous', function(e) {
        e.preventDefault();
        const currentPage = $('.active a').data('page');
        if (currentPage === 1) {
            $('.page-item:first-child').addClass('disabled');
        } else {
            $('.page-item:first-child').removeClass('disabled');
        }
    });

    $('#search-input').on('input', function() {
    const searchValue = $(this).val();
    loadData(1, searchValue);
    });

        $(document).on('click', '.btn-hapus', function() {
            const id = $(this).data('id')
            const token = localStorage.getItem('token')

            confirm_dialog = confirm('Apakah anda yakin?');

            if (confirm_dialog) {
                $.ajax({
                    url: '/api/products/' + id,
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

        /* $('.modal-tambah').click(function() {
            $('#modal-form').modal('show')
            $('input[name="nama_kategori"]').val('')
            $('textarea[name="deskripsi"]').val('')

            $('.form-kategori').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: 'api/products',
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
        }); */

        $(document).on('click', '.modal-ubah', function() {
            $('#modal-form').modal('show')
            const id = $(this).data('id');

            $.get('/api/products/' + id, function({
                data
            }) {
                $('input[name="nama_barang"]').val(data.nama_barang);
                $('input[name="harga"]').val(data.harga);
                $('input[name="diskon"]').val(data.diskon);
                $('input[name="bahan"]').val(data.bahan);
                $('input[name="tags"]').val(data.tags);
                $('input[name="sku"]').val(data.sku);
                $('input[name="ukuran"]').val(data.ukuran);
                $('input[name="stock"]').val(data.stock);
                $('input[name="warna"]').val(data.warna);
                $('textarea[name="deskripsi"]').val(data.deskripsi);
            });

            $('.form-kategori').submit(function(e) {
                e.preventDefault()
                const token = localStorage.getItem('token')
                const frmdata = new FormData(this);

                $.ajax({
                    url: `api/products/${id}?_method=PUT`,
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
