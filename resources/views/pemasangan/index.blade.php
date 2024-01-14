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
                                <button class="btn btn-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#add-pemasangan">Tambah</button>
                            @endif
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table id="myTable" class="table mb-4">
                                <thead>
                                    @if (auth()->user()->hasRole('teknisi'))
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>No. Pendaftaran</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    @endif
                                    @if (auth()->user()->hasRole('admin') ||
                                            auth()->user()->hasRole('sales'))
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>No. Pendaftaran</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Telepon</th>
                                            <th>Paket</th>
                                            @if (auth()->user()->hasRole('admin'))
                                                <th>Nama Sales</th>
                                            @endif
                                            @if (auth()->user()->hasRole('sales'))
                                                <th>Nama Teknisi</th>
                                            @endif
                                            <th>Status</th>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pemasangan as $item)
                                        @if (auth()->user()->hasRole('admin') ||
                                                auth()->user()->hasRole('sales'))
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @if (auth()->user()->hasRole('admin'))
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#show{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                                    Info</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#update{{ $item->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit-alt me-1"></i>
                                                                    Edit</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#assignment{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Assignment</button>
                                                            @endif
                                                            @if (auth()->user()->hasRole('sales'))
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#show{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-id-card me-1"></i>
                                                                    Info</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#update-survey{{ $item->id }}"
                                                                    class="dropdown-item"><i
                                                                        class="bx bx-edit-alt me-1"></i>
                                                                    Status Survey</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#assignment-teknisi{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Assignment</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ $item->toPaket->paket }}</td>
                                                @if (auth()->user()->hasRole('admin'))
                                                    <td>{{ $item->user_survey }}</td>
                                                @else
                                                    <td>{{ $item->user_action }}</td>
                                                @endif
                                                <td>
                                                    @if ($item->status_survey === 'Belum Survey')
                                                        <span class="badge bg-secondary">{{ $item->status_survey }}</span>
                                                    @elseif ($item->status_survey === 'Gagal Survey')
                                                        <span class="badge bg-danger">{{ $item->status_survey }}</span>
                                                    @elseif ($item->status_survey === 'Berhasil Survey')
                                                        <span class="badge bg-success">{{ $item->status_survey }}</span>
                                                    @else
                                                        <span class="badge bg-dark">{{ $item->status_survey }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                        @if (auth()->user()->hasRole('teknisi'))
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
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
                                                                Info</button>
                                                            <button data-bs-toggle="modal"
                                                                data-bs-target="#update-instalasi{{ $item->id }}"
                                                                class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                                Instalasi</button>
                                                            <button data-bs-toggle="modal"
                                                                data-bs-target="#update-aktivasi{{ $item->id }}"
                                                                class="dropdown-item"><i class="bx bx-slider-alt me-1"></i>
                                                                Aktivasi</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>
                                                    @if ($item->status_aktivasi == 'Berhasil Aktivasi' && $item->status_lunas == 'Belum Lunas')
                                                        <button type="button" class="btn btn-sm btn-primary">
                                                            <span class="tf-icons bx bxs-credit-card"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#pembayaran{{ $item->id }}"></span>
                                                        </button>
                                                    @else
                                                        <button type="button" class="btn btn-sm btn-primary" disabled>
                                                            <span class="tf-icons bx bxs-credit-card"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#pembayaran{{ $item->id }}"></span>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- tab berhasil --}}
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($berhasil as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_pendaftaran }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>
                                                <span class="badge bg-success">{{ $item->status_lunas }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- tab gagal --}}
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="card-body mb-4">
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($gagal as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_pendaftaran }}</td>
                                            <td>{{ $item->nik }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>
                                                @if ($item->status_survey === 'Gagal Survey')
                                                    <span class="badge bg-danger">{{ $item->status_survey }}</span>
                                                @elseif ($item->status_instalasi === 'Gagal Instalasi')
                                                    <span class="badge bg-danger">{{ $item->status_instalasi }}</span>
                                                @elseif ($item->status_aktivasi === 'Gagal Aktivasi')
                                                    <span class="badge bg-danger">{{ $item->status_aktivasi }}</span>
                                                @else
                                                    <span class="badge bg-dark">Terdapat kesalahan</span>
                                                @endif
                                            </td>
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

    {{-- modal add pemasangan --}}
    <div class="modal fade" id="add-pemasangan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('route.pemasangans.create') }}">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nik" class="form-label">Nomer Induk Kependudukan</label>
                            <input class="form-control" type="number" maxlength="16" id="nik" name="nik"
                                required />
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="nama" name="nama" required />
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" type="text" id="alamat" name="alamat" required />
                        </div>

                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input class="form-control" type="number" id="telepon" name="telepon" required />
                        </div>

                        <div class="mb-3">
                            <label for="paket_id" class="form-label">Pilih Paket</label>
                            <select id="paket_id" class="form-select" name="paket_id" required>
                                <option value="" selected>Pilih Paket</option>
                                @foreach ($pakets as $item)
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
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- update data pemasangan --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="update{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data Pemasangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.update', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        placeholder="Masukan Nama" value="{{ $value->nama }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Nomer Induk
                                        Kependudukan</label>
                                    <input type="text" id="nik" name="nik" class="form-control"
                                        placeholder="Masukan NIK" value="{{ $value->nik }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control"
                                        placeholder="Masukan alamat" value="{{ $value->alamat }}" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Telepon</label>
                                    <input type="text" id="telepon" name="telepon" class="form-control"
                                        placeholder="Masukan telepon" value="{{ $value->telepon }}" required />
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="paket_id" class="form-label">Pilih Paket</label>
                                <select id="paket_id" class="form-select" name="paket_id" required>
                                    @foreach ($pakets as $item)
                                        <option value="{{ $item->id }}" {{ $item->paket ? 'selected' : '' }}>
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- assignment sales --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="assignment{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Assignment Sales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.assignment-sales', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="user_survey" class="form-label">Pilih Sales</label>
                                <select id="user_survey" class="form-select" name="user_survey" required>
                                    <option value="" selected>Pilih Sales</option>
                                    @foreach ($sales as $item)
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
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- assignment teknisi --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="assignment-teknisi{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Assignment Teknisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.assignment-teknisi', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="user_action" class="form-label">Pilih Teknisi</label>
                                <select id="user_action" class="form-select" name="user_action" required>
                                    <option value="" selected>Pilih Teknisi</option>
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
                            @if (is_null($value->user_action))
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

    {{-- update survey --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="update-survey{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Survey</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.update-survey', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="status_survey">Status Survey</label>
                                <select class="form-select" id="status_survey" name="status_survey">
                                    <option value="Belum Survey"
                                        {{ $value->status_survey === 'Belum Survey' ? 'selected' : '' }}>Belum
                                        Survey
                                    </option>
                                    <option value="Berhasil Survey"
                                        {{ $value->status_survey === 'Berhasil Survey' ? 'selected' : '' }}>
                                        Berhasil Survey
                                    </option>
                                    <option value="Gagal Survey"
                                        {{ $value->status_survey === 'Gagal Survey' ? 'selected' : '' }}>Gagal
                                        Survey
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_action" class="form-label">Tanggal Survey</label>
                                <input class="form-control" type="date" name="tgl_action" id="tgl_action"
                                    value="{{ $value->tgl_action }}" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Keterangan Hasil
                                    Survey</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" id="keterangan_survey" name="keterangan"
                                        value="{{ $value->keterangan }}" placeholder="Keterangan" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            @if ($value->status_survey == 'Belum Survey')
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


    {{-- show --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="show{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Detail Pelanggan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">No Pendaftaran</label>
                                    <input type="text" class="form-control" value="{{ $value->no_pendaftaran }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Nama</label>
                                    <input type="text" value="{{ $value->nama }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" value="{{ $value->alamat }}" readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Telepon</label>
                                    <input type="text" value="{{ $value->telepon }}" class="form-control" readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">NIK</label>
                                    <input type="text" class="form-control" value="{{ $value->nik }}" readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Jenis Paket</label>
                                    <input type="text" class="form-control" value="{{ $value->toPaket->paket }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">User Survey</label>
                                    <input type="text" class="form-control" value="{{ $value->user_survey }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Status Survey</label>
                                    <input type="text" class="form-control" value="{{ $value->status_survey }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Tanggal Survey</label>
                                    <input type="text" class="form-control" value="{{ $value->tgl_action }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Keterangan Survey</label>
                                    <input type="text" class="form-control" value="{{ $value->keterangan }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">User Action</label>
                                    <input type="text" class="form-control" value="{{ $value->user_action }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Status Instalasi</label>
                                    <input type="text" class="form-control" value="{{ $value->status_instalasi }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Status Aktivasi</label>
                                    <input type="text" class="form-control" value="{{ $value->status_aktivasi }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Biaya</label>
                                    <input type="text" class="form-control" value="{{ $value->biaya }}" readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Diskon</label>
                                    <input type="text" class="form-control" value="{{ $value->diskon }}" readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Keterangan Diskon</label>
                                    <input type="text" class="form-control" value="{{ $value->keterangan_diskon }}"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Bayar</label>
                                    <input type="text" class="form-control" value="{{ $value->bayar }}" readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Status Lunas</label>
                                    <input type="text" class="form-control" value="{{ $value->status_lunas }}"
                                        readonly />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- status instalasi --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="update-instalasi{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Status Instalasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.update-instalasi', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="status_instalasi">Status Survey</label>
                                <select class="form-select" id="status_instalasi" name="status_instalasi">
                                    <option value="" selected>Pilih Status Instalasi</option>
                                    <option value="Berhasil Instalasi"
                                        {{ $value->status_instalasi === 'Berhasil Instalasi' ? 'selected' : '' }}>
                                        Berhasil Instalasi
                                    </option>
                                    <option value="Gagal Instalasi"
                                        {{ $value->status_instalasi === 'Gagal Instalasi' ? 'selected' : '' }}>Gagal
                                        Instalasi
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            @if ($value->status_instalasi == 'Belum Instalasi')
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

    {{-- status aktivasi --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="update-aktivasi{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Status Aktivasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.update-aktivasi', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="status_aktivasi">Status Survey</label>
                                <select class="form-select" id="status_aktivasi" name="status_aktivasi">
                                    <option value="" selected>Pilih Status Aktivasi</option>
                                    <option value="Berhasil Aktivasi"
                                        {{ $value->status_aktivasi === 'Berhasil Aktivasi' ? 'selected' : '' }}>
                                        Berhasil aktivasi
                                    </option>
                                    <option value="Gagal Aktivasi"
                                        {{ $value->status_aktivasi === 'Gagal Aktivasi' ? 'selected' : '' }}>Gagal
                                        Aktivasi
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            @if ($value->status_instalasi == 'Belum Instalasi' || $value->status_aktivasi != 'Belum Aktivasi')
                                <button type="submit" class="btn btn-primary" disabled>Simpan</button>
                            @else
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- pembayaran --}}
    @foreach ($pemasangan as $value)
        <div class="modal fade" id="pembayaran{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.pembayaran', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">No Pendaftaran</label>
                                    <input type="text" class="form-control" value="{{ $value->no_pendaftaran }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Jenis Paket</label>
                                    <input type="text" value="{{ $value->toPaket->paket }}" class="form-control"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="nama" class="form-label">Iuran</label>
                                    <input type="text" class="form-control" value="{{ $value->toPaket->iuran }}"
                                        readonly />
                                </div>
                                <div class="col mb-3">
                                    <label for="role" class="form-label">Instalasi</label>
                                    <input type="text" value="{{ $value->toPaket->instalasi }}" class="form-control"
                                        readonly />
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-3">
                                    <label for="biaya" class="form-label">Biaya</label>
                                    <input type="text" id="biaya" name="biaya" class="form-control"
                                        value="{{ $value->toPaket->iuran + $value->toPaket->instalasi }}" readonly />
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
                                    <input type="text" id="keterangan" name="keterangan_diskon" class="form-control"
                                        value="{{ $value->keterangan_diskon }}" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="status_lunas">Status Lunas</label>
                                    <select class="form-select" id="status_lunas" name="status_lunas" required>
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
