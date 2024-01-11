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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> Pelanggan
            </h4>
            <div class="card">
                <div class="card-body mb-4">
                    <button class="btn btn-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#add-pelanggan">Tambah</button>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>Aksi</th> --}}
                                <th>No Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @can('read ubah paket')
                                @foreach ($pelanggan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        {{-- <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('update ubah paket')
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#ubahpaket{{ $item->id }}" class="dropdown-item"><i
                                                                class="bx bx-share me-1"></i>
                                                            Ubah Paket</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td> --}}
                                        <td>{{ $item->no_pelanggan }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
                                    </tr>
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                    {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal ubah paket ges --}}
    {{-- @foreach ($pelanggan as $item)
        <div class="modal fade" id="ubahpaket{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Ajukan Ubah Paket</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.ikipelanggans.store', $item->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="no_pelanggan" name="no_pelanggan"
                                        value="{{ $item->no_pelanggan }}" placeholder="123123123" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Paket Lama</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="paket_lama" name="paket_lama"
                                        value="{{ $item->paket->paket }}" placeholder="4M" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="paket_baru_id" class="form-label">Pilih Paket Baru</label>
                                <select id="paket_baru_id" class="form-select" name="paket_baru_id" required>
                                    @foreach ($pakets as $item)
                                        <option value="{{ $item->id }}" {{ $item->paket ? 'selected' : '' }}>
                                            {{ $item->paket }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach --}}

@endsection
