@extends('layouts-admin.default')

@section('content')

<!-- partial -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Laporan Kejadian</h4>
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
                                            <th>Jenis Kejadian</th>
                                            <th>Tanggal Kejadian</th>
                                            <th>Terakhir Update</th>
                                            <th>Lokasi Longitude</th>
                                            <th>Lokasi Latitude</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($reports as $report)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                              @if ($report->jenisKejadian)
                                                {{ $report->jenisKejadian->nama_kejadian }}
                                              @else
                                                  Nama tidak ditemukan
                                              @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->timestamp_report)->format('d-m-Y H:i:s') }}</td>
                                            <td>{{ $report->lokasi_longitude }}</td>
                                            <td>{{ $report->lokasi_latitude }}</td>
                                            <td>{{ $report->keterangan}}</td>
                                            <td>
                                                @if ($report->status === 'On Process')
                                                    <button class="btn btn-warning btn-sm text-white" disabled>Dalam Proses</button>
                                                @elseif ($report->status === 'Valid')
                                                    <button class="btn btn-success btn-sm text-white" disabled>Valid</button>
                                                @elseif ($report->status === 'Invalid')
                                                    <button class="btn btn-info btn-sm text-white" disabled>Invalid</button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm text-bold" disabled>Unknown</button>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('create-laporankejadian') }}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-information"></i></a>
                                                <a href="{{ route('edit-laporankejadian', $report->id) }}" class="btn btn-warning btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
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
