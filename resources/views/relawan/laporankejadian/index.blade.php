@extends('layouts-relawan.default')

@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Laporan Kejadian</h4>
                        <p class="card-description">
                            Daftar laporan kejadian yang telah diunggah
                        </p>
                        <div class="home-tab">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <div class="btn-wrapper ms-auto">
                                    <a href="{{ route('create-laporankejadian') }}" class="btn btn-primary text-white me-0">
                                        <i class="icon-download"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div>
                            <div class="table-responsive pt-3">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori Bencana</th>
                                            <th>Lokasi Longitude</th>
                                            <th>Lokasi Latitude</th>
                                            <th>Tanggal Kejadian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $report->nama_bencana }}</td>
                                            <td>{{ $report->lokasi_longitude }}</td>
                                            <td>{{ $report->lokasi_latitude }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d-m-Y H:i') }}</td>
                                            <td>
                                                @if($report->status == 'On_Proses')
                                                    <button class="btn btn-warning btn-sm text-white" disabled>On Proses</button>
                                                @elseif($report->status == 'Selesai')
                                                    <button class="btn btn-success btn-sm text-white" disabled>Selesai</button>
                                                @elseif($report->status == 'Dalam_Penanganan')
                                                    <button class="btn btn-info btn-sm text-white" disabled>Dalam Penanganan</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-laporankejadian', $report->id) }}" class="btn btn-warning btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                                                <!-- Tombol atau link untuk aksi lain (mis. hapus) -->
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7">Belum ada laporan kejadian.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->

@endsection
