@extends('layouts.app')
@section('content')
<div class="content">
  <div class="container-xxl flex-grow-1 container-p-y">
    
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Master /</span> Permission</h4>
      <div class="top-0 end-0 flex justify-end">
        @if (Session::has('message'))
      <div
      class="bs-toast toast fade show bg-primary"
      role="alert"
      aria-live="assertive"
      aria-atomic="true"
    >
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
          <div class="flex justify-end me-4 mt-4">
                  <button class="btn rounded-pill btn-outline-primary float-end" data-bs-toggle="modal"
                      data-bs-target="#add-permissions">Tambah</button>
          </div>
          <div class="table-responsive text-nowrap">
              <table class="table">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Guard</th>
                          <th>Update</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                    @foreach ($permissions as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->guard_name }}</td>
                            <td>{{ $item->updated_at }}</td>
                            
                            {{-- @if (auth()->user()->level == 'Admin') --}}
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <button data-bs-toggle="modal"
                                                data-bs-target="#update{{ $item->id }}"
                                                class="dropdown-item"><i class="bx bx-edit-alt me-1"></i>
                                                Edit</button>
                                            <button class="dropdown-item" data-bs-toggle="modal"
                                                data-bs-target="#delete-permissions{{ $item->id }}"><i
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

<div class="modal fade" id="add-permissions" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data User</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="formTambah" method="POST" action="{{ route('super admin.permissions.store') }}">
              @csrf
              <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label" for="basic-icon-default-fullname">Name Permission</label>
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

@foreach ($permissions as $value)
<div class="modal fade" id="update{{ $value->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('super admin.permissions.update', $value) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="basic-icon-default-fullname">Nama Permission</label>
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                    class="bx bx-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $value->name }}" placeholder="Name Permission" />
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
@foreach ($permissions as $value)
<div class="modal fade" id="delete-permissions{{ $value->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('super admin.permissions.destroy', $value->id) }}">
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