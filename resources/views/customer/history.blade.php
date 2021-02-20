<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
            {{ __('Riwayat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered" id="riwayat">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Penjual</th>
                                <th>Waktu Pesan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($riwayat->orders as $order) 
                                <tr class="text-center">
                                    <td class="font-weight-bold"> {{$loop->index+1}}. </td>
                                    <td> {{$order->product->name}} </td>
                                    <td> {{$order->jumlah}} </td>
                                    <td> {{$order->product->owner->name}} </td>
                                    <td> {{$order->created_at}} </td>
                                @if(empty(count($riwayat->orders)))
                                    <td colspan="5"> Belum pernah melakukan pemesanan </td>
                                @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        $(document).ready( function () {
            $('#riwayat').DataTable({
                columnDefs: [
                    { orderable: false, targets: [1,3,4] },
                ],
            });            
        } );
    </script>
    @endpush
</x-app-layout>
