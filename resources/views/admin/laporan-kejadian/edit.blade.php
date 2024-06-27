@extends('layouts-admin.default')

@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Detail Laporan Kejadian</h4>
          <form action="{{ route('update-laporankejadian', $report->id_report) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="kategori_bencana">Kategori Bencana</label>
              <input type="text" class="form-control form-control-sm" id="kategori_bencana" name="kategori_bencana"
                value="{{ $report->jenisKejadian->nama_kejadian }}">
            </div>
            <div class="form-group">
              <label for="lokasi">Lokasi</label>
              <input type="text" class="form-control form-control-sm" id="lokasi" name="lokasi"
                value="{{ $report->locationName }}">
              <br>
              <a href="{{ $report->googleMapsLink }}" class="btn btn-info btn-sm" id="lihat-lokasi">Lihat Lokasi</a>
            </div>
            <div class="form-group">
              <label for="waktu_kejadian">Tanggal Kejadian</label>
              <input type="date" class="form-control form-control-sm" id="waktu_kejadian" name="tanggal_kejadian"
                value="{{ $report->waktuKejadian['date'] }}">
            </div>
            <div class="form-group">
              <label for="waktu_kejadian">Waktu Kejadian</label>
              <input type="time" class="form-control form-control-sm" id="waktu_kejadian" name="waktu_kejadian"
                value="{{ $report->waktuKejadian['time'] }}">
            </div>
            <div class="form-group">
              <label for="waktu_kejadian">Terakhir Update</label>
              <input type="text" class="form-control form-control-sm" id="update_at" name="update_at"
                value="{{ $report->updateAt['date'] }} - {{ $report->updateAt['time'] }}" readonly>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea class="form-control form-control-sm" id="keterangan" name="keterangan"
                rows="4">{{ $report->keterangan }}</textarea>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control form-control-sm" id="status" name="status">
                <option value="On Process" {{ $report->status == 'On Process' ? 'selected' : '' }}>On Process</option>
                <option value="Valid" {{ $report->status == 'Valid' ? 'selected' : '' }}>Valid</option>
                <option value="Invalid" {{ $report->status == 'Invalid' ? 'selected' : '' }}>Invalid</option>
              </select>
            </div>
            <div class="btn-wrapper">
              <a href="{{ route('admin-laporankejadian') }}" class="btn btn-secondary">Back</a>
              <button type="submit" class="btn btn-primary active">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
