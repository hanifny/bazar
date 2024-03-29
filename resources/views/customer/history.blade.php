<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            {{ __('Riwayat Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if(!is_null($riwayat))
                    @foreach($riwayat->items() as $order)
                    @php $sum = 0; @endphp
                    <div class="card">
                        <div class="card-body mt-2">
                            <h5 class="card-title">Pemesanan {{date('d M Y', strtotime($order[0]->updated_at))}}</h5>
                            <table class="table">
                                <tr class="bg-primary text-white">
                                    <th>Nama Barang</th>
                                    <th>Nama Pemilik Usaha</th>
                                    <th>No. Hp Aktif</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total Bayar</th>
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
                        <div class="card-footer">
                            {{$riwayat->links()}}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
