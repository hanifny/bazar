@extends('layouts.master')

@section('content')

<!-- Start Product Area -->
<div class="product-area section pt-0" id="products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 style="margin-top: 75px">Beli Produk</h2>
                </div>
            </div>
        </div>
        <div class="searchh header shop">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="search-bar-top">
                        <div class="search-bar">
                            <input name="name" placeholder="Cari produk disini....." type="search" id="searchText">
                            <button type="button" id="btnSearch" class="btnn text-white" style="background:#b4aee8"><i class="ti-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="row products">
                        @include('components.products')
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="pagination-wrapper">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                        <a href="/product" class="text-primary" style="margin-top: 50px">Lihat produk lain</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->

<!-- Modal -->
<div class="modal fade" id="productDetail" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close" aria-hidden="true"></span></button>
            </div>
            <div class="modal-body">
                <div class="row p-5">
                    <div class="col-lg-4 col-4">
                        <h4 style="font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">Detail Produk</h4>
                        <h3 style="font-size:30px;color:#333;" id="productName"></h3>
                        <img src="" alt="" style="margin-top: 20px;" id="productImg">
                    </div>
                    <div class="col-lg-8 col-8">
                        <p style="display:block; margin-top:99px; color:#000000; font-size:14px; font-weight:400;" id="productDesc"></p>
                        <h3 style="font-size:21px;color:#333;margin-top:20px;" id="productPrice"></h3>
                        <form action="/cart" method="POST" class="form-inline">
                            @csrf
                            <input type="hidden" name="product_id" id="productId">
                            <input type="hidden" name="in_cart" id="inCart" value="1">
                            <input type="hidden" name="customer_id" id="customerId" value="{{auth()->user() ? auth()->user()->id : ''}}">
                            <input type="number" name="total" placeholder="Jumlah" style="margin-top:30px;padding:13px 32px;">

                            <div class="button" style="margin-top:30px;">
                                @if(auth()->check())
                                <button type="submit" class="btn" style="color:#fff;background:rgb(166, 77, 121);padding: 18px 32px;">Pesan</button>
                                @else
                                <a href="/login" class="btn" style="color:#fff;background:rgb(166, 77, 121)">Pesan</a>
                                @endif
                                <small id="link"></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->
@endsection

@push('scripts')
<script>
    $('.btnBuy').on('click', function () {
        $('#product_id').val($(this).data('id'));
    });

    $('#btnSearch').on('click', function () {
        $.ajax({
            data: {
                text: $('#searchText').val()
            },
            url: '/search',
            type: 'GET',
        }).then(function (html) {
            window.location.href = '#products';
            $('.products').html(html);
        });
    });

    var formatter = new Intl.NumberFormat();

    $('body').on('click', '.detailModal', function () {
        let id = $(this).data('id');
        $.get("/product/" + id, function (data) {
            $('#productName').html(data.name);
            $('#productPrice').html('Rp. ' + formatter.format(data.price));
            $('#productDesc').html(data.description);
            $('#productImg').attr('src', data.photo);
            $('#productId').val(id);
            $('#link').html('');
            if (data.link) {
                $('#link').html(`atau dapat kunjungi <a class="text-primary" href="https://${data.link}"> link ini. </a>`);
            }
        });
    });

</script>
@endpush
