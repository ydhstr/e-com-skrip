@extends('layout.home')

@section('title', 'Profile')

@section('content')
<!-- Contact -->
<section class="page-title text-center bg-img overlay" style="background-image: url(img/page_title/contact_title_bg.jpg)">
    <div class="container relative clearfix">
        <div class="title-holder">
            <div class="title-text">
                <h1 class="uppercase">Profile</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="active">
                        Profile
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="section-wrap contact pb-40">
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img rel="shortcut icon" src="/sbadmin2/img/undraw_profile.svg" width="300" height="200" alt=""/>
                        <!-- <div class="profile-edit-btn">
                            <h6>Change Photo</h6>
                            <input type="file" name="file"/>
                        </div> -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5>{{Auth::guard('webmember')->user()->nama_member}} </h5>
                        <!-- <p class="profile-rating">RANKINGS : <span>8/10</span></p> -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="true">Pesanan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Pembayaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false">Layanan Aduan</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                </div> -->
            </div>
        </form>
    </div> <!-- end container -->
</section> <!-- end contact -->
@endsection
