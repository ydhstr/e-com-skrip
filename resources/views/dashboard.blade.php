@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <div class="col-lg-4 mb-4">
    <div class="card bg-primary text-white shadow">
      <div class="card-body">
        <h2>Jumlah Kategori</h2>
        <div class="text-white-50 large">
          <h3 id="jumlah-kategori">{{ $totalData }}</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4">
    <div class="card bg-primary text-white shadow">
      <div class="card-body">
        <h2>Jumlah Terbaru Pesanan</h2>
        <div class="text-white-50 small">
          <h3 id="jumlah-pesanan">0</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4">
    <div class="card bg-primary text-white shadow">
      <div class="card-body">
        <h2>Jumlah Pembayaran Terbaru</h2>
        <div class="text-white-50 small">
          <h3 id="jumlah-pembayaran">0</h3>
        </div>
      </div>
  </div>
</div>
</div>
@endsection