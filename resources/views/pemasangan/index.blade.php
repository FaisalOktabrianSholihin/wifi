@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Pemasangan
            </h4>
            <div class="top-0 end-0 col-md-3">
                @if (Session::has('message'))
                    <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">Bootstrap</div>
                            <small>11 mins ago</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body">
                            {{ Session::get('message') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="card">
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
                                <th>Nama Sales</th>
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
                                                                class="bx bx-edit-alt me-1"></i>
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
                                        <td>{{ $item->user_survey }}</td>
                                        <td><span class="badge bg-secondary">{{ $item->status_survey }}</span></td>
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
                                                    @endcan
                                                    {{-- @can('create pendaftaran')
                                                        <button class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#delete-billings{{ $item->id }}"><i
                                                                class="bx bx-trash me-1"></i>
                                                            Delete</button>
                                                    @endcan --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->no_pendaftaran }}</td>
                                        <td>{{ $item->nik }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->telepon }}</td>
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
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="validasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Validasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formValidasi" method="" action="">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Name Sales</label>
                            <div class="input-group input-group-merge">
                                <select class="form-select" id="guard_name" name="guard_name">
                                    <option value="web">Yono</option>
                                    <option value="api">Bahrul</option>
                                </select>
                            </div>
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
    </div> --}}

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
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">No Pendaftaran</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="no_pendaftaran" name="no_pendaftaran"
                                    value="" placeholder="No. Pendafataran" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nomer Induk Kependudukan</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="nik" name="nik" value=""
                                    placeholder="Nomer Induk Kependudukan" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="nama" name="nama" value=""
                                    placeholder="Nama" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Alamat</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="alamat" name="alamat" value=""
                                    placeholder="Alamat" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Telepon</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="telepon" name="telepon" value=""
                                    placeholder="Telepon" required />
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
                                    <label class="form-label" for="basic-icon-default-fullname">Keterangan</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            value="{{ $value->keterangan }}" placeholder="Keterangan" />
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
