<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="card">
                        <h5 class="card-header bg-info text-white">Data Owner Menunggu Approve</h5>
                        <div class="card-body">
                            <table class="table" id="needApprovalUsers">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Waktu Registrasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        @for($i = 0; $i < count($needApprovalUsers); $i++) 
                                            <td class="font-weight-bold"> {{$i+1}}. </td>
                                            <td> {{$needApprovalUsers[$i]->name}} </td>
                                            <td> {{$needApprovalUsers[$i]->email}} </td>
                                            <td> {{$needApprovalUsers[$i]->created_at}} </td>
                                            <td>
                                                <form action="/approve/{{$needApprovalUsers[$i]->id}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                    <button type="submit" class="btn btn-success"> 
                                                        <i class="fas fa-check-circle mr-2"></i> Approve 
                                                    </button>
                                                </form>
                                            </td>
                                        @endfor
                                        @if(empty(count($needApprovalUsers)))
                                            <td colspan="5"> Data tidak ada </td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        $(document).ready( function () {
            $('#needApprovalUsers').DataTable({
                columnDefs: [
                    { orderable: false, targets: 4 },
                    { searchable: false, targets: 4 }
                ],
            });            
        } );
    </script>
    @endpush
</x-app-layout>
