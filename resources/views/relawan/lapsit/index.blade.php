@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <x-select-and-table title="Data Laporan Situasi" description="Daftar laporan situasi yang telah diunggah"
                :statuses="['Belum Diverifikasi', 'On Process', 'Selesai']"
                :table-headers="['No', 'Jenis Kejadian', 'Lokasi', 'Tanggal Kejadian', 'Waktu Kejadian', 'Terakhir Update', 'Status', 'Action']"
                create-route="{{ route('create-lapsit', $kejadian->first()->id_kejadian) }}" 
                baseUrl="lapsit"/>
        </div>
    </div>
</div>
@endsection