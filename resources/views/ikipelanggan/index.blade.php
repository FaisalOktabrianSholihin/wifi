@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> Pelanggan
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
                                <th>Alamat</th>
                                <th>Telepon</th>

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
                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                        Ubah Paket</button>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    <td>123123123</td>
                                    <td>Fawaid</td>
                                    <td>Paiton</td>
                                    <td>0</td>

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
                    <h5 class="modal-title" id="exampleModalLabel1">Ajukan Ubah Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="">
                    {{-- @csrf
                        @method('PUT') --}}
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="no_pelanggan" name="no_pelanggan"
                                    value="" placeholder="123123123" readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Paket Lama</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="no_pelanggan" name="no_pelanggan"
                                    value="" placeholder="4M" readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="paket" class="form-label">Pilih Paket Baru</label>
                            <select id="paket" class="form-select" name="paket" required>
                                <option value="value1">4M</option>
                                <option value="value2">5M</option>
                                <option value="value3">10M</option>
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

@endsection
