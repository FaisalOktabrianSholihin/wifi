@extends('layouts.app')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4" style="color: white"><span class="text-muted fw-light">Service /</span> Ubah Paket
        </h4>
        <div class="nav-align-top mb-4">
            <ul class="nav nav-pills mb-3" role="tablist">
                <li class="nav-item">
                    <a href="{{ route('route.ubah_pakets.index') }}" class="nav-link" role="tab" aria-selected="false"
                        style="color: white">
                        Proses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('route.ubah_pakets-berhasil') }}" class="nav-link active" role="tab"
                        aria-selected="true" style="color: white">
                        Berhasil
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('route.ubah_pakets-gagal') }}" class="nav-link" role="tab" aria-selected="false"
                        style="color: white">
                        Gagal
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="table-responsive text-nowrap">
                    <table id="myTable" class="table mb-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Pelanggan</th>
                                <th>Nama Pelanggan</th>
                                <th>Paket Lama</th>
                                <th>Paket Baru</th>
                                @if (auth()->user()->hasRole('admin') ||
                                        auth()->user()->hasRole('sales'))
                                    <th>Tanggal Ubah</th>
                                @endif
                                @if (auth()->user()->hasRole('teknisi'))
                                    <th>Status</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @can('read ubah paket')
                                @foreach ($berhasil as $item)
                                    @if (auth()->user()->hasRole('admin') ||
                                            auth()->user()->hasRole('sales'))
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_pelanggan }}</td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            <td>{{ $item->paket_lama }}</td>
                                            <td>{{ $item->paket->paket }}</td>
                                            <td>{{ $item->updated_at->format('d F Y H:i:s') }}</td>
                                        </tr>
                                    @elseif (auth()->user()->hasRole('teknisi'))
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->no_pelanggan }}</td>
                                            <td>{{ $item->pelanggan->nama }}</td>
                                            <td>{{ $item->paket_lama }}</td>
                                            <td>{{ $item->paket->paket }}</td>
                                            <td>
                                                {{ $item->lunas }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endcan
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
