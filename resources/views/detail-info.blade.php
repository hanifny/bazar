@extends('layouts.master')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="#"> {{$info->title}} </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->

<div class="shopping-cart section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-3">
                <h1> {{$info->title}} </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-4 text-center">
                <img src="{{$info->photo}}" name="thumbnail-detail" width="275px" class="rounded" alt="thumbnail">
            </div>
            <div class="col-8">
                <p> {!! $info->description !!} </p>
            </div>
        </div>
    </div>
</div>
@endsection
