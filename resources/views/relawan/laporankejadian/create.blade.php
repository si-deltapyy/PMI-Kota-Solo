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
                        <!-- Jenis Kejadian -->
                        <div class="form-group">
                            <label for="id_jeniskejadian">Jenis Kejadian</label>
                            <select name="id_jeniskejadian" id="id_jeniskejadian" class="form-control form-control-sm" placeholder="- Pilih Jenis Kejadian -" required>
                                <option value="">- Pilih Jenis Kejadian -</option>
                                @foreach ($jeniskejadian as $jenis)
                                <option value="{{ $jenis->id_jeniskejadian }}">{{ $jenis->nama_kejadian }}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- Tanggal Kejadian -->
                        <div class="form-group">
                            <label for="tanggal_kejadian">Waktu Kejadian</label>
                            <input type="datetime" class="form-control form-control-sm" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ $defaultDateTime }}" required>
                        </div>
                        <!-- Keterangan -->
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" rows="4" required></textarea>
                        </div>
                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control form-control-sm" id="status" name="status" required>
                                <option value="On Process">On Process</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Belum Diverifikasi">Belum Diverifikasi</option>
                            </select>
                        </div>
                        <!-- Lokasi Longitude -->
                        <div class="form-group">
                            <label for="lokasi_longitude">Lokasi Longitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_longitude" name="lokasi_longitude" placeholder="Longitude">
                        </div>
                        <!-- Lokasi Latitude -->
                        <div class="form-group">
                            <label for="lokasi_latitude">Lokasi Latitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_latitude" name="lokasi_latitude" placeholder="Latitude">
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