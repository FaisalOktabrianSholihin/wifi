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
            <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Data Master /</span> ODP Port
            </h4>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-primary float-end mb-3" data-bs-toggle="modal" data-bs-target="#add">Tambah</button>
                    <div class="table-responsive text-nowrap">
                        <table id="myTable" class="table mb-4">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aksi</th>
                                    <th>ODC</th>
                                    <th>ODP</th>
                                    <th>ODP PORT</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($port as $item)
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
                                                        data-bs-target="#update{{ $item->id }}" class="dropdown-item"><i
                                                            class="bx bx-edit-alt me-1"></i>
                                                        Edit</button>
                                                    <button class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#delete{{ $item->id }}"><i
                                                            class="bx bx-trash me-1"></i>
                                                        Delete</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->odp->odc->odc }}</td>
                                        <td>{{ $item->odp->odp }}</td>
                                        <td>{{ $item->odp_port }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


    {{-- modal tambah ges --}}
    <div class="modal fade" id="add" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Tambahkan Data ODP Port</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('route.odp-port.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_odc" class="form-label">Pilih ODC</label>
                            <select id="kode_odc" class="form-select" name="odc_id" required>
                                <option value="" selected>Pilih Odc</option>
                                @foreach ($odc as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->kode_odc }} - {{ $item->odc }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode_odp" class="form-label">Pilih ODP</label>
                            <select id="kode_odp" class="form-select" name="odp_id" required>
                                <option value="" selected>Pilih Odp</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kode" class="form-label">ODP PORT</label>
                            <input class="form-control" type="number" id="kode" name="odp_port" required />
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

    {{-- modal edit ges --}}
    @foreach ($port as $item)
        <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data ODP</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.odp-port.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kode_odc_{{ $item->id }}" class="form-label">Pilih ODC</label>
                                <select id="kode_odc_{{ $item->id }}" class="form-select" name="odc_id" required>
                                    {{-- <option value="" selected>Pilih Odc</option> --}}
                                    @foreach ($odc as $odcItem)
                                        <option value="{{ $odcItem->id }}"
                                            {{ $odcItem->id == $item->odc_id ? 'selected' : '' }}>
                                            {{ $odcItem->kode_odc }} - {{ $odcItem->odc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_odp_{{ $item->id }}" class="form-label">Pilih ODP</label>
                                <select id="kode_odp_{{ $item->id }}" class="form-select odp-select" name="odp_id"
                                    required>
                                    <option value="" selected>Pilih Odp</option>
                                    {{-- Options for ODP will be populated dynamically using JavaScript --}}
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode" class="form-label">ODP PORT</label>
                                <input class="form-control" type="number" id="kode" name="odp_port"
                                    value="{{ $item->odp_port }}" required />
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


    {{-- modal hapus ges --}}
    @foreach ($odp as $item)
        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('route.odp.destroy', $item->id) }}" method="POST">
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

    <script>
        function updateOdpOptions() {
            var odcSelect = document.getElementById('kode_odc');
            var odpSelect = document.getElementById('kode_odp');

            odpSelect.innerHTML = '';

            if (odcSelect.value !== '') {
                var selectedOdcId = odcSelect.value;

                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih ODP';
                odpSelect.appendChild(defaultOption);

                @foreach ($odp as $item)
                    if ("{{ $item->odc_id }}" === selectedOdcId) {
                        var option = document.createElement('option');
                        option.value = "{{ $item->id }}";
                        option.text = "{{ $item->kode_odp }} - {{ $item->odp }}";
                        odpSelect.appendChild(option);
                    }
                @endforeach
            }
        }

        document.getElementById('kode_odc').addEventListener('change', updateOdpOptions);

        window.addEventListener('DOMContentLoaded', updateOdpOptions);
    </script>
    <script>
        // Fungsi untuk memperbarui opsi dropdown ODP berdasarkan pilihan ODC pada setiap modal
        @foreach ($port as $item)
            document.getElementById('kode_odc_{{ $item->id }}').addEventListener('change', function() {
                var odcSelect = document.getElementById('kode_odc_{{ $item->id }}');
                var odpSelect = document.getElementById('kode_odp_{{ $item->id }}');

                // Bersihkan opsi dropdown ODP
                odpSelect.innerHTML = '';

                // Jika ODC telah dipilih
                if (odcSelect.value !== '') {
                    // Ambil ODC ID yang dipilih
                    var selectedOdcId = odcSelect.value;

                    // Tambahkan opsi default
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.text = 'Pilih ODP';
                    odpSelect.appendChild(defaultOption);

                    // Filter dan tambahkan opsi ODP yang memiliki ODC ID yang dipilih
                    @foreach ($odp as $odpItem)
                        if ("{{ $odpItem->odc_id }}" === selectedOdcId) {
                            var option = document.createElement('option');
                            option.value = "{{ $odpItem->id }}";
                            option.text = "{{ $odpItem->kode_odp }} - {{ $odpItem->odp }}";
                            // Tandai opsi yang sesuai dengan odp_id yang sedang diedit
                            option.selected = "{{ $odpItem->id }}" === "{{ $item->odp_id }}";
                            odpSelect.appendChild(option);
                        }
                    @endforeach
                }
            });

            // Panggil fungsi updateOdpOptions saat dokumen dimuat ulang
            window.addEventListener('DOMContentLoaded', function() {
                // Trigger change event to populate ODP dropdown initially
                document.getElementById('kode_odc_{{ $item->id }}').dispatchEvent(new Event('change'));

                // Check if ODC has already been selected, if yes, trigger change event to update ODP dropdown
                if ("{{ $item->odc_id }}") {
                    document.getElementById('kode_odc_{{ $item->id }}').dispatchEvent(new Event('change'));
                }
            });
        @endforeach
    </script>
@endsection
