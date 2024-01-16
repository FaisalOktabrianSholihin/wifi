@extends('layouts.app')
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('message'))
                Swal.fire({
                    title: 'Berhasil',
                    text: '{{ Session::get('message') }}',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            @endif
            @if ($errors->any())
                var errorMessage = '';
                @foreach ($errors->all() as $error)
                    errorMessage += '{{ $error }}\n';
                @endforeach

                Swal.fire({
                    title: 'Error',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            @endif
        });
    </script>
@endpush
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pelanggan
            </h4>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="myTable" class="table mb-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>No. Pelanggan</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($pelanggan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button data-bs-toggle="modal" data-bs-target="#show{{ $item->id }}"
                                                        class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                        Info</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->no_pelanggan }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        @foreach ($pelanggan as $item)
            $('#btnCetakPdf{{ $item->id }}').click(function() {
                var id = {{ $item->pemasangan_id }};
                var pdfUrl = "{{ route('route.pelanggans.invoice', ':id') }}".replace(':id', id);
                window.open(pdfUrl, '_blank');
            });
        @endforeach
    </script>
@endpush
