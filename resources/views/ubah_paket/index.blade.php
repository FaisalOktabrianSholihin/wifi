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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Services /</span> Ubah Paket
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
                            @if (auth()->user()->hasRole('admin') ||
                                    auth()->user()->hasRole('sales'))
                                <button class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#add-ubahpaket">Tambah</button>
                            @endif
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
                                        @if (auth()->user()->hasRole('admin'))
                                            <th>Tanggal Ubah</th>
                                        @endif
                                        @if (auth()->user()->hasRole('teknisi'))
                                            <th>Status</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @can('read ubah paket')
                                        @foreach ($ubahpaket as $item)
                                            @if (auth()->user()->hasRole('admin'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#visitpelanggan{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Validasi</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-card me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#ubahpaket{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Cetak Nota</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                                                </tr>
                                            @elseif (auth()->user()->hasRole('teknisi'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>
                                                        {{ $item->lunas }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endcan
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
                                        <th>Aksi</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Paket Lama</th>
                                        <th>Paket Baru</th>
                                        @if (auth()->user()->hasRole('admin'))
                                            <th>Tanggal Ubah</th>
                                        @endif
                                        @if (auth()->user()->hasRole('teknisi'))
                                            <th>Status</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @can('read ubah paket')
                                        @foreach ($berhasil as $item)
                                            @if (auth()->user()->hasRole('admin'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#visitpelanggan{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Validasi</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-card me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#ubahpaket{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Cetak Nota</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                                                </tr>
                                            @elseif (auth()->user()->hasRole('teknisi'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>
                                                        {{ $item->lunas }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endcan
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
                                        <th>Aksi</th>
                                        <th>No Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Paket Lama</th>
                                        <th>Paket Baru</th>
                                        @if (auth()->user()->hasRole('admin'))
                                            <th>Tanggal Ubah</th>
                                        @endif
                                        @if (auth()->user()->hasRole('teknisi'))
                                            <th>Status</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @can('read ubah paket')
                                        @foreach ($gagal as $item)
                                            @if (auth()->user()->hasRole('admin'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#visitpelanggan{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Validasi</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-card me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#ubahpaket{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Cetak Nota</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                                                </tr>
                                            @elseif (auth()->user()->hasRole('teknisi'))
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                                data-bs-toggle="dropdown">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                @can('update ubah paket')
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#pembayaran{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Pembayaran</button>
                                                                    <button data-bs-toggle="modal"
                                                                        data-bs-target="#status{{ $item->id }}"
                                                                        class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                        Status</button>
                                                                @endcan
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->no_pelanggan }}</td>
                                                    <td>{{ $item->pelanggan->nama }}</td>
                                                    <td>{{ $item->paket_lama }}</td>
                                                    <td>{{ $item->paket->paket }}</td>
                                                    <td>
                                                        {{ $item->lunas }}
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endcan
                                </tbody>
                            </table>
                            {{-- <div class="col-lg-12 ">{{ $kolektors->links('pagination::bootstrap-5') }}</div> --}}
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
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
                                @if (auth()->user()->hasRole('admin'))
                                    <th>Tanggal Ubah</th>
                                @endif
                                @if (auth()->user()->hasRole('teknisi'))
                                    <th>Status</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @can('read ubah paket')
                                @foreach ($ubahpaket as $item)
                                    @if (auth()->user()->hasRole('admin'))
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @can('update ubah paket')
                                                            <button data-bs-toggle="modal"
                                                                data-bs-target="#ubahpaket{{ $item->id }}"
                                                                class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                Assigment</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->no_pelanggan }}</td>
                                            <td>{{ optional(optional($item->pelanggan)->pluck('nama'))->first() }}</td>
                                            <td>{{ $item->paket_lama }}</td>
                                            <td>{{ $item->paket->paket }}</td>
                                            <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                                        </tr>
                                    @elseif (auth()->user()->hasRole('teknisi') && auth()->user()->name === $item->user_action)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @can('update ubah paket')
                                                            <button data-bs-toggle="modal"
                                                                data-bs-target="#pembayaran{{ $item->id }}"
                                                                class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                Gatau Apa</button>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->no_pelanggan }}</td>
                                            <td>{{ optional(optional($item->pelanggan)->pluck('nama'))->first() }}</td>
                                            <td>{{ $item->paket_lama }}</td>
                                            <td>{{ $item->paket->paket }}</td>
                                            <td>
                                                {{ $item->lunas }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>

    {{-- modal ubah paket ges --}}
    <div class="modal fade" id="add-ubahpaket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Ajukan Ubah Paket</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('route.ubah_pakets.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="no_pelanggan" class="form-label">No Pelanggan</label>
                            <select id="no_pelanggan" class="form-select" name="no_pelanggan" required>
                                <option selected>Pilih Pelanggan</option>
                                @foreach ($data as $item)
                                    <option value="{{ $item->no_pelanggan }}" {{-- {{ $item->no_pelanggan ? 'selected' : '' }} --}}>
                                        {{ $item->no_pelanggan }} - {{ $item->nama }} - {{ $item->paket->paket }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="paket_baru_id" class="form-label">Paket Baru</label>
                            <select id="paket_baru_id" class="form-select" name="paket_baru_id" required>
                                <option selected>Pilih Paket Baru</option>
                                @foreach ($paket as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->paket }}
                                    </option>
                                @endforeach
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

    {{-- modal ubah paket ges --}}
    @foreach ($ubahpaket as $item)
        <div class="modal fade" id="ubahpaket{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.ubah_pakets.update-teknisi', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="no pelanggan" name="no pelanggan"
                                        value="{{ $item->no_pelanggan }}" placeholder="no pelanggan" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="user_action" class="form-label">Pilih Teknisi</label>
                                <select id="user_action" class="form-select" name="user_action" required>
                                    @foreach ($teknisi as $item)
                                        <option value="{{ $item->name }}" {{ $item->name ? 'selected' : '' }}>
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
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal pembayaran ges --}}
    @foreach ($ubahpaket as $item)
        <div class="modal fade" id="pembayaran{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.ubah_pakets.pembayaran', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="no pelanggan" name="no pelanggan"
                                        value="{{ $item->no_pelanggan }}" placeholder="no pelanggan" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Action</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" id="tgl_action" name="tgl_action"
                                        value="" placeholder="" required />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Biaya</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="biaya" name="biaya"
                                        value="{{ $item->paket->iuran + $item->paket->instalasi }}" placeholder="biaya"
                                        readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Diskon</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="diskon" name="diskon"
                                        value="{{ $item->diskon }}" placeholder="diskon" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Bayar</label>
                                <div class="input-group input-group-merge">
                                    <input type="number" class="form-control" id="bayar" name="bayar"
                                        value="" placeholder="" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="lunas" class="form-label">Status Pembayaran</label>
                                <select id="lunas" class="form-select" name="lunas" required>
                                    <option value="Lunas">Lunas</option>
                                    <option value="Belum Lunas">Belum Lunas</option>
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
    @endforeach

    {{-- modal visit ges --}}
    @foreach ($ubahpaket as $item)
        <div class="modal fade" id="visitpelanggan{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Validasi Visit Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.ubah_pakets.visit', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status_visit" class="form-label">Status Visit</label>
                                <select id="status_visit" class="form-select" name="status_visit" required>
                                    <option value="Perlu">Perlu Pemasangan Perangkat</option>
                                    <option value="Tidak Perlu">Tidak Perlu Pemasangan Perangkat</option>
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

    {{-- modal status ges --}}
    @foreach ($ubahpaket as $item)
        <div class="modal fade" id="status{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Status Proses</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.ubah_pakets.proses', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="status_proses" class="form-label">Status Proses</label>
                                <select id="status_proses" class="form-select" name="status_proses" required>
                                    <option value="Berhasil">Berhasil</option>
                                    <option value="Gagal">Gagal</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Keterangan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="keterangan_proses"
                                        name="keterangan_proses" value="" placeholder="" />
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

@section('script')
    <script>
        $(document).ready(function() {
            // Trigger PDF generation after successful payment
            @if (session('message') && session('message') == 'Data berhasil diupdate.')
                var pdfUrl = "{{ route('route.ubah_pakets.pdf', $item->id) }}";
                window.open(pdfUrl, '_blank');
            @endif
        });
    </script>
@endsection
