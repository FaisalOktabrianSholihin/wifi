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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pemasangan
            </h4>
            {{-- <div class="card"> --}}
            {{-- <div class="card-body">
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
                                <th>Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($customers as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
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
                                                <button data-bs-toggle="modal"
                                                    data-bs-target="#instalasi{{ $item->id }}" class="dropdown-item"><i
                                                        class="bx bx-slider-alt me-1"></i>
                                                    Instalasi</button>
                                                <button data-bs-toggle="modal" data-bs-target="#aktivasi{{ $item->id }}"
                                                    class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                    Aktivasi</button>
                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#delete"><i class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->pelanggan->no_pelanggan }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    @if (auth()->user()->hasRole('teknisi'))
                                        <td> <button type="button" class="btn btn-primary">
                                                <span class="tf-icons bx bxs-credit-card" data-bs-toggle="modal"
                                                    data-bs-target="#pembayaran{{ $item->id }}"></span>
                                            </button>
                                            <button type="button" class="btn btn-warning"
                                                id="btnCetakPdf{{ $item->id }}">
                                                <span class="tf-icons bx bxs-printer" data-bs-toggle="modal"></span>
                                            </button>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> --}}
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
                                        <th>Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($customers as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#show{{ $item->id }}"
                                                            class="dropdown-item"><i
                                                                class="bx bx-id-card me-1"></i>Show</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#instalasi{{ $item->id }}"
                                                            class="dropdown-item"><i
                                                                class="bx bx-slider-alt me-1"></i>Instalasi</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#aktivasi{{ $item->id }}"
                                                            class="dropdown-item"><i
                                                                class="bx bx-slider-alt me-1"></i>Aktivasi</button>
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#delete"><i
                                                                class="bx bx-trash me-1"></i>Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ optional($item->pelanggan)->no_pelanggan }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            @if (auth()->user()->hasRole('teknisi'))
                                                <td>
                                                    <button type="button" class="btn btn-primary">
                                                        <span class="tf-icons bx bxs-credit-card" data-bs-toggle="modal"
                                                            data-bs-target="#pembayaran{{ $item->id }}"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning"
                                                        id="btnCetakPdf{{ $item->id }}">
                                                        <span class="tf-icons bx bxs-printer" data-bs-toggle="modal"></span>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                        <th>No. Pelanggan</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($berhasil as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#show{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                            Show</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#instalasi{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                            Instalasi</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#aktivasi{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                            Aktivasi</button>
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#delete"><i class="bx bx-trash me-1"></i>
                                                            Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->pelanggan->no_pelanggan }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            @if (auth()->user()->hasRole('teknisi'))
                                                <td> <button type="button" class="btn btn-primary">
                                                        <span class="tf-icons bx bxs-credit-card" data-bs-toggle="modal"
                                                            data-bs-target="#pembayaran{{ $item->id }}"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning"
                                                        id="btnCetakPdf{{ $item->id }}">
                                                        <span class="tf-icons bx bxs-printer"
                                                            data-bs-toggle="modal"></span>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
                                        <th>No. Pelanggan</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($gagal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#show{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                            Show</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#instalasi{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                            Instalasi</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#aktivasi{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                            Aktivasi</button>
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#delete"><i class="bx bx-trash me-1"></i>
                                                            Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->pelanggan->no_pelanggan }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            @if (auth()->user()->hasRole('teknisi'))
                                                <td> <button type="button" class="btn btn-primary">
                                                        <span class="tf-icons bx bxs-credit-card" data-bs-toggle="modal"
                                                            data-bs-target="#pembayaran{{ $item->id }}"></span>
                                                    </button>
                                                    <button type="button" class="btn btn-warning"
                                                        id="btnCetakPdf{{ $item->id }}">
                                                        <span class="tf-icons bx bxs-printer"
                                                            data-bs-toggle="modal"></span>
                                                    </button>
                                                </td>
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
                    <form>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="no_pelanggan" name="no_pelanggan"
                                        value="{{ optional($item->pelanggan)->no_pelanggan }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ $item->nama }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="{{ $item->alamat }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="telepon" name="telepon"
                                        value="{{ $item->telepon }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Username Pppoe</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ optional($item->pelanggan)->username_pppoe }}" placeholder="Username"
                                        readonly />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="basic-icon-default-fullname">Password Pppoe</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="name" name="name"
                                        value="{{ optional($item->pelanggan)->password_pppoe }}" placeholder="Kata Sandi"
                                        readonly /><span class="input-group-text cursor-pointer"><i
                                            class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Pemasangan</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" id="name" name="name"
                                        value="{{ optional($item->pelanggan)->tgl_pasang }}" placeholder="Name"
                                        readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Tanggal Isolir</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" class="form-control" id="name" name="name"
                                        value="{{ optional($item->pelanggan)->tgl_isolir }}" placeholder="Name"
                                        readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Status
                                    Instalasi</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->status_instalasi }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Status
                                    Aktivasi</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->status_aktivasi }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Biaya</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="biaya" name="biaya"
                                        value="{{ $item->biaya }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Bayar</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->bayar }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Diskon</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->diskon }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Status Lunas</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $item->status_lunas }}" readonly />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- modal aktivasi ges --}}
    @foreach ($customers as $item)
        <div class="modal fade" id="aktivasi{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Aktivasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pelanggans.update-aktivasi', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="status_aktivasi">Status Aktivasi</label>
                                <select class="form-select" id="status_aktivasi" name="status_aktivasi">
                                    <option disabled selected> {{ $item->status_aktivasi }}
                                    </option>
                                    <option value="Berhasil Aktivasi">
                                        Berhasil Aktivasi
                                    </option>
                                    <option value="Gagal Aktivasi">Gagal Aktivasi
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
    @endforeach

    {{-- modal instalasi ges --}}
    @foreach ($customers as $item)
        <div class="modal fade" id="instalasi{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Instalasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pelanggans.update-instalasi', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="status_instalasi">Status Instalasi</label>
                                <select class="form-select" id="status_instalasi" name="status_instalasi">
                                    <option disabled selected> {{ $item->status_instalasi }}
                                    </option>
                                    <option value="Berhasil Instalasi">
                                        Berhasil Instalasi
                                    </option>
                                    <option value="Gagal Instalasi">Gagal Instalasi
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
    @endforeach

    {{-- modal pembayaran ges --}}
    @foreach ($customers as $item)
        <div class="modal fade" id="pembayaran{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pelanggans.update-pembayaran', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">No Pelanggan</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ optional($item->pelanggan)->no_pelanggan }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="paket">Paket</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="paket" name="paket"
                                        value="{{ $item->toPaket->paket }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="iuran">Iuran</label>
                                <div class="input-group input-group-merge">
                                    <?php
                                    $iuranFormatted = number_format($item->toPaket->iuran, 0, ',', '.');
                                    ?>
                                    <input type="text" class="form-control" id="iuran" name="iuran"
                                        value="{{ $item->toPaket->iuran }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="instalasi">Instalasi</label>
                                <?php
                                $instalasiFormatted = number_format($item->toPaket->instalasi, 0, ',', '.');
                                ?>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="instalasi" name="instalasi"
                                        value="{{ $item->toPaket->instalasi }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="biaya">Biaya</label>
                                <div class="input-group input-group-merge">
                                    <?php
                                    $biayaFormatted = number_format($item->toPaket->iuran + $item->toPaket->instalasi, 0, ',', '.');
                                    ?>
                                    <input type="number" class="form-control" id="biaya" name="biaya"
                                        value="{{ $item->toPaket->iuran + $item->toPaket->instalasi }}" readonly />
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="bayar">Bayar</label>
                                <div class="input-group input-group-merge">
                                    <?php
                                    $bayarFormatted = number_format($item->bayar, 0, ',', '.');
                                    ?>
                                    <input type="number" class="form-control" id="bayar" name="bayar"
                                        value="{{ $item->bayar }}" /><span
                                        class="input-group-text cursor-pointer"><i></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="diskon">Diskon</label>
                                <div class="input-group input-group-merge">
                                    <input type="number" class="form-control" id="diskon" name="diskon"
                                        value="{{ $item->diskon }}" /><span
                                        class="input-group-text cursor-pointer"><i></i></span>
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="diskon">Keterangan Diskon</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="keterangan_diskon"
                                        name="keterangan_diskon" value="" required /><span
                                        class="input-group-text cursor-pointer"><i></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status_lunas">Status Lunas</label>
                                <select class="form-select" id="status_lunas" name="status_lunas">
                                    <option value="Belum Lunas"
                                        {{ $item->status_lunas == 'Belum Lunas' ? 'selected' : '' }}>
                                        Belum Lunas
                                    </option>
                                    <option value="Lunas" {{ $item->status_lunas == 'Lunas' ? 'selected' : '' }}>
                                        Lunas
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
    @endforeach

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

@section('scripts')
    <script>
        // Fungsi untuk menutup modal
        function closePembayaranModals() {
            $('[id^=pembayaran]').modal('hide');
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen-elemen input
            var iuranInput = document.getElementById("iuran");
            var instalasiInput = document.getElementById("instalasi");
            var biayaInput = document.getElementById("biaya");

            // Fungsi untuk menghitung dan mengatur nilai "biaya" saat terjadi perubahan pada "iuran" atau "instalasi"
            function hitungBiaya() {
                var iuranValue = parseFloat(iuranInput.value) || 0; // Konversi ke angka, default 0 jika tidak valid
                var instalasiValue = parseFloat(instalasiInput.value) ||
                    0; // Konversi ke angka, default 0 jika tidak valid
                var biayaValue = iuranValue + instalasiValue;
                biayaInput.value = biayaValue;
            }

            // Panggil fungsi hitungBiaya saat halaman dimuat
            hitungBiaya();

            // Tambahkan event listener untuk perubahan pada "iuran" atau "instalasi"
            iuranInput.addEventListener("input", hitungBiaya);
            instalasiInput.addEventListener("input", hitungBiaya);
        });
    </script>
    <script>
        @foreach ($customers as $item)
            $('#btnCetakPdf{{ $item->id }}').click(function() {
                var id = {{ $item->id }};
                var pdfUrl = "{{ route('route.pelanggans.pdf', ':id') }}".replace(':id', id);
                window.open(pdfUrl, '_blank');
            });
        @endforeach
    </script>
@endsection
