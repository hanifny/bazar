<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-0">
                {{ __('Selamat Datang di "Bazar Online Persari 2021"') }}
            </h2>
            <div class="d-flex">
                <input type="text" class="form-control mr-2" autofocus id="searchText">
                <button type="button" class="btn btn-primary" id="btnSearch"><i class="fas fa-search mr-2"></i>Cari</button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 products">
                    @include('customer.load')
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Pesan Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(auth()->user())
                    <form action="/cart" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="in_cart" id="in_cart" value="1">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{auth()->user() ? auth()->user()->id : ''}}">

                        <div class="input-group mb-2 mr-sm-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Jumlah</div>
                            </div>
                            <input type="text" class="form-control" name="total">
                        </div>

                        <button type="submit" class="btn btn-success mb-2"><i class="fas fa-shopping-cart mr-2"></i>Pesan</button>
                    </form>
                    @else
                    <span>Ooops.. Kamu belum login, <a href="/login">yuk login dulu.</a></span>
                    @endif
                </div>
            </div>
        </div>
    </div>

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
                $('.products').html(html);
            });
        });

    </script>
    @endpush
</x-app-layout>
