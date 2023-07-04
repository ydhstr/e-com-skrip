@extends('layout.home')

@section('content')
<!-- Hero Slider -->
<section class="hero-wrap text-center relative">
    <div id="owl-hero" class="owl-carousel owl-theme light-arrows slider-animated">
        @foreach ($sliders as $slider)
        <div class="hero-slide overlay" style="background-image:url(/uploads/{{$slider->gambar}})">
            <!-- <div class="container">
                <div class="hero-holder">
                    <div class="hero-message">
                        <h1 class="hero-title nocaps">{{$slider->nama_slider}}</h1>
                        <h2 class="hero-subtitle lines">{{$slider->deskripsi}}</h2>
                    </div>
                </div>
            </div> -->
        </div>
        @endforeach
    </div>
</section> 
<!-- end hero slider -->

<!-- Promo Banners -->
<section class="pt-40 pb-20">
    <div class="container">
        <div class="row heading-row">
            <div class="col-md-12 text-center">
                <h2 class="heading bottom-line">
                    Kategori
                </h2>
            </div>
        </div>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-xs-4 col-xxs-12 mb-30 promo-banner">
                    <a href="/products/{{$category->id}}">
                        <img src="/uploads/{{$category->gambar}}" alt="">
                        <div class="overlay"></div>
                        <div class="promo-inner valign">
                            <h2>{{$category->nama_kategori}}</h2>
                            <span>{{$category->deskripsi}}</span>
                        </div>
                    </a>
                    <div class="subcategories">
                        @php
                            $subcategories = App\Models\Subcategory::where('id_kategori', $category->id)->get();
                        @endphp
                        <div class="row">
                            @foreach ($subcategories as $subcategory)
                                <div class="col-md-6">
                                    <!-- Render your subcategory data here -->
                                    <a href="/products/{{$subcategory->id}}">{{$subcategory->nama}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
 <!-- end promo banners -->

<!-- Trendy Products -->
<section class="section-wrap-sm new-arrivals pb-50">
    <div class="container">

        <div class="row heading-row">
            <div class="col-md-12 text-center">
                <span class="subheading">Item terlaris tahun ini</span>
                <h2 class="heading bottom-line">
                    Produk Trendi
                </h2>
            </div>
        </div>

        <div class="row items-grid">
            @foreach ($products as $product)
            <div class="col-md-3 col-xs-6">
                <div class="product-item hover-trigger">
                    <div class="product-img">
                        <a href="/front/shop-single.html">
                            <img src="/uploads/{{$product->gambar}}" alt="">
                        </a>
                        <div class="hover-overlay">
                            <div class="product-actions">
                                <a href="/front/#" class="product-add-to-wishlist">
                                    <i class="fa fa-heart"></i>
                                </a>
                            </div>
                            <div class="product-details valign">
                                <span class="category">
                                    <a
                                        href="/products/{{$product->id_subkategori}}">{{$product->subcategory->nama_subkategori}}</a>
                                </span>
                                <h3 class="product-title">
                                    <a href="/product/{{$product->id}}">{{$product->nama_barang}}</a>
                                </h3>
                                <!-- <span class="price">
                                    <ins>
                                        <span class="amount">Rp. {{number_format($product->harga)}}</span>
                                    </ins>
                                </span> -->
                                <span class="price">
                    @if ($product->diskon)
                                <del>
                                     <span>Rp. {{number_format($product->harga)}}</span>
                                </del>
                                <ins>
                                    <span class="amount">Rp. {{number_format($product->harga - $product->diskon)}}</span>
                                </ins>
                    @else
                               <span>Rp. {{number_format($product->harga)}}</span>
                    @endif
                                </span>
                                <div class="btn-quickview">
                                    <a href="/product/{{$product->id}}" class="btn btn-md btn-color">
                                        <span>More</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div> <!-- end row -->
    </div>
</section> <!-- end trendy products -->

<!-- Testimonials -->
<section class="section-wrap testimonials"
    style="background-image:url(/uploads/testimonialbg1.jpg);">
    <div class="container relative">

        <div class="row heading-row mb-20">
            <div class="col-md-6 col-md-offset-3 text-center">
                <h4 class="heading white bottom-line">Testimoni</h4>
            </div>
        </div>

        <div id="owl-testimonials" class="owl-carousel owl-theme text-center">
            @foreach ($testimonies as $testimony)

            <div class="item">
                <div class="testimonial">
                    <p class="testimonial-text">{{$testimony->deskripsi}}</p>
                    <span>{{$testimony->nama_testimoni}}</span>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</section> <!-- end testimonials -->

@endsection
