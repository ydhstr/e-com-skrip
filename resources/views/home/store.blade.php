@extends('layout.home')

@section('title', 'Store Products')

@section('content')
<!-- Store Information -->
<section class="section-wrap pt-20 pb-10">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">nama</h4>
                        <p class="card-text">alamat</p>
                        <div class="social-icons nobase">
                            <a href=""><i class="fa fa-instagram"></i></a>
                            <a href=""><i class="fa fa-phone"></i></a>
                            <a href=""><i class="fa fa-building"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Catalogue -->
<section class="section-wrap pt-40 pb-40 catalogue">
    <div class="container relative">
        <!-- Filter -->
        <div class="shop-filter">
            <div class="view-mode hidden-xs">
                <span>View:</span>
                <a class="grid grid-active" id="grid"></a>
                <a class="list" id="list"></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 catalogue-col right mb-50">
                <div class="shop-catalogue grid-view">
                    <div class="row items-grid">{{-- 
                        @foreach ($products as $product) --}}
                        <div class="col-md-4 col-xs-6 product product-grid">
                            <div class="product-item clearfix">
                                <!-- Product Image -->
                                <div class="product-img hover-trigger">
                                    {{-- <a href="/product/{{$product->id}}">
                                        <img src="/uploads/{{$product->gambar}}" alt="">
                                        <img src="/uploads/{{$product->gambar}}" alt="" class="back-img">
                                    </a> --}}
                                    <div class="hover-2">
                                        <div class="product-actions">
                                            <a href="#" class="product-add-to-wishlist">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>{{-- 
                                    <a href="/product/{{$product->id}}" class="product-quickview">More</a> --}}
                                </div>
                                <!-- Product Details -->
                                {{-- <div class="product-details">
                                    <h3 class="product-title">
                                        <a href="/product/{{$product->id}}">{{$product->nama_barang}}</a>
                                    </h3>
                                    <span class="category">
                                        <a href="/products/{{$product->id_subkategori}}">{{$product->subcategory->nama_subkategori}}</a>
                                    </span>
                                </div> --}}
                                <!-- Product Price -->
                               {{--  <span class="price">
                                    <ins>
                                        <span class="amount">Rp. {{number_format($product->harga)}}</span>
                                    </ins>
                                </span> --}}
                            </div>
                        </div> <!-- end product -->{{-- 
                        @endforeach --}}
                    </div> <!-- end row -->
                </div> <!-- end grid mode -->

                <!-- Pagination -->
                {{-- <div class="pagination-wrap clearfix">
                    @if ($products->count() > 0)
                        <p class="result-count">Showing: {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results</p>
                        {{ $products->links() }}
                    @else
                        <p>No results found.</p>
                    @endif
                    <nav class="pagination right clearfix">
                        <a href="#"><i class="fa fa-angle-left"></i></a>
                        <span class="page-numbers current">1</span>
                        <a href="#">2</a>
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </nav>
                </div> --}}
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end catalog -->
@endsection
