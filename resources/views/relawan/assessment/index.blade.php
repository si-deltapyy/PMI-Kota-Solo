@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <x-select-and-table title="Data Laporan Assessment" description="Daftar assessment kejadian yang telah diunggah"
                :statuses="['On Process', 'Aktif', 'Selesai']"
                :table-headers="['No', 'Jenis Kejadian', 'Lokasi', 'Tanggal Kejadian', 'Waktu Kejadian', 'Terakhir Update', 'Status', 'Action']"
                create-route="{{ route('create-assessment') }}" 
                baseUrl="assessment" />
        </div>
    </div>
</div>
@endsection