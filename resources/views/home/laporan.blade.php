@extends('layout.home')

@section('title', 'Refund')
@section('content')
<!-- Contact -->
<section class="section-wrap contact mb-40">
    <div class="container">
        <h2 class="intro-heading">Laporan Refund</h2>
        <div class="row">
            <div class="col-md-8 mb-40">
                <form name="laporan" action="/keluhan" enctype="multipart/form-data" method="POST">
                    @csrf
                    @auth('webmember')
                        <input type="hidden" name="id_member" value="{{ Auth::guard('webmember')->user()->id }}">
                    @endauth

                    @foreach ($orders as $order)
                        @if ($order->status == 'Refund')
                        <input type="hidden" name="id_order" value="{{$order->id}}">
                            <label for="">Deskripsi
                                <abbr class="required" title="required">*</abbr>
                            </label>
                            <textarea name="deskripsi" id="" placeholder="Deskripsi" class="form-control" rows="2"></textarea>

                            <div class="contact-file mb-50">
                                <label for="">Gambar
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input name="gambar" id="gambar" type="file">
                            </div>
                        @endif
                    @endforeach
                    <input type="submit" class="btn btn-lg btn-dark" value="Submit">
                </form>
            </div> <!-- end col -->

            <!-- ... (rest of the code) ... -->

        </div>
    </div>
</section> <!-- end contact -->
@endsection

@push('js')
<script>
    $(function(){
        $('.laporan').click(function(e) {
            e.preventDefault();

            var id_member = {{Auth::guard('webmember')->user()->id}};
            var id_order = {{$order->id}};
            var deskripsi = $('textarea[name="deskripsi"]').val('');

            @auth('webmember')
                id_member = {{Auth::guard('webmember')->user()->id}};
            @endauth

            $.ajax({
                url: '/keluhan',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}",
                },
                data: {
                    id_member: id_member,
                    id_order: id_order,
                    deskripsi: deskripsi,
                },
                success: function(response) {
                    if (response === 'success') {
                        id_member = id_member || ""; // Set id_member to an empty string if it's null
                    } else if (response === 'failed') {
                        window.location.replace("failed");
                    }
                },
                error: function() {
                    // Handle error cases if necessary
                }
            })
        });
    });
</script>
@endpush
