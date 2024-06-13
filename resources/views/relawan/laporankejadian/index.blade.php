@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <x-select-and-table title="Data Laporan Kejadian" description="Daftar laporan kejadian yang telah diunggah"
                :statuses="['Belum Diverifikasi', 'On Process', 'Selesai']"
                :table-headers="['No', 'Jenis Kejadian', 'Lokasi', 'Waktu Kejadian', 'Terakhir Update', 'Keterangan', 'Status', 'Action']"
                create-route="{{ route('create-laporankejadian') }}" />
        </div>
    </div>
</div>
@endsection