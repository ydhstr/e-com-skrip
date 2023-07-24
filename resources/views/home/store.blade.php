@extends('layout.home')

@section('title', 'Store Products')

@section('content')
<!-- Store Information -->
<section class="section-wrap intro pb-0">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 mb-30">
                <a {{$store->id}}>
                <h4 class="intro-heading">{{ $store->nama_store }}</h4>
                <p class="card-text"><a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($store->alamat) }}">{{ $store->alamat }}</a></p>
                <br>
            </a> 
                            <div class="social-icons nobase">
                                <ul class=" m-auto">
                                <li> 
                                    <li><a href="https://www.instagram.com/{{ $store->social_media }}"><i class="fa fa-instagram fa-lg"></i>{{ $store->social_media }}</a></li>
                                    <li><a><i class="fa fa-phone fa-lg">{{ $store->no_hp }}</a></i></li>
                                    <li><a href="https://shopee.com/search?keyword={{ urlencode($store->online_store) }}"><i class="fa fa-shopping-cart fa-lg"></i>{{ $store->online_store }}</a></li>
                                </li>
                                </ul>
                            </div>
                    </div>
                </div>
    </div>
</section>
    
<!-- Catalogue -->
<section class="section-wrap pt-30 pb-40 catalogue">
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
                    <div class="row items-grid">
                        @foreach ($products as $product)
                        <div class="col-md-4 col-xs-6 product product-grid">
                            <div class="product-item clearfix">
                                <!-- Product Image -->
                                <div class="product-img hover-trigger">
                                    <a href="/product/{{$product->id}}">
                                        <img src="/uploads/{{$product->gambar}}" alt="">
                                        <img src="/uploads/{{$product->gambar}}" alt="" class="back-img">
                                    </a>
                                    <div class="hover-2">
                                        <div class="product-actions">
                                            <a href="#" class="product-add-to-wishlist">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <a href="/product/{{$product->id}}" class="product-quickview">More</a>
                                </div>
                                <!-- Product Details -->
                                <div class="product-details">
                                    <h3 class="product-title">
                                        <a href="/product/{{$product->id}}">{{$product->nama_barang}}</a>
                                    </h3>
                                    <span class="category">
                                        <a href="/products/{{$product->id_subkategori}}">{{$product->subcategory->nama_subkategori}}</a>
                                    </span>
                                </div>
                                <!-- Product Price -->
                                <span class="price">
                                    <ins>
                                        <span class="amount">Rp. {{number_format($product->harga)}}</span>
                                    </ins>
                                </span>
                            </div>
                        </div> <!-- end product -->
                        @endforeach
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
