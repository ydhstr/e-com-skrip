@extends('layout.home')

@section('title', 'Product')

@section('content')

<!-- Single Product -->
<section class="section-wrap pb-40 single-product">
    <div class="container-fluid semi-fluid">
        <div class="row">

            <div class="col-md-6 col-xs-12 product-slider mb-60">

                <div class="flickity flickity mfp-hover" id="gallery-main">

                    <div class="gallery-cell">
                        <a href="/uploads/{{$product->gambar}}" class="lightbox-img">
                            <img src="/uploads/{{$product->gambar}}" alt="" />
                            <i class="ui-zoom zoom-icon"></i>
                        </a>
                    </div>
                   <!--  <div class="gallery-cell">
                        <a href="/uploads/{{$product->gambar}}" class="lightbox-img">
                            <img src="/uploads/{{$product->gambar}}" alt="" />
                            <i class="ui-zoom zoom-icon"></i>
                        </a>
                    </div>
                    <div class="gallery-cell">
                        <a href="/uploads/{{$product->gambar}}" class="lightbox-img">
                            <img src="/uploads/{{$product->gambar}}" alt="" />
                            <i class="ui-zoom zoom-icon"></i>
                        </a>
                    </div>
                    <div class="gallery-cell">
                        <a href="/uploads/{{$product->gambar}}" class="lightbox-img">
                            <img src="/uploads/{{$product->gambar}}" alt="" />
                            <i class="ui-zoom zoom-icon"></i>
                        </a>
                    </div>
                    <div class="gallery-cell">
                        <a href="/uploads/{{$product->gambar}}" class="lightbox-img">
                            <img src="/uploads/{{$product->gambar}}" alt="" />
                            <i class="ui-zoom zoom-icon"></i>
                        </a>
                    </div> -->
                </div> <!-- end gallery main -->

               <!--  <div class="gallery-thumbs">
                    <div class="gallery-cell">
                        <img src="/uploads/{{$product->gambar}}" alt="" />
                    </div>
                    <div class="gallery-cell">
                        <img src="/uploads/{{$product->gambar}}" alt="" />
                    </div>
                    <div class="gallery-cell">
                        <img src="/uploads/{{$product->gambar}}" alt="" />
                    </div>
                    <div class="gallery-cell">
                        <img src="/uploads/{{$product->gambar}}" alt="" />
                    </div>
                    <div class="gallery-cell">
                        <img src="/uploads/{{$product->gambar}}" alt="" />
                    </div>
                </div>  --><!-- end gallery thumbs -->

            </div> <!-- end col img slider -->

            <div class="col-md-6 col-xs-12 product-description-wrap">
                <ol class="breadcrumb">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="/products/{{$product->id_subkategori}}">{{$product->subcategory->nama_subkategori}}</a>
                    </li>
                    <li class="active">
                        Catalog
                    </li>
                </ol>
                <h1 class="product-title">{{$product->nama_barang}}</h1>
                <!-- <span class="price">
                <del>
                  <span>Rp. {{number_format($product->harga)}}</span>
                </del>
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
                  <ins><span>Rp. {{number_format($product->harga)}}</span></ins>
                @endif
                </span>
                <p class="short-description">{{$product->deskripsi}}</p>

                <div class="color-swatches clearfix">
                    <span>Color:</span>
                    @php
                    $colours = explode(',',$product->warna);
                    @endphp

                    @foreach ($colours as $colour)
                    <input type="radio" name="color" id="{{$colour}}" value="{{$colour}}" class="color">
                    <label for="{{$colour}}" style="margin-right: 20px">{{$colour}}</label>
                    @endforeach
                </div>

                <div class="size-options clearfix">
                    <span>Size:</span>
                    @php
                    $sizes = explode(',',$product->ukuran);
                    @endphp

                    @foreach ($sizes as $size)
                    <input type="radio" name="size" id="{{$size}}" value="{{$size}}" class="size">
                    <label for="{{$size}}" style="margin-right: 20px">{{$size}}</label>
                    @endforeach
                </div>
                <div class="size-options clearfix mt-40">
                    <span>Stok:</span>
                    <label for="{{$product->stock}}" style="margin-right: 20px">{{$product->stock}}</label>
                </div>

                <div class="product-actions">
                    <span>Qty:</span>

                    <div class="quantity buttons_added">
                        <input type="number" step="1" min="0" value="1" title="Qty"
                            class="input-text jumlah qty text" />
                        <div class="quantity-adjust">
                            <a href="#" class="plus">
                                <i class="fa fa-angle-up"></i>
                            </a>
                            <a href="#" class="minus">
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    <a href="{{ Auth::guard('webmember')->check() ? '/cart' : '/login_member' }}" class="btn btn-dark btn-lg add-to-cart"><span>Add to Cart</span></a>
                    {{-- <a href="#" class="product-add-to-wishlist"><i class="fa fa-heart"></i></a> --}}
                </div>


                <div class="product_meta">
                    <span class="sku">SKU: <a href="#">{{$product->sku}}</a></span>
                    <span class="brand_as">Category: <a href="#">{{$product->category->nama_kategori}}</a></span>
                    <span class="posted_in">Tags: <a href="#">{{$product->tags}}</a></span>
                </div>

                <!-- Accordion -->
                <div class="panel-group accordion mb-50" id="accordion">
                    <div class="panel">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                class="minus">Description<span>&nbsp;</span>
                            </a>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                {{$product->deskripsi}}
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                                class="plus">Information<span>&nbsp;</span>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <table class="table shop_attributes">
                                    <tbody>
                                        <tr>
                                            <th>Ukuran:</th>
                                            <td>{{$product->ukuran}}</td>
                                        </tr>
                                        <tr>
                                            <th>Warna:</th>
                                            <td>{{$product->warna}}</td>
                                        </tr>
                                        <tr>
                                            <th>Bahan:</th>
                                            <td>{{$product->bahan}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

               <!--  <div class="socials-share clearfix">
                    <span>Share:</span>
                    <div class="social-icons nobase">
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-google"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div> -->
            </div> <!-- end col product description -->
        </div> <!-- end row -->

    </div> <!-- end container -->
</section> <!-- end single product -->


<!-- Related Products -->
<section class="section-wrap pt-0 shop-items-slider">
    <div class="container">
        <div class="row heading-row">
            <div class="col-md-12 text-center">
                <h2 class="heading bottom-line">
                    Latest Products
                </h2>
            </div>
        </div>

        <div class="row">

            <div id="owl-related-items" class="owl-carousel owl-theme">
                @foreach ($latest_products as $produk)
                <div class="product">
                    <div class="product-item hover-trigger">
                        <div class="product-img">
                            <a href="/product/{{$produk->id}}">
                                <img src="/uploads/{{$produk->gambar}}" alt="">
                                <img src="/uploads/{{$produk->gambar}}" alt="" class="back-img">
                            </a>
                            <div class="product-label">
                                <span class="sale">sale</span>
                            </div>
                            <div class="hover-2">
                                <div class="product-actions">
                                    <a href="#" class="product-add-to-wishlist">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                </div>
                            </div>
                            <a href="/product/{{$produk->id}}" class="product-quickview">More</a>
                        </div>
                        <div class="product-details">
                            <h3 class="product-title">
                                <a href="/product/{{$produk->id}}">{{$produk->nama_barang}}</a>
                            </h3>
                            <span class="category">
                                <a
                                    href="/products/{{$produk->id_subkategori}}">{{$produk->subcategory->nama_subkategori}}</a>
                            </span>
                        </div>
                                <span class="price">
                @if ($produk->diskon)
                  <del>
                      <span>Rp. {{number_format($produk->harga)}}</span>
                  </del>
                <ins>
                       <span class="amount">Rp. {{number_format($produk->harga - $produk->diskon)}}</span>
                 </ins>
                  @else
                  <ins><span>Rp. {{number_format($produk->harga)}}</span></ins>
                @endif
                </span>
                        </span>
                    </div>
                </div>
                @endforeach
            </div> <!-- end slider -->

        </div>
    </div>
</section> <!-- end related products -->

@endsection
@push('js')
<script>
    $(function() {
      $('.add-to-cart').click(function(e) {
        e.preventDefault(); // Prevent default click behavior
  
        var id_member = null;
        var id_barang = {{$product->id}};
        var jumlah = $('.jumlah').val();
        var size = $('.size:checked').val();
        var color = $('.color:checked').val();
        var harga = {{$product->harga}};
        var diskon = {{$product->diskon}};
        var total = (harga - diskon) * jumlah;
        var is_checkout = 0;
  
        @auth('webmember')
        id_member = {{Auth::guard('webmember')->user()->id}};
        @endauth
  
        // Check if color and size are selected
        if (color === undefined || size === undefined) {
          alert('Please select color and size.');
          return; // Stop further execution
        }
  
        // Check if the user is logged in
        @guest('webmember')
        alert('Please log in to add the item to your cart.');
        window.location.href = '/login_member';
        return; // Stop further execution
        @endguest
  
        $.ajax({
          url: '/add_to_cart',
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': "{{csrf_token()}}",
          },
          data: {
            id_member: id_member,
            id_barang: id_barang,
            jumlah: jumlah,
            size: size,
            color: color,
            total: total,
            is_checkout: is_checkout,
          },
          success: function(response) {
            if (response === 'success') {
              id_member = id_member || ""; // Set id_member to an empty string if it's null
            } else if (response === 'failed') {
              window.location.replace("failed");
            }
            window.location.href = '{{ Auth::guard("webmember")->check() ? "/cart" : "/login_member" }}';
          },
          error: function() {
            // Handle error cases if necessary
          }
        });
      });
  
      $('form[name="checkout"]').submit(function(event) {
        var selectedColor = $('input[name="color"]:checked').val();
        var selectedSize = $('input[name="size"]:checked').val();
  
        if (selectedColor === undefined || selectedSize === undefined) {
          event.preventDefault(); // Prevent form submission
          alert('Please select color and size.');
        }
      });
    });
  </script>
@endpush