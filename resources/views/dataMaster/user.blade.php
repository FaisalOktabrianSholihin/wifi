@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> User</h4>
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
                    @can('create user')
                        <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">Tambah</button>
                    @endcan
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        {{ $item->email }}
                                    </td>
                                    <td>
                                        @if ($item->roles)
                                            @foreach ($item->roles as $user_roles)
                                                <span class="badge bg-label-primary me-1">{{ $user_roles->name }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @can('update user')
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}" class="dropdown-item"><i
                                                            class="bx bx-edit-alt me-1"></i>
                                                        Edit</button>
                                                @endcan
                                                @can('delete user')
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#modalHapus{{ $item->id }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Delete</button>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $user->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Edit -->
    @foreach ($user as $value)
        <div class="modal fade" id="modalEdit{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ url('dataMaster/edit/' . $value->id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Name</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $value->name }}" placeholder="Name" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="email" id="email" name="email" value="{{ $value->email }}"
                                        class="form-control" placeholder="example@gmail.com" />
                                    {{-- <span id="basic-icon-default-email2" class="input-group-text">@example.com</span> --}}
                                </div>
                                <div class="form-text">Anda dapat menggunakan huruf, angka & titik</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Role</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <div class="btn-group ">
                                        <select class="form-select" name="role" id="role" required>
                                            @foreach ($role as $item)
                                                <option value="{{ $item->name }}"
                                                    {{ $value->hasRole($item->name) ? 'selected' : '' }}>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Password</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-key"></i></span>
                                    <input type="text" class="form-control" id="password" name="password"
                                        placeholder="*********" minlength="6" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah-->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formTambah" method="POST" action="{{ route('dataMaster.save') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Name</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="example@gmail.com" required />
                                {{-- <span id="basic-icon-default-email2" class="input-group-text">@example.com</span> --}}
                            </div>
                            <div class="form-text">Anda dapat menggunakan huruf, angka & titik</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Role</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <div class="btn-group ">
                                    <select class="form-select" name="role" id="role">
                                        <option selected disabled hidden>Select Role</option>
                                        @foreach ($role as $item)
                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Password</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-key"></i></span>
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="*********" required />
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

    <!-- Modal Hapus-->
    @foreach ($user as $value)
        <div class="modal fade" id="modalHapus{{ $value->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="formHapus" method="GET" action="{{ url('dataMaster/delete/' . $value->id) }}">
                    @csrf
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
