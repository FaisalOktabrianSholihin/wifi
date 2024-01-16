@extends('layouts.app')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pelanggan
            </h4>
            <div class="card">
                <div class="card-header">
                    @if (auth()->user()->hasRole('admin') ||
                            auth()->user()->hasRole('sales'))
                        <button class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#add-pemutusan">Tambah</button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table id="myTable" class="table mb-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    @role('teknisi')
                                        <th>Aksi</th>
                                    @endrole
                                    <th>No. Pelanggan</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    @if (auth()->user()->hasRole('admin') ||
                                            auth()->user()->hasRole('sales'))
                                        <th>User Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($pemutusan as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        @role('teknisi')
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#pembayaran{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                            Pembayaran</button>
                                                    </div>
                                                </div>
                                            </td>
                                        @endrole
                                        <td>{{ $item->no_pelanggan }}</td>
                                        <td>{{ $item->pelanggan->nama }}</td>
                                        <td>{{ $item->pelanggan->alamat }}</td>
                                        <td>{{ $item->pelanggan->telepon }}</td>
                                        @if (auth()->user()->hasRole('admin') ||
                                                auth()->user()->hasRole('sales'))
                                            <td>{{ $item->user_action }}</td>
                                        @endif
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
    <div class="modal fade" id="add-pemutusan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Data Pemutusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.pemutusans.store') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <label for="pelanggan_id" class="form-label">Cari Pelanggan</label>
                        <div class="row">
                            <div class="mb-3">
                                <select id="pelanggan_id" class="form-select" style="width: 100%" name="no_pelanggan"
                                    required>
                                    <option selected>Pilih Pelanggan</option>
                                    @foreach ($pelanggan as $item)
                                        <option value="{{ $item->no_pelanggan }}">
                                            {{ $item->no_pelanggan }} |
                                            {{ $item->nama }} |
                                            {{ $item->paket->paket }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="user_action" class="form-label">Teknisi</label>
                            <select id="user_action" class="form-select" name="user_action" required>
                                <option selected>Pilih Teknisi</option>
                                @foreach ($teknisi as $item)
                                    <option value="{{ $item->name }}">
                                        {{ $item->name }}
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

    {{-- pembayaran --}}
    @foreach ($pemutusan as $value)
        <div class="modal fade" id="pembayaran{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemutusans.pembayaran', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">No Pelanggan</label>
                                    <input type="text" class="form-control" value="{{ $value->no_pelanggan }}"
                                        readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_action" class="form-label">Tanggal Pemutusan</label>
                                    <input class="form-control" type="date" name="tgl_action" id="tgl_action"
                                        value="{{ $value->tgl_action }}" required />
                                </div>
                            </div>
                            <div class="row
                                        g-2">
                                <div class="col mb-3">
                                    <label for="biaya" class="form-label">Biaya</label>
                                    <input type="text" id="biaya" name="biaya" class="form-control"
                                        value="{{ $value->biaya }}" required />
                                </div>
                                <div class="col mb-3">
                                    <label for="bayar" class="form-label">Bayar</label>
                                    <input type="text" id="bayar" name="bayar" class="form-control"
                                        value="{{ $value->bayar }}" required />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="diskon" class="form-label">Diskon</label>
                                    <input type="text" id="diskon" name="diskon" class="form-control"
                                        value="{{ $value->diskon }}" required />
                                </div>
                                <div class="col mb-3">
                                    <label for="keterangan" class="form-label">Keterangan Diskon</label>
                                    <input type="text" id="keterangan" name="keterangan" class="form-control"
                                        value="{{ $value->keterangan }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="status_lunas">Status Lunas</label>
                                    <select class="form-select" id="status_lunas" name="lunas" required>
                                        <option value="" selected>Pilih Status Lunas</option>
                                        <option value="Lunas" {{ $value->lunas === 'Lunas' ? 'selected' : '' }}>
                                            Lunas
                                        </option>
                                        <option value="Belum Lunas"
                                            {{ $value->lunas === 'Belum Lunas' ? 'selected' : '' }}>Belum
                                            Lunas
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            @if ($value->lunas === 'Lunas')
                                <button type="submit" disabled class="btn btn-primary">Simpan</button>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#pelanggan_id').select2({
                placeholder: 'Cari Pelanggan',
                dropdownParent: $('#add-pemutusan')
            });
        });
    </script>
@endpush
