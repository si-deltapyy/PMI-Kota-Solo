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
                        <div>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jenis Kejadian</th>
                                            <th>Lokasi</th>
                                            <th>Waktu Kejadian</th>
                                            <th>Terakhir Update</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $rows = [
                                        ['jenis' => 'Banjir', 'lokasi' => 'Jakarta', 'waktu' => '2024-05-01 14:00', 'update' => '2024-05-01 15:00', 'keterangan' => 'Hujan deras mengguyur Jakarta pada hari Senin, 1 Mei 2024 pukul 14:00 WIB,<br>menyebabkan banjir dengan ketinggian air mencapai 1 meter di beberapa wilayah.<br>Kecamatan yang terdampak meliputi Tebet, Pancoran, dan Mampang Prapatan.', 'status' => 'Terverifikasi'],
                                        ['jenis' => 'Gempa', 'lokasi' => 'Bandung', 'waktu' => '2024-05-02 10:30', 'update' => '2024-05-02 11:00', 'keterangan' => 'Gempa berkekuatan 5,8 SR terjadi pada Kamis, 2 Mei 2024 pukul 10:30 WIB mengguncang Bandung.<br>Pusat gempa berada di kedalaman 10 km di sebelah barat daya kota.<br>Tidak ada laporan kerusakan signifikan', 'status' => 'Belum Terverifikasi'],
                                        ['jenis' => 'Kebakaran', 'lokasi' => 'Surabaya', 'waktu' => '2024-05-03 09:15', 'update' => '2024-05-03 09:45', 'keterangan' => 'Kebakaran besar terjadi di Pasar Tradisional Surabaya pada hari Jumat, 3 Mei 2024 pukul 09:15 WIB.<br>Api berhasil dipadamkan pada pukul 09:45 WIB.<br>Sebanyak 20 kios terbakar, dan kerugian diperkirakan mencapai miliaran rupiah.<br>Tidak ada korban jiwa dalam insiden ini.', 'status' => 'Terverifikasi'],
                                        ['jenis' => 'Longsor', 'lokasi' => 'Yogyakarta', 'waktu' => '2024-05-04 18:00', 'update' => '2024-05-04 18:30', 'keterangan' => 'Hujan lebat pada hari Sabtu, 4 Mei 2024 pukul 18:00 WIB mengakibatkan longsor di<br>Kecamatan Pleret dan Imogiri, Yogyakarta. Longsor menutup akses jalan<br>utama dan merusak beberapa rumah. Ketinggian material longsor mencapai 2 meter.<br>Tim SAR sedang melakukan evakuasi dan pembersihan lokasi.', 'status' => 'Terverifikasi'],
                                        ['jenis' => 'Banjir', 'lokasi' => 'Medan', 'waktu' => '2024-05-05 07:00', 'update' => '2024-05-05 08:00', 'keterangan' => 'Banjir menggenangi kota Medan setelah hujan deras semalaman.<br>Ketinggian air mencapai 1,5 meter di Kecamatan Medan Johor, Medan Selayang, dan Medan Tuntungan.<br>Medan Selayang, dan Medan Tuntungan.', 'status' => 'Belum Terverifikasi']
                                        ];
                                        $sortedRows = collect($rows)->sortBy('status')->reverse()->all();
                                        @endphp
                                        @foreach($sortedRows as $index => $row)
                                        <tr class="{{ $row['status'] == 'Terverifikasi' ? 'text-muted' : '' }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row['jenis'] }}</td>
                                            <td>{{ $row['lokasi'] }}</td>
                                            <td>{{ $row['waktu'] }}</td>
                                            <td>{{ $row['update'] }}</td>
                                            <td>{!! $row['keterangan'] !!}</td>
                                            <td>
                                                <p class="btn {{ $row['status'] == 'Terverifikasi' ? 'btn-success' : 'btn-warning' }} btn-sm">{{ $row['status'] }}</p>
                                            </td>
                                            <td>
                                                @if($row['status'] == 'Belum Terverifikasi')
                                                <a href="{{ route('edit-laporankejadian') }}" class="btn btn-info btn-sm"><i class="menu-icon mdi mdi-border-color"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm"><i class="menu-icon mdi mdi-delete"></i></a>
                                                @else
                                                <a href="{{ route('edit-laporankejadian') }}" class="btn btn-info btn-sm disabled"><i class="menu-icon mdi mdi-border-color"></i></a>
                                                <a href="#" class="btn btn-danger btn-sm disabled"><i class="menu-icon mdi mdi-delete"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
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
