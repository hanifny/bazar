@extends('layouts.master')

@section('content')
<!-- Informasi  -->
<section class="product-area section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 style="margin-top: 75px">Informasi</h2>
                </div>
            </div>
        </div>
        <div class="row">

            @foreach($posts as $post)
            <div class="col-lg-3 col-md-4 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="{{$post->photo}}" alt="#">
                    <div class="content">
                        <p class="date"> {{date('d M Y', strtotime($post->created_at))}} </p>
                        <a href="/information/{{$post->id}}" class="title">{{$post->title}}</a>
                        <a href="/information/{{$post->id}}" class="more-btn">Lanjutkan membaca</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Informasi  -->
@endsection