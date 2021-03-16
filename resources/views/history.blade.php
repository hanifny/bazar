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
                        <li class="active"><a href="#">Riwayat</a></li>
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
            <div class="col-12">

                @if(!is_null($riwayat))
                @foreach($riwayat->items() as $order)
                @php $sum = 0; @endphp
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title mb-3">Pemesanan {{date('d M Y', strtotime($order[0]->updated_at))}}</h5>
                        <table class="table">
                            <tr class="bg-primary text-white">
                                <td>Nama Barang</td>
                                <td>Nama Pemilik Usaha</td>
                                <td>No. Hp Aktif</td>
                                <td>Harga</td>
                                <td>Jumlah</td>
                                <td>Total Bayar</td>
                            </tr>
                            @foreach($order as $item)
                            <tr>
                                <td> {{$item->product->name}} </td>
                                <td> {{$item->product->owner->name}} </td>
                                <td> {{$item->product->owner->phone_number}} </td>
                                <td> Rp. {{number_format($item->product->price)}} </td>
                                <td> {{$item->total}} </td>
                                <td> Rp. {{number_format($item->total * $item->product->price)}} </td>
                            </tr>
                            @php $sum += $item->total * $item->product->price; @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="font-weight-bold">Total Belanja</td>
                                <td>Rp. {{number_format($sum)}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="pagination-wrapper pb-4 pr-5 justify-content-end d-flex">
                        {{$riwayat->links('pagination::bootstrap-4')}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
