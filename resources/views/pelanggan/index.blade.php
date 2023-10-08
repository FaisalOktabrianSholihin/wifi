@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pelanggan
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
                                <th>No. Pelanggan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Username</th>
                                <th>Tanggal Pemasangan</th>
                                <th>Tanggal Isolir</th>
                                <th>Status </th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($customers as $item)
                                <tr>
                                    <td>1</td>
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
                                    <td>XIX2023</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>jombang</td>
                                    <td>084321578987</td>
                                    <td>225045</td>
                                    <td>11 Oktober 2023 14:10:33</td>
                                    <td>12 Oktober 2023 14:10:33</td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah ges --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="" action="">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="No Pelanggan" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Username</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Username" required />
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="basic-icon-default-fullname">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="name" name="name" value=""
                                    placeholder="Kata Sandi" required /><span class="input-group-text cursor-pointer"><i
                                        class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Tanggal Pemasangan</label>
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="name" name="name" value=""
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Tanggal Isolir</label>
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="name" name="name" value=""
                                    placeholder="Name" required />
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
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="No Pelanggan" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Username</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Username" required />
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="basic-icon-default-fullname">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="name" name="name"
                                    value="" placeholder="Kata Sandi" required /><span
                                    class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Tanggal Pemasangan</label>
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="name" name="name" value=""
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Tanggal Isolir</label>
                            <div class="input-group input-group-merge">
                                <input type="date" class="form-control" id="name" name="name" value=""
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status_aktif">Status Pelanggan</label>
                            <select class="form-select" id="status_aktif" name="status_survey">
                                <option value="Aktif">
                                    Aktif
                                </option>
                                <option value="Tidak Aktif">Tidak Aktif
                                </option>
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
