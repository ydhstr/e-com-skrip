@extends('layout.home')

@section('title', 'Checkout')

@section('content')
<!-- Checkout -->
<section class="section-wrap checkout pb-70">
    <div class="container relative">
        <div class="row">

            <div class="ecommerce col-xs-12">

                <form name="checkout" class="checkout ecommerce-checkout row" method="POST" action="/payments">
                    @csrf
                    <input type="hidden" name="id_order" value="{{$orders->id}}">
                    <div class="col-md-8" id="customer_details">
                        <div>
                            <h2 class="heading uppercase bottom-line full-grey mb-30">billing address</h2>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">Provinsi
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <select name="provinsi" id="provinsi" class="country_to_state provinsi"
                                    rel="calc_shipping_state">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinsi->rajaongkir->results as $provinsi)
                                    <option value="{{$provinsi->province_id}}">{{$provinsi->province}}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">Kota
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <select name="kabupaten" id="kota" class="country_to_state kota"
                                    rel="calc_shipping_state">

                                </select>
                            </p>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">Detail Alamat
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input type="text" class="input-text" placeholder value name="detail_alamat"
                                    id="billing_first_name">
                            </p>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">Atas Nama
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input type="text" class="input-text" placeholder value name="atas_nama"
                                    id="billing_first_name">
                            </p>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">No Rekening
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input type="text" class="input-text" placeholder value name="no_rekening"
                                    id="billing_first_name">
                            </p>
                            <p class="form-row form-row-first validate-required ecommerce-invalid ecommerce-invalid-required-field"
                                id="billing_first_name_field">
                                <label for="billing_first_name">Nominal Transfer
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input type="text" class="input-text" placeholder value name="jumlah"
                                    id="billing_first_name" disabled>
                            </p>
                            <div class="clear"></div>

                        </div>

                        <div class="clear"></div>

                    </div> <!-- end col -->

                    <!-- Your Order -->
                    <div class="col-md-4">
                        <div class="order-review-wrap ecommerce-checkout-review-order" id="order_review">
                            <h2 class="heading uppercase bottom-line full-grey">Pesananmu</h2>
                            <table class="table shop_table ecommerce-checkout-review-order-table">
                                <tbody>
                                    <tr class="order-total">
                                        <th><strong>Order Total</strong></th>
                                        <td>
                                        @php
        $latestOrder = \App\Models\Order::latest('id')->first();
        $grandTotal = $latestOrder ? $latestOrder->grand_total : 0;
        @endphp
        <strong><span class="amount">Rp. {{ number_format($grandTotal) }}</span></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div id="payment" class="ecommerce-checkout-payment">
                                <h2 class="heading uppercase bottom-line full-grey">Pilih Pembayaran</h2>
                                <ul class="payment_methods methods">
                                    <li class="payment_method_bacs">
                                        <input id="payment_method_bacs" type="radio" class="input-radio"
                                            name="payment" value="Transfer">
                                        <label for="payment_method_bacs">Bank Transfer</label>
                                        <div class="payment_box payment_method_bacs">
                                            <p>Pembayaran dengan melalui perantara transfer bank.</p>
                                            <p>Atas Nama : {{$about->atas_nama}}</p>
                                            <p>No Rekening : {{$about->no_rekening}}</p>
                                        </div>
                                    </li>
                        <li class="payment_method_cheque">
                                <input id="payment_method_cheque" type="radio" class="input-radio" name="payment" value="COD">
                                    <label for="payment_method_cheque">Cash On Delivery</label>
                                <div class="payment_box payment_method_cheque">
                                    <p>Pengiriman Bayar saat barang sudah sammpai</p>
                            </div>
                        </li>
                    </ul>
                                <div class="form-row place-order">
                                    <input type="submit" name="ecommerce_checkout_place_order"
                                        class="btn btn-lg btn-dark" id="place_order" value="Place order">
                                </div>
                            </div>
                        </div>
                    </div> <!-- end order review -->
                </form>

            </div> <!-- end ecommerce -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end checkout -->
@endsection


@push('js')
<script>
    $(function(){
            $('.provinsi').change(function(){
            $.ajax({
            url : '/get_kota/' + $(this).val(),
            success : function (data){
            data = JSON.parse(data)
            option = ""
            data.rajaongkir.results.map((kota)=> {
            option += `<option value=${kota.city_id}>${kota.city_name}</option>`
            })
            $('.kota').html(option)
            }
            });
            });
        })
</script>
<script>
    $(document).ready(function() {
        $('input[name="payment"]').change(function() {
            var paymentMethod = $(this).val();
            var grandTotal = "{{ $grandTotal }}"; // Nilai grand_total yang Anda miliki

            if (paymentMethod === 'Transfer') {
                $('input[name="jumlah"]').val(grandTotal);
                $('input[name="no_rekening"]').val('');
            } else if (paymentMethod === 'COD') {
                $('input[name="jumlah"]').val('0');
                $('input[name="no_rekening"]').val('0');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('form[name="checkout"]').submit(function(event) {
            var paymentMethod = $('input[name="payment"]:checked').val();

            if (paymentMethod === undefined) {
                event.preventDefault(); // Mencegah pengiriman formulir
                alert('Mohon pilih metode pembayaran.');
            }
        });
$('form[name="checkout"]').submit(function(event) {
            var paymentMethod = $('input[name="payment"]:checked').val();
            var provinsi = $('select[name="provinsi"]').val();
            var kota = $('select[name="kabupaten"]').val();
            var detailAlamat = $('input[name="detail_alamat"]').val();
            var atasNama = $('input[name="atas_nama"]').val();
            var noRekening = $('input[name="no_rekening"]').val();
            var jumlah = $('input[name="jumlah"]').val();

            if (
                paymentMethod === undefined ||
                provinsi === '' ||
                kota === '' ||
                detailAlamat === '' ||
                atasNama === '' ||
                noRekening === '' ||
                jumlah === ''
            ) {
                event.preventDefault(); // Mencegah pengiriman formulir
                alert('Mohon lengkapi semua kolom.');
            }
        });
    });
    </script>
@endpush
