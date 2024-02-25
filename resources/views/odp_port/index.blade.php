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

    @foreach ($port as $item)
        <div class="modal fade" id="update{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Edit Data ODP Port</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('route.odp-port.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kode_odc_{{ $item->id }}" class="form-label">Pilih ODC</label>
                                <select id="kode_odc_{{ $item->id }}" class="form-select" name="odc_id" required>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="kode_odp_{{ $item->id }}" class="form-label">Pilih ODP</label>
                                <select id="kode_odp_{{ $item->id }}" class="form-select odp-select" name="odp_id"
                                    required>
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
    @foreach ($port as $item)
        <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{ route('route.odp-port.destroy', $item->id) }}" method="POST">
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
        function updateOptions(selectId, selectedOdpId, selectedOdcId, odpPort) {
            console.log("Updating options for selectId:", selectId);
            console.log("Selected ODP ID:", selectedOdpId);
            console.log("Selected ODC ID:", selectedOdcId);
            console.log("ODP Port:", odpPort);

            var odcSelect = document.getElementById(selectId);
            console.log("ODC Select:", odcSelect);

            var odpSelect = document.querySelector('#' + selectId.replace('kode_odc_', 'kode_odp_'));
            console.log("ODP Select:", odpSelect);

            odcSelect.value = selectedOdcId;
            console.log("Set ODC value:", selectedOdcId);

            updateOdpOptions(selectId, odpSelect.id, selectedOdpId, odpPort);
        }

        function updateOdpOptions(selectId, odpId, selectedOdpId, odpPort) {
            console.log("Updating ODP options for selectId:", selectId);
            console.log("Selected ODP ID:", selectedOdpId);
            console.log("ODP Port:", odpPort);

            var odcSelect = document.getElementById(selectId);
            console.log("ODC Select for ODP options:", odcSelect);

            var odpSelect = document.getElementById(odpId);
            console.log("ODP Select:", odpSelect);

            odpSelect.innerHTML = '';

            if (odcSelect.value !== '') {
                var selectedOdcId = odcSelect.value;

                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.text = 'Pilih ODP';
                odpSelect.appendChild(defaultOption);

                console.log("Selected ODC ID for ODP options:", selectedOdcId);

                @foreach ($odp as $odpItem)
                    console.log("Checking ODP item:", "{{ $odpItem->id }}", "{{ $odpItem->odc_id }}", selectedOdcId);
                    if ("{{ $odpItem->odc_id }}" === selectedOdcId) {
                        var option = document.createElement('option');
                        option.value = "{{ $odpItem->id }}";
                        option.text = "{{ $odpItem->kode_odp }} - {{ $odpItem->odp }}";
                        if ("{{ $odpItem->id }}" === selectedOdpId) {
                            option.selected = true;
                        }
                        odpSelect.appendChild(option);
                    }
                @endforeach
            }

            odpSelect.value = selectedOdpId;
        }

        @foreach ($port as $item)
            document.getElementById('update{{ $item->id }}').addEventListener('shown.bs.modal', function(event) {
                var modal = event.target;
                updateOptions('kode_odc_{{ $item->id }}', '{{ $item->odp_id }}', '{{ $item->odp->odc_id }}',
                    '{{ $item->odp_port }}');
            });
        @endforeach
    </script>

    @foreach ($port as $item)
        <script>
            document.getElementById('update{{ $item->id }}').addEventListener('shown.bs.modal', function(event) {
                var modal = event.target;
                var selectedOdcId = "{{ $item->odp->odc_id }}";
                var selectedOdpId = "{{ $item->odp_id }}";

                var odcSelect = modal.querySelector('#kode_odc_{{ $item->id }}');
                var odpSelect = modal.querySelector('#kode_odp_{{ $item->id }}');

                odcSelect.innerHTML = '';
                odpSelect.innerHTML = '';

                var defaultOptionOdc = document.createElement('option');
                defaultOptionOdc.value = '';
                defaultOptionOdc.text = 'Pilih ODC';
                odcSelect.appendChild(defaultOptionOdc);

                var defaultOptionOdp = document.createElement('option');
                defaultOptionOdp.value = '';
                defaultOptionOdp.text = 'Pilih ODP';
                odpSelect.appendChild(defaultOptionOdp);

                @foreach ($odc as $odcItem)
                    var optionOdc = document.createElement('option');
                    optionOdc.value = "{{ $odcItem->id }}";
                    optionOdc.text = "{{ $odcItem->kode_odc }} - {{ $odcItem->odc }}";
                    if ("{{ $odcItem->id }}" === selectedOdcId) {
                        optionOdc.selected = true;
                    }
                    odcSelect.appendChild(optionOdc);
                @endforeach

                function updateOdpOptions(selectedOdcId) {
                    odpSelect.innerHTML = '';

                    var defaultOptionOdp = document.createElement('option');
                    defaultOptionOdp.value = '';
                    defaultOptionOdp.text = 'Pilih ODP';
                    odpSelect.appendChild(defaultOptionOdp);

                    @foreach ($odp as $odpItem)
                        if ("{{ $odpItem->odc_id }}" === selectedOdcId) {
                            var optionOdp = document.createElement('option');
                            optionOdp.value = "{{ $odpItem->id }}";
                            optionOdp.text = "{{ $odpItem->kode_odp }} - {{ $odpItem->odp }}";
                            if ("{{ $odpItem->id }}" === selectedOdpId) {
                                optionOdp.selected = true;
                            }
                            odpSelect.appendChild(optionOdp);
                        }
                    @endforeach
                }

                updateOdpOptions(selectedOdcId);

                odcSelect.addEventListener('change', function() {
                    var selectedOdcId = this.value;
                    updateOdpOptions(selectedOdcId);
                });
            });
        </script>
    @endforeach
@endsection
