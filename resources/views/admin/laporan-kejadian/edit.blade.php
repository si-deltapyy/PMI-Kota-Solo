@extends('layouts-admin.default')

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Detail Laporan Kejadian</h4>
          <div class="form-group">
            <label for="kategori_bencana">Kategori Bencana</label>
            <input type="text" class="form-control form-control-sm" id="kategori_bencana"
              value="{{ $report->jenisKejadian->nama_kejadian }}">
          </div>
          <div class="form-group">
            <label for="lokasi">Lokasi</label>
            <input type="text" class="form-control form-control-sm" id="lokasi" value="{{ $report->locationName }}">
            <br>
            <a href="{{ $report->googleMapsLink }}" class="btn btn-info btn-sm" id="lihat-lokasi">Lihat Lokasi</a>
          </div>
          <div class="form-group">
            <label for="waktu_kejadian">Tanggal Kejadian</label>
            <input type="text" class="form-control form-control-sm" id="waktu_kejadian"
              value="{{ $report->waktuKejadian['date'] }}">
          </div>
          <div class="form-group">
            <label for="waktu_kejadian">Waktu Kejadian</label>
            <input type="text" class="form-control form-control-sm" id="waktu_kejadian"
              value="{{ $report->waktuKejadian['time'] }}">
          </div>
          <div class="form-group">
            <label for="waktu_kejadian">Terakhir Update</label>
            <input type="text" class="form-control form-control-sm" id="waktu_kejadian"
              value="{{ $report->updateAt['date'] }} - {{ $report->updateAt['time'] }}">
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control form-control-sm" id="keterangan" rows="4">{{ $report->keterangan }}</textarea>
          </div>
          <div class="btn-wrapper">
            <a href="{{ route('relawan-laporankejadian') }}" class="btn btn-secondary">Back</a>
            <a href="{{ route('relawan-laporankejadian') }}" class="btn btn-primary">Submit</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection