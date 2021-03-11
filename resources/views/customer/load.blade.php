<div class="row mb-5">
    @if(!empty(count($products)))
        <span> Menampilkan total {{count($products)}} produk </span>
        @foreach($products as $product)
            <div class="col-md-3 col-sm-6 mt-4">
                <div class="card">
                    <img class="card-img-top" src="{{$product->photo}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title mb-0"> {{$product->name}} </h5>
                        <small class="bg-info text-white rounded px-1"> Rp. {{number_format($product->price)}} </small><br>
                        <small> Oleh <span style="font-weight:600"> {{$product->owner->name}} </span> </small><br><br>
                        <p class="text-justify"> {{$product->description}} </p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="#" class="btn btn-success btnBuy" data-id="{{$product->id}}" data-toggle="modal" data-target="#modal">
                                <i class="fas fa-shopping-cart mr-2"></i>Pesan Produk
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <span>Kamu belum memiliki produk, silahkan ditambahkan.</span>
    @endif
    </div>
    {{$products->links()}}
</div>