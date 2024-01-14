@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> Paket
            </h4>
            <div class="card">
                <div class="card-body">
                    <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                        data-bs-target="#add">Tambah</button>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Paket</th>
                                <th>Iuran</th>
                                <th>Instalasi</th>
                                <th>Ubah Paket</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pakets as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button data-bs-toggle="modal" data-bs-target="#update"
                                                    class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                    Edit</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->paket }}</td>
                                    <td>{{ $item->iuran }}</td>
                                    <td>{{ $item->instalasi }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah ges --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="" action="">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Paket</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="paket" name="paket" value=""
                                    placeholder="paket" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Iuran</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="iuran" name="iuran" value=""
                                    placeholder="iuran" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Instalasi</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="instalasi" name="instalasi" value=""
                                    placeholder="instalasi" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Ubah Paket</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="ubah_paket" name="ubah_paket" value=""
                                    placeholder="ubah paket" required />
                            </div>
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
    <div class="modal fade" id="update" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Paket</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="paket" name="paket" value=""
                                    placeholder="paket" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Iuran</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="iuran" name="iuran" value=""
                                    placeholder="iuran" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Instalasi</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="instalasi" name="instalasi"
                                    value="" placeholder="instalasi" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Ubah Paket</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="ubah_paket" name="ubah_paket"
                                    value="" placeholder="ubah paket" required />
                            </div>
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


    {{-- modal hapus ges --}}
    <div class="modal fade" id="delete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="" action="">
                {{-- @csrf
                    @method('DELETE') --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Apakah Anda Yakin Ingin Menghapus data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@endsection
