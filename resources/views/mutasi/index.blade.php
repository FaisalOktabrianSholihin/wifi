@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Services /</span> Mutasi
            </h4>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true"
                            style="color: white">Proses
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false" style="color: white">
                            Berhasil
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false" style="color: white">
                            Gagal
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        <div class="card-body mb-4">
                            <button class="btn btn-primary float-end" data-bs-toggle="modal"
                                data-bs-target="#add-mutasi">Tambah</button>
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Status</th>
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
                                                    <button data-bs-toggle="modal" data-bs-target="#assigment"
                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                        Assigment</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>0000001</td>
                                        <td>fawaid</td>
                                        <td>alamat</td>
                                        <td><span class="badge bg-secondary">Belum Diproses</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>0000001</td>
                                        <td>fawaid</td>
                                        <td>alamat</td>
                                        <td><span class="badge bg-secondary">Belum Diproses</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>1</td>
                                        <td>0000001</td>
                                        <td>fawaid</td>
                                        <td>alamat</td>
                                        <td><span class="badge bg-secondary">Belum Diproses</span></td>
                                    </tr>
                                </tbody>
                            </table>
                            {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah ges --}}
    <div class="modal fade" id="add-mutasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-mutasi">Tambahkan Data Mutasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="" action="">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_pelanggan" class="form-label">Cari Pelanggan</label>
                            <input class="form-control" list="datalistOptions" id="no_pelanggan" name="no_pelanggan"
                                placeholder="Cari nama pelanggan" />
                            <datalist id="datalistOptions">
                                <option value="Testing">
                                    Nama Pelanggan = Testing, Jenis Paket = Paket Testing
                                </option>
                            </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_mutasi" class="form-label">Jenis Mutasi</label>
                            <select id="jenis_mutasi" class="form-select" name="jenis_mutasi" required>
                                <option selected>Pilih Jenis Mutasi</option>
                                <option value="titik">Titik</option>
                                <option value="alamat">Alamat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat Baru</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="alamat" name="alamat" value=""
                                    placeholder="alamat" />
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
    <div class="modal fade" id="assigment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Assigment Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user_action" class="form-label">Teknisi</label>
                            <select id="user_action" class="form-select" name="user_action" required>
                                <option selected>Pilih Teknisi</option>
                                <option value="usep">Usep</option>
                                <option value="bambang">Bambang</option>
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

@endsection
