<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Produk') }}
            </h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal"><i class="fas fa-plus-circle mr-2"></i>Tambah Produk</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">

                        @if(!empty(count($products)))
                        <span> Menampilkan total {{$count}} produk </span>
                        @foreach($products as $product)
                        <div class="col-md-3 col-sm-6 mt-4">
                            <div class="card">
                                <img class="card-img-top" src="{{$product->photo}}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title mb-0"> {{$product->name}} </h5>
                                    <small class="bg-info text-white rounded px-1"> Rp. {{number_format($product->price)}} </small>
                                    <p class="card-text mt-3"> {{$product->description}} </p>
                                    <form method="POST" action="/product/{{$product->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btnDelete">
                                            <i class="fas fa-eraser mr-2"></i>Hapus
                                        </button>
                                    </form>
                                    <a href="#" class="btn btn-warning btnEdit" data-id="{{$product->id}}">
                                        <i class="fas fa-marker mr-2"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <span>Kamu belum memiliki produk, silahkan ditambahkan.</span>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/product" method="POST" enctype="multipart/form-data" id="form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input required type="text" name="name" class="form-control" id="name">
                        </div>

                        <div class="form-group">
                            <label for="price">Harga</label>
                            <input required type="number" name="price" class="form-control" id="price">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi Produk</label>
                            <textarea required name="description" class="form-control" id="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="photo">Foto Produk</label>
                            <input name="photo" type="file" class="form-control-file" id="photo">
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-2"></i>Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('.btnEdit').on('click', function () {
            $('#modal').modal('show');
            $.get("/product/" + $(this).data('id'), function (data) {
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#price').val(data.price);
                $('#description').val(data.description);
            });
        });

    </script>
    @endpush
</x-app-layout>
