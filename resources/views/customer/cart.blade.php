<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            {{ __('Daftar Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card">
                        <form action='/buy' method='POST'>
                            @csrf
                            <table class="table mt-3" id="riwayat">
                                <tr class="bg-primary text-white">
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Nama Pemilik Usaha</th>
                                    <th>Jumlah</th>
                                    <th>Total Bayar</th>
                                    <th><input type="checkbox" id="checkAll"></th>
                                </tr>
                                @if(count($cart) != 0)
                                @php $sum = 0; @endphp
                                @foreach($cart as $item)
                                <tr>
                                    <td> {{$item->product->name}} </td>
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
                                    <td style="border: none; padding-bottom: 0" colspan="6"><button type="submit" class="btn btn-success">Lanjut</button></td>
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

    @push('scripts')
    <script>
        $("#checkAll").on('click', function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });

    </script>
    @endpush
</x-app-layout>
