<x-app-layout>
    <x-slot name="header">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Informasi') }}
            </h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal" id="btnAdd"><i class="fas fa-plus-circle mr-2"></i>Tambah Informasi</button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table" id="posts">
                        <tr class="bg-primary text-white">
                            <th>No.</th>
                            <th>Judul</th>
                            <th>Thumbnail</th>
                            <th>Aksi</th>
                        </tr>
                        @for($i = 0; $i < count($posts); $i++) <tr>
                            <td class="font-weight-bold" style="vertical-align: middle;"> {{$i+1}}. </td>
                            <td style="vertical-align: middle;"> {{$posts[$i]->title}} </td>
                            <td style="width:30%"> <img src="{{$posts[$i]->photo}}" alt="" class="w-25 rounded"> </td>
                            <td style="vertical-align: middle;">
                                <form method="POST" action="/information/{{$posts[$i]->id}}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times-circle mr-2"></i> Hapus
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary btnEdit" data-id="{{$posts[$i]->id}}" data-toggle="modal" data-target="#modal">
                                    <i class="fas fa-check-circle mr-2"></i> Edit
                                </button>
                            </td>
                            @endfor
                            </tr>
                            @if(empty(count($posts)))
                            <tr class="text-center">
                                <td colspan="4"> Data tidak ada </td>
                            </tr>
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah-Edit -->
    <div class="modal fade" id="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="/information" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="title" class="col-form-label">Judul Informasi</label>
                                    <input name="title" type="text" class="form-control" required id="title">
                                </div>
                                <div class="form-group">
                                    <label for="description" class="col-form-label">Deskripsi</label>
                                    <textarea id="description" name="description" class="form-control">{!! old('description', $description ?? '') !!}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="photo" class="col-form-label">Foto</label> &nbsp;(maks. 2MB)
                                            <div id="photo-form">
                                                <img src="" alt="photo" id="photo-edit" width="275px" class="rounded d-block mb-2">
                                            </div>
                                            <input name="photo" type="file" ref="photo" required id="photo" class="form-control-file">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-success btn-block btn-login text-uppercase font-weight-bold mb-2" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal tambah-edit -->

    @push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // CKEditor
        CKEDITOR.replace('description', options);
        CKEDITOR.config.height = '9em';

        $('#btnAdd').on('click', function () {
            $('#modal').modal('show');
            $('#photo-form').hide();
            CKEDITOR.instances['description'].setData(null);
            $('#modalLabel').html('Tambah Informasi');
            $('#form').trigger("reset");
            $('#id').val('');
        });

        //TOMBOL EDIT DATA PER BERITA DAN MENAMPILKAN DATA BERDASARKAN ID BERITA KE MODAL
        $('body').on('click', '.btnEdit', function () {
            let infoId = $(this).data('id');
            $.get('/get-information/' + infoId, function (data) {
                $('#modalLabel').html("Edit Informasi");
                $('#modal').modal('show');
                //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#photo').removeAttr('required');
                $('#photo-form').show();
                $('#photo-edit').attr('src', data.photo);
                CKEDITOR.instances['description'].setData(data.description);
            })
        });

    </script>
    @endpush
</x-app-layout>
