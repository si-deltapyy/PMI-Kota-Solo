@extends('layouts-admin.default')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Laporan Kejadian</h4>
                    <div class="card-description">
                        <div class="home-tab">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <div class="btn-wrapper ms-auto">
                                        <a href="{{ route('reports.pdf', ['id' => $report->id_report]) }}" class="btn btn-primary text-white me-0">
                                            <i class="icon-download"></i> Unduh Laporan PDF
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori_bencana">Kategori Bencana</label>
                        <input type="text" class="form-control form-control-sm" id="kategori_bencana" value="{{ $report->jenisKejadian->nama_kejadian }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" class="form-control form-control-sm" id="lokasi" value="{{ $report->locationName }}" readonly>
                        <br>
                        <a href="{{ $report->googleMapsLink }}" class="btn btn-info btn-sm" id="lihat-lokasi">Lihat Lokasi</a>
                    </div>
                    <div class="form-group">
                        <label for="waktu_kejadian">Tanggal Kejadian</label>
                        <input type="text" class="form-control form-control-sm" id="waktu_kejadian" value="{{ $report->waktuKejadian['date'] }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="waktu_kejadian">Waktu Kejadian</label>
                        <input type="text" class="form-control form-control-sm" id="waktu_kejadian" value="{{ $report->waktuKejadian['time'] }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="waktu_kejadian">Terakhir Update</label>
                        <input type="text" class="form-control form-control-sm" id="waktu_kejadian" value="{{ $report->updateAt['date'] }} - {{ $report->updateAt['time'] }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea class="form-control form-control-sm" id="keterangan" rows="4" readonly>{{ $report->keterangan }}</textarea>
                    </div>
                    <div class="btn-wrapper">
                        <a href="{{ route('admin-laporankejadian') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
