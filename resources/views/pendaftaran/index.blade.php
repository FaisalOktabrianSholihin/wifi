@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pendaftaran
            </h4>
            <div class="card">
                <div class="card-body">
                    @can('create pendaftaran')
                        <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#add-billings">Tambah</button>
                    @endcan
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>NIK</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Nama Sales</th>
                                <th>Status</th>
                                <th>Survey</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">

                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('create pendaftaran')
                                                <button data-bs-toggle="modal" data-bs-target="#update" class="dropdown-item"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</button>
                                            @endcan
                                            @can('create pendaftaran')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-billings"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td>3508289789405673</td>
                                <td>Wawan Samidi</td>
                                <td>Solo</td>
                                <td>086778398432</td>
                                <td></td>
                                <td><span class="badge bg-primary">Belum Survey</span></td>
                                <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#validasi">Validasi</button></td>
                            </tr>
                            {{-- <tr>
                                <td>2</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @can('create pendaftaran')
                                                <button data-bs-toggle="modal" data-bs-target="#update" class="dropdown-item"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</button>
                                            @endcan
                                            @can('create pendaftaran')
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete-billings"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                                <td>3508289789405673</td>
                                <td>Wawan Samidi</td>
                                <td>Solo</td>
                                <td>086778398432</td>
                                <td>Yono</td>
                                <td><span class="badge bg-primary">Belum Survey</span></td>
                                <td><button type="button" class="btn btn-primary">Validasi</button></td>
                            </tr> --}}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="validasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Validasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formValidasi" method="" action="">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Name Sales</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="guard_name" name="guard_name">
                                    <option value="web">Yono</option>
                                    <option value="api">Bahrul</option>
                                </select>
                            </div>
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

    {{-- @foreach ($billings as $value)
        <div class="modal fade" id="update{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Billing</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('super admin.billings.update', $value) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $value->name }}" placeholder="Name" />
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
    @endforeach

    @foreach ($billings as $value)
        <div class="modal fade" id="delete-billings{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('super admin.billings.destroy', $value->id) }}">
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
    @endforeach --}}
@endsection
