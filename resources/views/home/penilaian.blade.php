@extends('layout.home')

@section('title', 'Penilaian')
@section('content')
<!-- Contact -->
<section class="section-wrap contact mb-40">
    <div class="container">
    <h2 class="intro-heading">Penilaian</h2>
        <div class="row">
            <div class="col-md-8 mb-40">
            <form name="testimoni" action="/testimoni" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="contact-name">
                    <label for="">Nama 
                        <abbr class="required" title="required">*</abbr>
                    </label>
                    <input type="text" class="form-control" name="nama_testimoni" placeholder="Nama Testimoni" required>
                </div>
                
                <label for="">Deskripsi
                    <abbr class="required" title="required">*</abbr>
                </label>
                <textarea name="deskripsi" id="" placeholder="Deskripsi" class="form-control" rows="2" required></textarea>
                
                <div class="contact-file mb-50">
                    <label for="">Gambar
                        <abbr class="required" title="required">*</abbr>
                    </label>
                    <input name="gambar" id="gambar" type="file"required>
                </div>
                
                <input type="submit" class="btn btn-lg btn-dark" value="submit" id="">
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
