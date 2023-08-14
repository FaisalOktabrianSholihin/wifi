@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> User</h4>
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
                                    {{-- @if (auth()->user()->level == 'Admin') --}}
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    @can('update user')
                                                        <button data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit{{ $item->id }}"
                                                        class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
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
                                    {{-- @endif --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card">
                        <h5 class="card-header">Pagination</h5>
                        <!-- Basic Pagination -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <small class="text-light fw-semibold">Basic</small>
                                    <div class="demo-inline-spacing">
                                        <!-- Basic Pagination -->
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination">
                                                <li class="page-item first">
                                                    <a class="page-link" href="javascript:void(0);"><i
                                                            class="tf-icon bx bx-chevrons-left"></i></a>
                                                </li>
                                                <li class="page-item prev">
                                                    <a class="page-link" href="javascript:void(0);"><i
                                                            class="tf-icon bx bx-chevron-left"></i></a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="javascript:void(0);">1</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="javascript:void(0);">2</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a class="page-link" href="javascript:void(0);">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="javascript:void(0);">4</a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="javascript:void(0);">5</a>
                                                </li>
                                                <li class="page-item next">
                                                    <a class="page-link" href="javascript:void(0);"><i
                                                            class="tf-icon bx bx-chevron-right"></i></a>
                                                </li>
                                                <li class="page-item last">
                                                    <a class="page-link" href="javascript:void(0);"><i
                                                            class="tf-icon bx bx-chevrons-right"></i></a>
                                                </li>
                                            </ul>
                                        </nav>
                                        <!--/ Basic Pagination -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <form action="{{ url('dataMaster/edit/' . $value->id) }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="namaUser" name="name"
                                        value="{{ $value->name }}" placeholder="Nama Lengkap" aria-label="John Doe"
                                        aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-email">Email</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                    <input type="text" id="emailUser" name="email" value="{{ $value->email }}"
                                        class="form-control" placeholder="faisal22" aria-label="faisal"
                                        aria-describedby="basic-icon-default-email2" />
                                    <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                                </div>
                                <div class="form-text">Anda dapat menggunakan huruf, angka & titik</div>
                            </div>
                            <div class="mb-3">

                                <label class="form-label" for="basic-icon-default-fullname">Role</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <div class="btn-group ">
                                        <select class="form-select" name="level" id="idposisi">
                                            <option value="{{ $value->level }}">{{ $value->level }}</option>
                                            <option value="Super Admin">Super Admin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Operator">Operator</option>
                                        </select>
                                    </div>
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
                            <label class="form-label" for="basic-icon-default-fullname">Nama Lengkap</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="namaUser" name="name" value=""
                                    placeholder="Nama Lengkap" aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2" />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-email">Email</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                <input type="text" id="emailUser" name="email" value="" class="form-control"
                                    placeholder="faisal22" aria-label="faisal"
                                    aria-describedby="basic-icon-default-email2" />
                                <span id="basic-icon-default-email2" class="input-group-text">@example.com</span>
                            </div>
                            <div class="form-text">Anda dapat menggunakan huruf, angka & titik</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Role</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <div class="btn-group ">
                                    <select class="form-select" name="level" id="idposisi">
                                        <option value="" selected disabled hidden>Pilih</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Operator">Operator</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="basic-icon-default-fullname">Password</label>
                            <div class="input-group input-group-merge">
                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                        class="bx bx-user"></i></span>
                                <input type="text" class="form-control" id="passwordUser" name="password"
                                    placeholder="Password" aria-label="John Doe"
                                    aria-describedby="basic-icon-default-fullname2" />
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
