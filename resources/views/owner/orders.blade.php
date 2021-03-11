<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table" id="riwayat">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th>No.</th>
                            <th>Tanggal Pesan</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Nama Pemesan</th>
                            <th>No. Hp Aktif</th>
                            <th>Jumlah</th>
                            <th>Total Bayar</th>
                        </tr>
                        </thead>
                        @foreach($orders as $order)
                        <tr>
                            <td class="font-weight-bold"> {{$loop->index+1}}. </td>
                            <td> {{date('d M Y', strtotime($order->updated_at))}} </td>
                            <td> {{$order->product->name}} </td>
                            <td> Rp. {{number_format($order->product->price)}} </td>
                            <td> {{$order->customer->name}} </td>
                            <td> {{$order->customer->phone_number}} </td>
                            <td> {{$order->total}} </td>
                            <td> Rp. {{number_format($order->total * $order->product->price)}} </td>
                        </tr>
                        @endforeach
                    </table>
                    @if(empty($orders))
                    <span> Belum ada pesanan </span>
                    <hr>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $('#riwayat').DataTable();

    </script>
    @endpush
</x-app-layout>
