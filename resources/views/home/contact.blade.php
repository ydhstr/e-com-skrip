@extends('layout.home')

@section('content')
<!-- Contact -->
<section class="section-wrap contact pb-40">
    <div class="container">
    <h2 class="intro-heading">Aduan</h2>
        <div class="row">

            <div class="col-md-8 mb-40">
                <form name="aduan" id="aduan" action="/aduan" method="POST">
                    @csrf
                    <div class="contact-name">
                        <input name="nama" id="nama" type="text" placeholder="Name*">
                    </div>
                    <div class="contact-email">
                        <input name="email" id="email" type="email" placeholder="E-mail*">
                    </div>
                    <div class="contact-subject">
                        <input name="subjek" id="subjek" type="text" placeholder="Subject">
                    </div>

                    <textarea name="deskripsi" id="deskripsi" placeholder="Message" rows="6"></textarea>

                    <input type="submit" class="btn btn-lg btn-dark btn-submit" value="submit" id="">
                </form>
            </div> <!-- end col -->

            <div class="col-md-3 col-md-offset-1 col-sm-5 mb-40">
                <div class="contact-item">
                    <h6>Address</h6>
                    <address>{{$about->judul_website}}<br>
                        {{$about->alamat}}</address>
                </div> <!-- end address -->

                <div class="contact-item">
                    <h6>Information</h6>
                    <ul>
                        <li>
                            <i class="fa fa-envelope"></i><a href="mailto:{{$about->email}}">{{$about->email}}</a>
                        </li>
                        <li>
                            <i class="fa fa-phone"></i><span>{{$about->telepon}}</span>
                        </li>
                    </ul>
                </div> <!-- end information -->
            </div>

        </div>
    </div>
</section> <!-- end contact -->
@endsection
