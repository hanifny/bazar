<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    <table class="table table-bordered" id="riwayat">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Pembeli</th>
                                <th>Waktu Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order) 
                                <tr class="text-center">
                                    <td class="font-weight-bold"> {{$loop->index+1}}. </td>
                                    <td> {{$order->product->name}} </td>
                                    <td> {{$order->jumlah}} </td>
                                    <td> {{$order->product->owner->name}} </td>
                                    <td> {{$order->created_at}} </td>
                                </tr>
                            @endforeach
                        </tbody>
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

    </script>
    @endpush
</x-app-layout>
