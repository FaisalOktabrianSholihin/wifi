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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> ODP Port
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
                                    <th>SN ONU</th>
                                    <th>Merk ONU</th>
                                    <th>Type Onu</th>
                                    <th>No Pelanggan</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($onu as $item)
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
                                        <td>{{ $item->sn_onu }}</td>
                                        <td>{{ $item->merk_onu->merk_onu }}</td>
                                        <td>{{ $item->type_onu->type_onu }}</td>
                                        <td>{{ optional($item->pelanggan)->no_pelanggan }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data ONU</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.onu.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="sn_onu" class="form-label">SN ONU</label>
                            <input class="form-control" type="text" id="sn_onu" name="sn_onu" maxlength="12"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="merk" class="form-label">Pilih Merk Onu</label>
                            <select id="merk" class="form-select" name="merk_onu_id" required>
                                <option value="" selected>Pilih Merk Onu</option>
                                @foreach ($merk as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->merk_onu }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Pilih Type Onu</label>
                            <select id="type" class="form-select" name="type_onu_id" required>
                                <option value="" selected>Pilih Type Onu</option>
                                @foreach ($type as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->type_onu }}
                                    </option>
                                @endforeach
                            </select>
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
    @foreach ($onu as $item)
        <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit ONU</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.onu.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="sn_onu" class="form-label">SN ONU</label>
                                <input class="form-control" type="text" value="{{ $item->sn_onu }}" id="sn_onu"
                                    name="sn_onu" maxlength="12" required />
                            </div>
                            <div class="mb-3">
                                <label for="merk" class="form-label">Pilih Merk Onu</label>
                                <select id="merk" class="form-select" name="merk_onu_id" required>
                                    <option value="" selected>Pilih Merk Onu</option>
                                    @foreach ($merk as $merkItem)
                                        <option value="{{ $merkItem->id }}"
                                            {{ $merkItem->id == $item->merk_onu_id ? 'selected' : '' }}>
                                            {{ $merkItem->merk_onu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Pilih Type Onu</label>
                                <select id="type" class="form-select" name="type_onu_id" required>
                                    <option value="" selected>Pilih Type Onu</option>
                                    @foreach ($type as $typeItem)
                                        <option value="{{ $typeItem->id }}"
                                            {{ $typeItem->id == $item->type_onu_id ? 'selected' : '' }}>
                                            {{ $typeItem->type_onu }}
                                        </option>
                                    @endforeach
                                </select>
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
    @foreach ($onu as $item)
        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('route.onu.destroy', $item->id) }}">
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
