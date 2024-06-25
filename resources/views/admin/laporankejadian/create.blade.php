@extends('layouts-admin.default')

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
                        $defaultDateTime = now()->format('Y-m-d\TH:i:s');
                    @endphp
                    <form action="{{ route('store-laporankejadian') }}" method="POST">
                      @csrf
                        <!-- Jenis Kejadian -->
                        <div class="form-group">
                            <label for="id_jeniskejadian">Jenis Kejadian</label>
                            <select name="id_jeniskejadian" id="id_jeniskejadian" class="form-control form-control-sm" placeholder="- Pilih Jenis Kejadian -" required>
                                <option value="">- Pilih Jenis Kejadian -</option>
                                @foreach ($jeniskejadian as $jenis)
                                <option value="{{ $jenis-> id_jeniskejadian }}">{{ $jenis-> nama_kejadian }}</option>
                                @endforeach
                              </select>
                        </div>
                        <!-- Tanggal Kejadian -->
                        <div class="form-group">
                            <label for="tanggal_kejadian">Waktu Kejadian</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ $defaultDateTime }}" required>
                        </div>
                        <!-- Terakhir Update -->
                        <div class="form-group">
                            <label for="timestamp_report">Terakhir Update</label>
                            <input type="datetime-local" class="form-control form-control-sm" id="timestamp_report" name="timestamp_report" value="{{ $defaultDateTime }}" required>
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
                                <option value="On Process">Dalam Proses</option>
                                <option value="Valid">Valid</option>
                                <option value="Invalid">Invalid</option>
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
                            <button type="button" class="btn btn-primary text-white" id="btnUseCurrentLocation">
                                Gunakan Lokasi Saat Ini
                            </button>
                        </div>
                        <!-- Lokasi Longitude -->
                        <!-- <div class="form-group">
                            <label for="lokasi_longitude">Lokasi Longitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_longitude" name="lokasi_longitude" placeholder="Longitude">
                        </div> -->
                        <!-- Lokasi Latitude -->
                        <!-- <div class="form-group">
                            <label for="lokasi_latitude">Lokasi Latitude</label>
                            <input type="number" step="any" class="form-control form-control-sm" id="lokasi_latitude" name="lokasi_latitude" placeholder="Latitude">
                        </div> -->
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Tambah Data</button>
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
    <script>
    document.getElementById('btnUseCurrentLocation').addEventListener('click', function() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var latitude = position.coords.latitude;
                  var longitude = position.coords.longitude;

                  document.getElementById('lokasi_latitude').value = latitude;
                  document.getElementById('lokasi_longitude').value = longitude;
              });
          } else {
              alert('Geolocation is not supported by this browser.');
          }
      });
  </script>
@endsection

