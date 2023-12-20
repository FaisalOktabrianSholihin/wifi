@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Services /</span> Ubah Paket
            </h4>
            <div class="card">
                <div class="card-body">
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>No Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Paket Lama</th>
                                <th>Paket Baru</th>
                                <th>Tanggal Ubah</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @can('read ubah paket')
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('update ubah paket')
                                                    <button data-bs-toggle="modal" data-bs-target="#ubahpaket"
                                                        class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                        Ubah Paket</button>
                                                    <button data-bs-toggle="modal" data-bs-target="#pembayaran"
                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                        Pembayaran</button>
                                                    <button data-bs-toggle="modal" data-bs-target="#cetaknota"
                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                        Cetak Nota</button>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    <td>123123123</td>
                                    <td>Dudi</td>
                                    <td>10M</td>
                                    <td>4M</td>
                                    <td>1 Oktober 2023 12:20:12</td>
                                </tr>
                            @endcan
                        </tbody>
                    </table>
                    {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal ubah paket ges --}}
    <div class="modal fade" id="ubahpaket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Ubah Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="no pelanggan" name="no pelanggan"
                                    value="" placeholder="no pelanggan" readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="paket" class="form-label">Paket</label>
                            <select id="paket" class="form-select" name="paket" required>
                                <option value="value1">Option 1</option>
                                <option value="value2">Option 2</option>
                                <option value="value3">Option 3</option>
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

    {{-- modal pembayaran ges --}}
    <div class="modal fade" id="pembayaran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="no pelanggan" name="no pelanggan"
                                    value="" placeholder="no pelanggan" readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Biaya</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="biaya" name="biaya" value=""
                                    placeholder="biaya" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Diskon</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="diskon" name="diskon" value=""
                                    placeholder="diskon" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Bayar</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="bayar" name="bayar" value=""
                                    placeholder="bayar" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="lunas" class="form-label">Status Pembayaran</label>
                            <select id="lunas" class="form-select" name="lunas" required>
                                <option value="value1">Lunas</option>
                                <option value="value2">Belum Lunas</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Keterangan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="keterangan" name="keterangan"
                                    value="" placeholder="keterangan" />
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

    {{-- modal cetak nota ges --}}
    <div class="modal fade" id="cetaknota" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Ubah Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name" value=""
                                    placeholder="Name" />
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

@endsection
