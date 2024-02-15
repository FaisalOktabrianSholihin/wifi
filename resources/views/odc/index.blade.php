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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> ODC
            </h4>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#add">Tambah</button>
                    <div class="table-responsive text-nowrap">
                        <table id="myTable" class="table mb-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>Nama ODC</th>
                                    <th>Kode ODC</th>
                                    <th>Vlan</th>
                                    <th>Keterangan ODC</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($odc as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#update{{ $item->id }}" class="dropdown-item"><i
                                                            class="bx bx-edit-alt me-1"></i>
                                                        Edit</button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $item->id }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->odc }}</td>
                                        <td>{{ $item->kode_odc }}</td>
                                        <td>{{ $item->vlan }}</td>
                                        <td>{{ $item->ket_odc }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah ges --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data ODC</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.odc.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama ODC</label>
                            <input class="form-control" type="text" id="nama" name="odc" required />
                        </div>
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode ODC</label>
                            <input class="form-control" type="text" id="kode" name="kode_odc" required />
                        </div>
                        <div class="mb-3">
                            <label for="vlan" class="form-label">Vlan</label>
                            <input class="form-control" type="number" id="vlan" name="vlan" required />
                        </div>
                        <div class="mb-3">
                            <label for="ket" class="form-label">Keterangan ODC</label>
                            <input class="form-control" type="text" id="ket" name="ket_odc" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- modal edit ges --}}
    @foreach ($odc as $item)
        <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data ODC</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.odc.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama ODC</label>
                                <input class="form-control" type="text" value="{{ $item->odc }}" id="nama"
                                    name="odc" required />
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode ODC</label>
                                <input class="form-control" type="text" value="{{ $item->kode_odc }}" id="kode"
                                    name="kode_odc" required />
                            </div>
                            <div class="mb-3">
                                <label for="vlan" class="form-label">Vlan</label>
                                <input class="form-control" type="number" value="{{ $item->vlan }}" id="vlan"
                                    name="vlan" required />
                            </div>
                            <div class="mb-3">
                                <label for="ket" class="form-label">Keterangan ODC</label>
                                <input class="form-control" type="text" value="{{ $item->ket_odc }}" id="ket"
                                    name="ket_odc" required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach


    {{-- modal hapus ges --}}
    @foreach ($odc as $item)
        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('route.odc.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel1">Apakah Anda Yakin Ingin Menghapus data?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
