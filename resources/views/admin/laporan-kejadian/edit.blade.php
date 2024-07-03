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
                value="{{ isset($report->waktuKejadian['date']) ? $report->waktuKejadian['date'] : '' }}">
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
            <input hidden type="number" step="any" class="form-control form-control-sm" id="lokasi_longitude"
              name="lokasi_longitude" placeholder="Longitude" value="{{ $report->lokasi_longitude }}" required>
            <input hidden type="number" step="any" class="form-control form-control-sm" id="lokasi_latitude"
              name="lokasi_latitude" placeholder="Latitude" value="{{ $report->lokasi_latitude }}" required>

            <!-- Lokasi Longitude -->
            <div class="form-group">
              <label for="lokasi_longitude">Lokasi</label>
              <p>Klik pada lokasi yang sesuai</p>
              <br>
              <div id="map"></div>
            </div>
            <!-- <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control form-control-sm" id="status" name="status">
                <option value="On Process" {{ $report->status == 'On Process' ? 'selected' : '' }}>On Process</option>
                <option value="Valid" {{ $report->status == 'Valid' ? 'selected' : '' }}>Valid</option>
                <option value="Invalid" {{ $report->status == 'Invalid' ? 'selected' : '' }}>Invalid</option>
              </select>
            </div> -->
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

<script>
  // Initialize the map
  var map = L.map('map').setView([-7.5666, 110.8167], 13); // Coordinates for Surakarta

  // Set up the OpenStreetMap layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var marker;
  old_lat = document.getElementById('lokasi_latitude').value;
  old_lng = document.getElementById('lokasi_longitude').value;

  addMarker(old_lat, old_lng)

  // Function to add a marker
  function addMarker(lat, lng) {
    if (marker) {
      map.removeLayer(marker);
    }
    marker = L.marker([lat, lng]).addTo(map);
    marker.bindPopup(`Latitude: ${lat}, Longitude: ${lng}`).openPopup();
  }

  // Add marker on map click
  map.on('click', function (e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    addMarker(lat, lng);
    document.getElementById('lokasi_latitude').value = lat;
    document.getElementById('lokasi_longitude').value = lng;
    // Log the coordinates or send them to your server
    console.log(`Latitude: ${lat}, Longitude: ${lng}`);
  });
  document.getElementById('btnUseCurrentLocation').addEventListener('click', function () {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function (position) {
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