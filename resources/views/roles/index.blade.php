@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Role</h4>
      <div class="card">
          <div class="card-body">
             
                  <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                      data-bs-target="#add-roles">Tambah</button>
             

          </div>
          <div class="table-responsive text-nowrap">
              <table class="table">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Permission</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{ $roles->firstItem() + $loop->index }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                              @foreach ($item->permissions as $permission)
                              <span class="badge bg-label-primary me-1">{{ $permission->name }}</span>
                              @endforeach
                            </td>

                            {{-- @if (auth()->user()->level == 'Admin') --}}
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#update-roles{{ $item->id }}"
                                                class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                Edit</button>
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#delete-roles{{ $item->id }}"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</button>
                                        </div>
                                    </div>
                                </td>
                            {{-- @endif --}}
                        </tr>
                    @endforeach
                  </tbody>
              </table>
              <div class="card mb-4">
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

{{-- Modal add roles --}}
<div class="modal fade" id="add-roles" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="formTambah" method="POST" action="{{ route('super admin.roles.store') }}">
              @csrf
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-fullname">Nama Role</label>
                      <div class="input-group input-group-merge">
                          <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                  class="bx bx-user"></i></span>
                          <input type="text" class="form-control" id="name" name="name" value=""
                              placeholder="Name" required/>
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

{{-- Modal update roles --}}
@foreach ($roles as $value)
<div class="modal fade" id="update-roles{{ $value->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('super admin.roles.update', $value->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Role</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $value->name }}" placeholder="Name Roles" />
                        </div>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Role Permission</label>
                      @if ($value->permissions)
                      <div class="flex space-x-2">
                        @foreach ($value->permissions as $role_permission)
                              <form method="POST"
                                  action="{{ route('super admin.roles.permissions.revoke', [$value->id, $role_permission->id]) }}"
                                  >
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-sm btn-outline-danger m-1" type="submit">{{ $role_permission->name }} <span class="tf-icons bx bx-x"></span></button>
                              </form>
                          @endforeach
                      </div>
                      @endif
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Permission</label>
                      <div class="flex space-x-2">
                          @foreach ($permissions as $permission)
                              <form method="POST" action="{{ route('super admin.roles.permissions', [$value->id]) }}">
                                  @csrf
                                  
                                  <input type="hidden" name="permission" value="{{ $permission->name }}">
                                  <button class="btn btn-sm btn-outline-success m-1" type="submit">{{ $permission->name }} <span class="tf-icons bx bx-plus"></span></button>
                              </form>
                          @endforeach
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

{{-- Modal delete --}}
@foreach ($roles as $value)
<div class="modal fade" id="delete-roles{{ $value->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('super admin.roles.destroy', $value->id) }}">
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