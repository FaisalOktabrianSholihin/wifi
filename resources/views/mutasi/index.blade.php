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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Services /</span> Mutasi
            </h4>
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                        <a href="{{ route('route.mutasis.index') }}" class="nav-link active" role="tab"
                            aria-selected="true" style="color: white">
                            Proses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('route.mutasis-berhasil') }}" class="nav-link" role="tab"
                            aria-selected="false" style="color: white">
                            Berhasil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('route.mutasis-gagal') }}" class="nav-link" role="tab" aria-selected="false"
                            style="color: white">
                            Gagal
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
                        @if (auth()->user()->hasRole('admin') ||
                                auth()->user()->hasRole('sales'))
                            <div class="card-body mb-4">
                                <button class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#add-mutasi">Tambah</button>
                            </div>
                        @endif
                        <div class="table-responsive text-nowrap">
                            <table id="myTable" class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        @if (auth()->user()->hasRole('admin') ||
                                                auth()->user()->hasRole('teknisi'))
                                            <th>Aksi</th>
                                        @endif
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        @role('admin')
                                            <th>User action</th>
                                        @endrole
                                        <th>Jenis Mutasi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($mutasi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            @if (auth()->user()->hasRole('admin') ||
                                                    auth()->user()->hasRole('teknisi'))
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @role('admin')
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#assigment{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Assigment</button>
                                                            @endrole
                                                            @role('teknisi')
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#status{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Status Mutasi</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#pembayaran{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Pembayaran</button>
                                                            @endrole
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif
                                            <td>{{ $item->no_pelanggan }}</td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            @role('admin')
                                                <td>{{ $item->user_action }}</td>
                                            @endrole
                                            <td>{{ $item->jenis_mutasi }}</td>
                                            <td>
                                                @if ($item->status_mutasi === 'Belum Diproses')
                                                    <span class="badge bg-secondary">{{ $item->status_mutasi }}</span>
                                                @elseif ($item->status_mutasi === 'Gagal Mutasi')
                                                    <span class="badge bg-danger">{{ $item->status_mutasi }}</span>
                                                @elseif ($item->status_mutasi === 'Berhasil Mutasi')
                                                    <span class="badge bg-success">{{ $item->status_mutasi }}</span>
                                                @else
                                                    <span class="badge bg-dark">{{ $item->status_mutasi }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- tab berhasil --}}
                    {{-- <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="tableBerhasil" class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Alamat Baru</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($berhasil as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pelanggan->no_pelanggan }}</td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            <td>{{ $item->jenis_mutasi }}</td>
                                            <td>{{ $item->alamat_baru }}</td>
                                            <td><span class="badge bg-success">{{ $item->status_mutasi }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    {{-- tab gagal --}}
                    {{-- <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="tableGagal" class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Jenis Mutasi</th>
                                        <th>Alamat Baru</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($gagal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pelanggan->no_pelanggan }}</td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            <td>{{ $item->jenis_mutasi }}</td>
                                            <td>{{ $item->alamat_baru }}</td>
                                            <td><span class="badge bg-danger">{{ $item->status_mutasi }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah ges --}}
    {{-- <div class="modal fade" id="add-mutasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-mutasi">Tambahkan Data Mutasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.mutasis.store') }}">
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
                                <input type="text" class="form-control" id="alamat" name="alamat_baru"
                                    value="" placeholder="alamat" />
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
    </div> --}}

    {{-- Modal tambah ges --}}
    <div class="modal fade" id="add-mutasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="add-mutasi-title">Tambahkan Data Mutasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.mutasis.store') }}">
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
                            <label for="jenis_mutasi" class="form-label">Jenis Mutasi</label>
                            <select id="jenis_mutasi" class="form-select" name="jenis_mutasi" required
                                onchange="toggleAlamat(this)">
                                <option selected>Pilih Jenis Mutasi</option>
                                <option value="titik">Titik</option>
                                <option value="alamat">Alamat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="alamat">Alamat Baru</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="alamat" name="alamat_baru"
                                    value="" placeholder="alamat" disabled />
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

    {{-- modal teknisi ges --}}
    @foreach ($mutasi as $item)
        <div class="modal fade" id="assigment{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Assigment Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('route.mutasis.assignment-teknisi', $item->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
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
                            @if (is_null($item->user_action))
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @else
                                <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal status proses  --}}
    @foreach ($mutasi as $item)
        <div class="modal fade" id="status{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Status Proses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.mutasis.status-mutasi', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status_mutasi" class="form-label">Status Proses</label>
                                <select id="status_mutasi" class="form-select" name="status_mutasi" required>
                                    <option selected>Pilih Status Mutasi</option>
                                    <option value="Berhasil Mutasi"
                                        {{ $item->status_mutasi === 'Berhasil Mutasi' ? 'selected' : '' }}>Berhasil
                                    </option>
                                    <option value="Gagal Mutasi"
                                        {{ $item->status_mutasi === 'Gagal Mutasi' ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_action" class="form-label">Tanggal Mutasi</label>
                                <input class="form-control" type="date" name="tgl_action" id="tgl_action"
                                    value="{{ $item->tgl_action }}" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            @if ($item->status_mutasi == 'Belum Diproses')
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @else
                                <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- pembayaran --}}
    @foreach ($mutasi as $value)
        <div class="modal fade" id="pembayaran{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.mutasis.pembayaran', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">No Pelanggan</label>
                                    <input type="text" class="form-control" value="{{ $value->no_pelanggan }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Jenis Mutasi</label>
                                    <input type="text" value="{{ $value->jenis_mutasi }}" class="form-control"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Alamat Baru</label>
                                    <input type="text" class="form-control" value="{{ $value->alamat_baru }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Tanggal Mutasi</label>
                                    <input type="text" value="{{ $value->tgl_action }}" class="form-control"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
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
                                        <option value="Lunas" {{ $value->status_lunas === 'Lunas' ? 'selected' : '' }}>
                                            Lunas
                                        </option>
                                        <option value="Belum Lunas"
                                            {{ $value->status_lunas === 'Belum lunas' ? 'selected' : '' }}>Belum
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
                dropdownParent: $('#add-mutasi')
            });
            $('#tableBerhasil').DataTable();
            $('#tableGagal').DataTable();
        });

        function toggleAlamat(select) {
            var alamatInput = document.getElementById("alamat");
            if (select.value === "titik") {
                alamatInput.disabled = true;
                alamatInput.value = "";
            } else {
                alamatInput.disabled = false;
            }
        }
    </script>
@endpush
