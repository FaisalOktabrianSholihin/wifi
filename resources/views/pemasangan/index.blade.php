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
            {{-- <div class="card">
                <div class="card-body">
                    @can('create pendaftaran')
                        <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#add-pemasangan">Tambah</button>
                    @endcan
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>No. Pendaftaran</th>
                                <th>NIK</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Paket</th>
                                <th>Nama Sales</th>
                                @if (auth()->user()->hasRole('sales'))
                                    <th>Nama Teknisi</th>
                                @endif
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pemasangan as $item)
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
                                                    @can('create pendaftaran')
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#update{{ $item->id }}" class="dropdown-item"><i
                                                                class="bx bx-share"></i>
                                                            Assignment</button>
                                                    @endcan
                                                    @can('create pendaftaran')
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#delete{{ $item->id }}"><i
                                                                class="bx bx-trash me-1"></i>
                                                            Delete</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->no_pendaftaran }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ $item->toPaket->paket }}</td>
                                        <td>{{ $item->user_survey }}</td>
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
                                @elseif(auth()->user()->hasRole('sales') && auth()->user()->name === $item->user_survey)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('create pendaftaran')
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#update{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                            Detail</button>
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#updateAssignment{{ $item->id }}"
                                                            class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                            Assignment</button>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->no_pendaftaran }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
                                        <td>{{ optional($item->toPaket)->paket }}</td>
                                        <td>{{ $item->user_survey }}</td>
                                        @if (auth()->user()->hasRole('sales'))
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
                            @can('create pendaftaran')
                                <button class="btn btn-outline-primary float-end" data-bs-toggle="modal"
                                    data-bs-target="#add-pemasangan">Tambah</button>
                            @endcan
                        </div>
                        <div class="table-responsive text-nowrap">
                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Aksi</th>
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Paket</th>
                                        <th>Nama Sales</th>
                                        @if (auth()->user()->hasRole('sales'))
                                            <th>Nama Teknisi</th>
                                        @endif
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pemasangan as $item)
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
                                                            @can('create pendaftaran')
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#update{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share"></i>
                                                                    Assignment</button>
                                                            @endcan
                                                            @can('create pendaftaran')
                                                                <button class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#delete{{ $item->id }}"><i
                                                                        class="bx bx-trash me-1"></i>
                                                                    Delete</button>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ $item->toPaket->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
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
                                        @elseif(auth()->user()->hasRole('sales') && auth()->user()->name === $item->user_survey)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            @can('create pendaftaran')
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#update{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                                    Detail</button>
                                                                <button data-bs-toggle="modal"
                                                                    data-bs-target="#updateAssignment{{ $item->id }}"
                                                                    class="dropdown-item"><i class="bx bx-share me-1"></i>
                                                                    Assignment</button>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ optional($item->toPaket)->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
                                                @if (auth()->user()->hasRole('sales'))
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
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Paket</th>
                                        <th>Nama Sales</th>
                                        @if (auth()->user()->hasRole('sales'))
                                            <th>Nama Teknisi</th>
                                        @endif
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pemasangan as $item)
                                        @if (auth()->user()->hasRole('admin'))
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ $item->toPaket->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
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
                                        @elseif(auth()->user()->hasRole('sales') && auth()->user()->name === $item->user_survey)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ optional($item->toPaket)->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
                                                @if (auth()->user()->hasRole('sales'))
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
                                        <th>No. Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                        <th>Paket</th>
                                        <th>Nama Sales</th>
                                        @if (auth()->user()->hasRole('sales'))
                                            <th>Nama Teknisi</th>
                                        @endif
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($pemasangan as $item)
                                        @if (auth()->user()->hasRole('admin'))
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ $item->toPaket->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
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
                                        @elseif(auth()->user()->hasRole('sales') && auth()->user()->name === $item->user_survey)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->no_pendaftaran }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->alamat }}</td>
                                                <td>{{ $item->telepon }}</td>
                                                <td>{{ optional($item->toPaket)->paket }}</td>
                                                <td>{{ $item->user_survey }}</td>
                                                @if (auth()->user()->hasRole('sales'))
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-pemasangan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data Pemasangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('route.pemasangans.store') }}">
                    @csrf
                    <div class="modal-body">
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pendaftaran</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran"
                                    value="" placeholder="No. Pendafataran" required />
                            </div>
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label for="no_pendaftaran" class="form-label">No Pendaftaran</label>
                            <input class="form-control" type="text" id="no_pendaftaran" name="no_pendaftaran"
                                readonly />
                        </div> --}}
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nomer Induk Kependudukan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="nik" name="nik" value=""
                                    placeholder="Nomer Induk Kependudukan" required />
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input class="form-control" type="text" id="nik" name="nik" required />
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="nama" name="nama" value=""
                                    placeholder="Nama" required />
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input class="form-control" type="text" id="nama" name="nama" required />
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="alamat" name="alamat" value=""
                                    placeholder="Alamat" required />
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input class="form-control" type="text" id="alamat" name="alamat" required />
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="telepon" name="telepon" value=""
                                    placeholder="Telepon" required />
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input class="form-control" type="text" id="telepon" name="telepon" required />
                        </div>
                        {{-- <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Pilih Paket</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <div class="btn-group">
                                    <select class="form-select" name="paket_id" id="paket_id" required>
                                        @foreach ($pakets as $item)
                                            <option value="{{ $item->id }}" {{ $item->paket ? 'selected' : '' }}>
                                                {{ $item->paket }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
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
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                            @if (auth()->user()->hasRole('admin'))
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $value->nama }}" placeholder="Nama" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Nomer Induk
                                        Kependudukan</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="nik" name="nik"
                                            value="{{ $value->nik }}" placeholder="Nomer Induk Kependudukan" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="alamat" name="alamat"
                                            value="{{ $value->alamat }}" placeholder="Alamat" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" id="telepon" name="telepon"
                                            value="{{ $value->telepon }}" placeholder="Telepon" />
                                    </div>
                                </div>
                            @endif
                            @if (auth()->user()->hasRole('sales'))
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
                                    <label class="form-label" for="basic-icon-default-fullname">Keterangan</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            value="{{ $value->keterangan }}" placeholder="Keterangan" required />
                                    </div>
                                </div>
                            @endif


                            @if (auth()->user()->hasRole('admin'))
                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">Pilih Sales</label>
                                    <div class="input-group input-group-merge">
                                        <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                class="bx bx-user"></i></span>
                                        <div class="btn-group">
                                            <select class="form-select" name="user_survey" id="user_survey" required>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->name }}"
                                                        {{ $value->name ? 'selected' : '' }}>
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endif
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

    @foreach ($pemasangan as $value)
        <div class="modal fade" id="updateAssignment{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Tambah Data Teknisi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.pemasangans.updateTeknisi', $value->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            @if (auth()->user()->hasRole('sales'))
                                <div class="mb-3">
                                    <label for="user_action" class="form-label">Pilih Teknisi</label>
                                    <select id="user_action" class="form-select" name="user_action" required>
                                        @foreach ($teknisi as $item)
                                            <option value="{{ $item->name }}" {{ $value->name ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
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

    @foreach ($pemasangan as $value)
        <div class="modal fade" id="delete{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form method="POST" action="{{ route('route.pemasangans.destroy', $value->id) }}">
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
    @endforeach
@endsection
