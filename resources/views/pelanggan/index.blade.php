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
                                {{-- <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Username</th> --}}
                                <th>Status Instalasi</th>
                                <th>Status Aktivasi</th>
                                <th>Status Lunas</th>
                                <th>Status </th>
                                <th>Pembayaran</th>
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
                                                <button data-bs-toggle="modal" data-bs-target="#show{{ $item->id }}"
                                                    class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                    Show</button>
                                                <button data-bs-toggle="modal" data-bs-target="#instalasi"
                                                    class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                    Instalasi</button>
                                                <button data-bs-toggle="modal" data-bs-target="#aktivasi"
                                                    class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                    Aktivasi</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->no_pelanggan }}</td>
                                    <td>{{ $item->nama }}</td>
                                    {{-- <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>{{ $item->username_pppoe }}</td> --}}
                                    <td><span class="badge bg-success">Berhasil Instalasi</span></td>
                                    <td><span class="badge bg-success">Berhasil Aktivasi</span></td>
                                    <td><span class="badge bg-success">Lunas</span></td>
                                    <td><span class="badge bg-success">{{ $item->status_aktif }}</span></td>
                                    <td> <button type="button" class="btn btn-primary">
                                            <span class="tf-icons bx bxs-credit-card" data-bs-toggle="modal"
                                                data-bs-target="#pembayaran"></span>
                                        </button></td>
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

    {{-- modal instalasi ges --}}
    <div class="modal fade" id="instalasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Instalasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="">Status Instalasi</label>
                            <select class="form-select" id="" name="">
                                <option value="Berhasil">
                                    Berhasil
                                </option>
                                <option value="Gagal">Gagal
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

    {{-- modal aktivasi ges --}}
    <div class="modal fade" id="aktivasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Aktivasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="">Status Aktivasi</label>
                            <select class="form-select" id="" name="">
                                <option value="Berhasil">
                                    Berhasil
                                </option>
                                <option value="Gagal">Gagal
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

    {{-- modal show ges --}}
    @foreach ($customers as $item)
        <div class="modal fade" id="show{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="No Pelanggan" value="{{ $item->no_pelanggan }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="No Pelanggan" value="{{ $item->nama }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="No Pelanggan" value="{{ $item->alamat }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="No Pelanggan" value="{{ $item->telepon }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Username Pppoe</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->username_pppoe }}" placeholder="Username" readonly />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="basic-icon-default-fullname">Password Pppoe</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="name" name="name"
                                        value="{{ $item->password_pppoe }}" placeholder="Kata Sandi" readonly /><span
                                        class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Pemasangan</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" id="name" name="name"
                                        value="{{ $item->tgl_pemasangan }}" placeholder="Name" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Isolir</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" id="name" name="name"
                                        value="{{ $item->tgl_isolir }}" placeholder="Name" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Status Aktif</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->status_aktif }}" placeholder="Status Aktif" readonly />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal pembayaran ges --}}
    <div class="modal fade" id="pembayaran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formpembayaran" method="" action="">
                    {{-- @csrf --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Biaya</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    required />
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="basic-icon-default-fullname">Bayar</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    required /><span class="input-group-text cursor-pointer"><i></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="basic-icon-default-fullname">Diskon</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    required /><span class="input-group-text cursor-pointer"><i></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="">Status Lunas</label>
                            <select class="form-select" id="" name="">
                                <option value="Belum Lunas">
                                    Belum Lunas
                                </option>
                                <option value="Lunas">Lunas
                                </option>
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
