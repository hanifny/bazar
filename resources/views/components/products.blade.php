@if(!empty(count($products)))
@foreach($products as $product)
<div class="col-xl-3 col-lg-4 col-md-4 col-12">
    <div class="single-product">
        <div class="product-img">
            <a href="#" data-toggle="modal" data-target="#productDetail" data-id="{{$product->id}}" class="detailModal">
                <img class="default-img" src="{{$product->photo}}" alt="#">
                <img class="hover-img" src="{{$product->photo}}" alt="#">
            </a>
            <div class="button-head">
                <div class="product-action">
                    <a data-toggle="modal" data-target="#productDetail" data-id="{{$product->id}}" title="Quick View" href="#" class="detailModal"><i class="ti-shopping-cart"></i></a>
                </div>
                <div class="product-action-2">
                    <a title="Add to cart" href="#" data-toggle="modal" data-id="{{$product->id}}" data-target="#productDetail" class="detailModal">Tambah ke keranjang</a>
                </div>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="#" data-toggle="modal" data-target="#productDetail" data-id="{{$product->id}}" class="detailModal">{{$product->name}}</a></h3>
            <div class="product-price">
                <span>Rp. {{number_format($product->price)}}</span>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif