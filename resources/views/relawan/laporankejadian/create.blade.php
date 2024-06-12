@extends('layouts-relawan.default')

@section('content')
        <!-- partial -->
        <div class="content-wrapper">
            <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Laporan Kejadian</h4>
                  <p class="card-description">
                    Tambahkan laporan kejadian 
                  </p> 
                  <div class="home-tab">
                    <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    </div>
                    @php
                        $defaultDateTime = now()->format('Y-m-d');
                    @endphp
                    <form action="{{ route('store-laporankejadian') }}" method="POST">
                  @csrf
                        <div class="form-group">
                            <label for="nama_bencana">Nama Bencana</label>
                            <input type="text" class="form-control form-control-sm" id="nama_bencana" name="nama_bencana" placeholder="Nama Bencana" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_kejadian">Waktu Kejadian</label>
                            <input type="datetime" class="form-control form-control-sm" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ $defaultDateTime }}" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="4" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="lokasi_longitude">Lokasi Longitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_longitude" name="lokasi_longitude" placeholder="Longitude">
                        </div>
                        <div class="form-group">
                            <label for="lokasi_latitude">Lokasi Latitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_latitude" name="lokasi_latitude" placeholder="Latitude">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control form-control-sm" id="status" name="status" required>
                                <option value="On_Proses">On Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Dalam_Penanganan">Dalam Penanganan</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Submit</a></button>
                          <button class="btn btn-light">Cancel</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
    </div>
    </div>
    </div>
    
@endsection
