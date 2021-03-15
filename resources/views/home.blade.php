@extends('layouts.master')

@section('content')
<!-- Informasi  -->
<section class="shop-blog section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Informasi</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July , 2020. Monday</p>
                        <a href="#" class="title">Sed adipiscing ornare.</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July, 2020. Monday</p>
                        <a href="#" class="title">Man’s Fashion Winter Sale</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Single Blog  -->
                <div class="shop-single-blog">
                    <img src="https://via.placeholder.com/370x300" alt="#">
                    <div class="content">
                        <p class="date">22 July, 2020. Monday</p>
                        <a href="#" class="title">Women Fashion Festive</a>
                        <a href="#" class="more-btn">Continue Reading</a>
                    </div>
                </div>
                <!-- End Single Blog  -->
            </div>
        </div>
    </div>
</section>
<!-- Informasi  -->

<!-- Start Product Area -->
<div class="product-area section pt-0" id="products">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Beli Produk</h2>
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
                        <p style="display:block; margin-top:75px; color:#000000; font-size:14px; font-weight:400;" id="productDesc"></p>
                        <div class="button" style="margin-top:30px;">
                            <a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/" target="_blank" class="btn" style="color:#fff;background:rgb(166, 77, 121)">Tambah ke keranjang</a>
                            <small id="link"></small>
                        </div>
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

    $('body').on('click', '.detailModal', function () {
        $.get("/product/" + $(this).data('id'), function (data) {
            $('#productName').html(data.name);
            $('#productDesc').html(data.description);
            $('#productImg').attr('src', data.photo);
            $('#link').html('');
            if (data.link) {
                $('#link').html(`atau dapat kunjungi <a class="text-primary" href="https://${data.link}"> link ini. </a>`);
            }
        });
    });

</script>
@endpush
