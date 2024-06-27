@extends('layouts-admin.default')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <x-select-and-table title="Data Laporan Situasi" description="Daftar laporan situasi kejadian yang telah diunggah"
                :statuses="['Aktif', 'Selesai']"
                :table-headers="['No', 'Jenis Kejadian', 'Lokasi', 'Tanggal Kejadian', 'Waktu Kejadian', 'Terakhir Update', 'Status', 'Action']"
                create-route="{{ route('admin-lapsit') }}" 
                baseUrl="lapsit" />
        </div>
    </div>
</div>
@endsection