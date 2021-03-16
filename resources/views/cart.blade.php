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
                        <li class="active"><a href="#">Keranjangku</a></li>
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
                <div class="card">
                    <form action='/buy' method='POST'>
                        @csrf
                        <table class="table" id="riwayat">
                            <tr class="bg-primary text-white" style="font-weight: 600;">
                                <td>Nama Barang</td>
                                <td>Harga</td>
                                <td>Nama Pemilik Usaha</td>
                                <td>Jumlah</td>
                                <td>Total Bayar</td>
                                <td><input type="checkbox" id="checkAll"></td>
                            </tr>
                            @if(count($cart) != 0)
                            @php $sum = 0; @endphp
                            @foreach($cart as $item)
                            <tr>
                                <td style="font-weight: 600;"> {{$item->product->name}} </td>
                                <td> Rp. {{number_format($item->product->price)}}. </td>
                                <td> {{$item->product->owner->name}} </td>
                                <td> {{$item->total}} </td>
                                <td> Rp. {{number_format($item->product->price * $item->total)}}. </td>
                                <td><input id="checkItem" type="checkbox" name="order_{{$loop->index+1}}" value="{{$item->id}}"></td>
                            </tr>
                            @php $sum += $item->total * $item->product->price; @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="font-weight-bold">Total Belanja</td>
                                <td>Rp. {{number_format($sum)}}</td>
                                <td></td>
                            </tr>
                            <tr class="text-right">
                                <td style="border: none; padding-bottom: 0" colspan="6"><button type="submit" class="btnn">Lanjut</button></td>
                            </tr>
                            @else
                            <tr class="text-center">
                                <td colspan="6"> Anda belum melakukan pemesanan </td>
                            </tr>
                            @endif
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#checkAll").on('click', function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

</script>
@endpush
