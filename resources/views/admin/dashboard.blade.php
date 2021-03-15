<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Pemilik Usaha Menunggu Validasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table" id="needApprovalUsers">
                        <tr class="bg-primary text-white">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Waktu Registrasi</th>
                            <th>Aksi</th>
                        </tr>
                        @for($i = 0; $i < count($needApprovalUsers); $i++) 
                        <tr>
                            <td class="font-weight-bold"> {{$i+1}}. </td>
                            <td> {{$needApprovalUsers[$i]->name}} </td>
                            <td> {{$needApprovalUsers[$i]->email}} </td>
                            <td> {{$needApprovalUsers[$i]->created_at}} </td>
                            <td>
                                <form action="/approve/{{$needApprovalUsers[$i]->id}}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-check-circle mr-2"></i> Validasi
                                    </button>
                                </form>
                            </td>
                        @endfor
                        </tr>
                        @if(empty(count($needApprovalUsers)))
                        <tr>
                            <td colspan="5"> Data tidak ada </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>