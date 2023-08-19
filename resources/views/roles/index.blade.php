@extends('layouts.app')
@section('content')
    <div class="content">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Access /</span> Role</h4>
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
                                <th>Guard</th>
                                <th>Permission</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($roles as $item)
                                <tr>
                                    <td>{{ $roles->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->guard_name }}</td>
                                    <td>
                                        @php
                                            $permissionsCount = $item->permissions->count();
                                            $allPermissions = $item->permissions->pluck('name')->implode(', ');
                                            
                                            if ($permissionsCount === count($permissions)) {
                                                echo '<span class="badge bg-label-primary me-1">' . 'All Permissions' . '</span>';
                                            } else {
                                                $permissionsChunks = $item->permissions->chunk(3);
                                                echo '<div class="d-flex flex-wrap">';
                                                foreach ($permissionsChunks as $chunk) {
                                                    echo '<div class="d-flex mb-2">';
                                                    foreach ($chunk as $permission) {
                                                        echo '<span class="badge bg-label-primary me-1" style="flex-basis: calc(33.33% - 10px);">' . $permission->name . '</span>';
                                                    }
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                            }
                                        @endphp
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
                    <div class="col-lg-12 ">{{ $roles->links('pagination::bootstrap-5') }}</div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal add roles --}}
    <div class="modal fade" id="add-roles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                                    placeholder="Name" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="guard">Guard Name</label>
                            <select class="form-select" id="guard_name" name="guard_name">
                                <option value="web">web</option>
                                <option value="api">api</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="form-check d-flex flex-wrap">
                                <div class="form-check me-3 mb-2" style="flex-basis: 25%;">
                                    <input class="form-check-input" type="checkbox" id="select-all">
                                    <label class="form-check-label">check all</label>
                                </div>
                                @foreach ($permissions as $permission)
                                    <div class="form-check me-3 mb-2" style="flex-basis: 25%;">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->id }}">
                                        <label class="form-check-label">{{ $permission->name }}</label>
                                    </div>
                                @endforeach

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
            <div class="modal-dialog modal-lg" role="document">
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
                                <label class="form-label" for="guard">Guard Name</label>
                                <select class="form-select" id="guard_name" name="guard_name">
                                    <option value="web" {{ $value->guard_name === 'web' ? 'selected' : '' }}>web
                                    </option>
                                    <option value="api" {{ $value->guard_name === 'api' ? 'selected' : '' }}>api
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Permissions</label>
                                <div class="form-check d-flex flex-wrap">
                                    <div class="form-check me-3 mb-2" style="flex-basis: 25%;">
                                        <input class="form-check-input" type="checkbox" id="select-all">
                                        <label class="form-check-label">check all</label>
                                    </div>
                                    @foreach ($permissions as $permission)
                                        <div class="form-check me-3 mb-2" style="flex-basis: 25%;">
                                            <input class="form-check-input" type="checkbox" name="permissions[]"
                                                value="{{ $permission->id }}"
                                                {{ $value->permissions->contains($permission) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $permission->name }}</label>
                                        </div>
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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all');
            const permissionCheckboxes = document.querySelectorAll('input[name="permissions[]"]');

            selectAllCheckbox.addEventListener('change', function() {
                for (const checkbox of permissionCheckboxes) {
                    checkbox.checked = this.checked;
                }
            });

            for (const checkbox of permissionCheckboxes) {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        const allChecked = Array.from(permissionCheckboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                });
            }
        });
    </script>
@endsection

@endsection
