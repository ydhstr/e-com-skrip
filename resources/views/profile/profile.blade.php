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
              <li>
                <a href="index.html">Pages</a>
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
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="profile-edit-btn"><h6>Change Photo</h6><input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        Hasni
                                    </h5>
                                    <p class="profile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="/orders" role="tab" aria-controls="home" aria-selected="true">Pesanan</a>
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="/orders" role="tab" aria-controls="home" aria-selected="true">Pembayaran</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
    </div>
</section> <!-- end contact -->
@endsection
