@extends('layouts-admin.default')

@section('content')

<!-- partial -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Laporan Assessment</h4>
            <p class="card-description">
              Daftar laporan assessment yang telah diunggah
            </p>
            <div class="table-responsive pt-3">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>
                      No
                    </th>
                    <th>
                      Jenis Kejadian
                    </th>
                    <th>
                      Lokasi
                    </th>
                    <th>
                      Waktu Kejadian
                    </th>
                    <th>
                      Terakhir Update
                    </th>
                    <th>
                      Status
                    </th>
                    <th>
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Banjir</td>
                    <td>Jakarta</td>
                    <td>2024-05-01 14:00</td>
                    <td>2024-05-01 15:00</td>
                    <td>
                      <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-document-id="3"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Gempa</td>
                    <td>Bandung</td>
                    <td>2024-05-02 10:30</td>
                    <td>2024-05-02 11:00</td>
                    <td>
                      <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-document-id="3"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Kebakaran</td>
                    <td>Surabaya</td>
                    <td>2024-05-03 09:15</td>
                    <td>2024-05-03 09:45</td>
                    <td>
                      <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-document-id="3"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Longsor</td>
                    <td>Yogyakarta</td>
                    <td>2024-05-04 18:00</td>
                    <td>2024-05-04 18:30</td>
                    <td>
                      <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-document-id="3"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
                    </td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>Banjir</td>
                    <td>Medan</td>
                    <td>2024-05-05 07:00</td>
                    <td>2024-05-05 08:00</td>
                    <td>
                      <p class="btn btn-warning btn-sm">Belum Terkonfirmasi</p>
                    </td>
                    <td>
                      <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal"
                        data-document-id="3"><i class="menu-icon mdi mdi-checkbox-multiple-marked-circle"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- content-wrapper ends -->

  <!-- Modal -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="detailModalLabel">Laporan Assesment</h3>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-sample">
            <h4 class="card-description">Umum</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label" for="incidentType">Jenis Kejadian</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="incidentType" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Keterangan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="incidentDetail" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tanggal</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="date" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                  <div class="col-sm-9">
                    <input class="form-control" class='form-control' id="kota" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Waktu</label>
                  <div class="col-sm-9">
                    <input class="form-control" class='form-control' id="time" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kecamatan</label>
                  <div class="col-sm-9">
                    <input class="form-control" class='form-control' id="kecamatan" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Provinsi</label>
                  <div class="col-sm-9">
                    <input class="form-control" class='form-control' id="provinsi" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Desa/Kelurahan</label>
                  <div class="col-sm-9">
                    <input class="form-control" class='form-control' id="desa" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="card-description">Informasi Umum</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Meninggal Dunia</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="passed" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Luka Berat</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="majorInj" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Luka Ringan</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="minorInj" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Hilang</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="missing" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Pengungsi/IDP's</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="refugeeRadios" id="refugeeRadios1" value=""
                          checked disabled>
                        Ada
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="refugeeRadios" id="refugeeRadios2"
                          value="option2" disabled>
                        Tidak
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Lokasi Pengungsian</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="refLocation" readonly>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jumlah</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="sum" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="card-description">Dampak Sarana & Prasarana</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rumah Tinggal</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="resident" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rusak Berat</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="majorDamage" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Rusak Ringan</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" id="minorDamage" readonly>
                  </div>
                </div>
              </div>
            </div>
            <h5>Akses Transportasi</h5>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jalan</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="streetRadios" id="streetRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="streetRadios" id="streetRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Jembatan</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="bridgeRadios" id="bridgeRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="bridgeRadios" id="bridgeRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Kendaraan Umum</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="vehicleRadios" id="vehicleRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="vehicleRadios" id="vehicleRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h5>Akses Transportasi</h5>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-sm-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="transportRadios" id="transportRadios1"
                          value="" checked disabled>
                        Telepon/Fax/Telex/Telegram
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="transportRadios" id="transportRadios2"
                          value="option2" disabled>
                        Telepon Selular
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="transportRadios" id="transportRadios3"
                          value="option2" disabled>
                        Kantor Pos
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="transportRadios" id="transportRadios4"
                          value="option2" disabled>
                        Internet
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <h5>Sarana Umum</h5>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">RS/Fasilitas Kesehatan</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="hospitalRadios" id="hospitalRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="hospitalRadios" id="hospitalRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Listrik</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="elecRadios" id="elecRadios1" value="" checked
                          disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="elecRadios" id="elecRadios2" value="option2"
                          disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Air</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="waterRadios" id="waterRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="waterRadios" id="waterRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Sekolah</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="schoolRadios" id="schoolRadios1" value=""
                          checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="schoolRadios" id="schoolRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tempat Ibadah</label>
                  <div class="col-sm-4">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="worshipFacRadios" id="worshipFacRadios1"
                          value="" checked disabled>
                        Berfungsi
                      </label>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="worshipFacRadios" id="worshipFacRadios2"
                          value="option2" disabled>
                        Tidak Berfungsi
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="card-description">Situasi Keamanan</h4>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="situation" readonly>
            </div>
            <hr>
            <h4 class="card-description">Tindakan Yang Sudah Dilakukan</h4>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="action" readonly>
            </div>
            <hr>
            <h4 class="card-description">Kebutuhan Mendesak</h4>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">PMI</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="PMINeeds" readonly>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Korban</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="victimNeeds" readonly>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="card-description">Kontak Person</h4>
            <div class="col-sm-12">
              <input type="text" class="form-control" id="contact" readonly>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Verify</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.querySelectorAll('.btn-info').forEach(button => {
      button.addEventListener('click', function (event) {
        event.preventDefault();
        const documentId = this.getAttribute('data-document-id');

        // Fetch data for the specific documentId (this can be done via an AJAX request)
        // For this example, we'll use static data for demonstration purposes.
        const data = {
          1: {
            incidentType: 'Bencana Alam',
            incidentDetail: 'Banjir',
            date: '2024-05-01',
            kota: 'Jakarta Pusat',
            time: '14:00',
            kecamatan: 'Tanah Abang',
            provinsi: 'DKI Jakarta',
            desa: 'Bendungan Hilir',
            passed: '0',
            majorInj: '2',
            minorInj: '10',
            missing: '1',
            refLocation: 'Masjid At-Taqwa',
            sum: '13',
            resident: '-',
            majorDamage: '-',
            minorDamage: '-',
            situation: 'Lokasi aman dan terkendali',
            action: 'Korban terluka sudah diberi penanganan pertama',
            PMINeeds: 'Ambulance dan tenaga medis',
            victimNeeds: 'Bantuan sembako',
            contact: 'Icha/08123456789',
            status: 'Belum Terkonfirmasi'
          },

          2: {
            incidentType: 'Bencana Alam',
            incidentDetail: 'Gempa',
            date: '2024-05-02',
            kota: 'Bandung',
            time: '10:30',
            kecamatan: 'Buah Batu',
            provinsi: 'Jawa Barat',
            desa: 'Margasari',
            passed: '0',
            majorInj: '15',
            minorInj: '20',
            missing: '0',
            refLocation: 'Masjid Nur',
            sum: '35',
            resident: '50',
            majorDamage: '23',
            minorDamage: '27',
            situation: 'Lokasi aman dan terkendali',
            action: 'Korban terluka sudah diberi penanganan pertama',
            PMINeeds: 'Ambulance dan tenaga medis',
            victimNeeds: 'Bantuan sembako',
            contact: 'Icha/08123456789',
            status: 'Belum Terkonfirmasi'
          },

          3: {
            incidentType: 'Lain-lain',
            incidentDetail: 'kebakaran',
            date: '2024-05-03',
            kota: 'Surabaya',
            time: '09:15',
            kecamatan: 'Buah Batu',
            provinsi: 'Jawa Timur',
            desa: 'Margasari',
            passed: '0',
            majorInj: '7',
            minorInj: '21',
            missing: '0',
            refLocation: 'SD Negeri 1',
            sum: '28',
            resident: '15',
            majorDamage: '5',
            minorDamage: '10',
            situation: 'Lokasi aman dan terkendali',
            action: 'Korban terluka sudah diberi penanganan pertama',
            PMINeeds: 'Ambulance dan tenaga medis',
            victimNeeds: 'Bantuan sembako',
            contact: 'Icha/08123456789',
            status: 'Belum Terkonfirmasi'
          },

          4: {
            incidentType: 'Bencana Alam',
            incidentDetail: 'Longsor',
            date: '2024-05-04',
            kota: 'Yogyakarta',
            time: '18:00',
            kecamatan: 'Jetis',
            provinsi: 'DI Yogyakarta',
            desa: 'Trimulyo',
            passed: '0',
            majorInj: '4',
            minorInj: '17',
            missing: '2',
            refLocation: 'SMP Negeri 2 Jetis',
            sum: '23',
            resident: '16',
            majorDamage: '10',
            minorDamage: '6',
            situation: 'Lokasi aman dan terkendali',
            action: 'Korban terluka sudah diberi penanganan pertama',
            PMINeeds: 'Ambulance dan tenaga medis',
            victimNeeds: 'Bantuan sembako',
            contact: 'Icha/08123456789',
            status: 'Belum Terkonfirmasi'
          },

          5: {
            incidentType: 'Bencana Alam',
            incidentDetail: 'Banjir',
            date: '2024-05-05',
            kota: 'Medan',
            time: '07:00',
            kecamatan: 'Buah Batu',
            provinsi: 'Sumatera Utara',
            desa: 'Margasari',
            passed: '0',
            majorInj: '15',
            minorInj: '20',
            missing: '0',
            refLocation: 'Balai Desa',
            sum: '35',
            resident: '50',
            majorDamage: '23',
            minorDamage: '27',
            situation: 'Lokasi aman dan terkendali',
            action: 'Korban terluka sudah diberi penanganan pertama',
            PMINeeds: 'Ambulance dan tenaga medis',
            victimNeeds: 'Bantuan sembako',
            contact: 'Icha/08123456789',
            status: 'Belum Terkonfirmasi'
          }

          // Add other document data here
        };

        console.log(data[documentId]);

        // Fill the form with data
        if (data[documentId]) {
          document.getElementById('incidentType').value = data[documentId].incidentType;
          document.getElementById('incidentDetail').value = data[documentId].incidentDetail;
          document.getElementById('date').value = data[documentId].date;
          document.getElementById('kota').value = data[documentId].kota;
          document.getElementById('time').value = data[documentId].time;
          document.getElementById('kecamatan').value = data[documentId].kecamatan;
          document.getElementById('provinsi').value = data[documentId].provinsi;
          document.getElementById('desa').value = data[documentId].desa;
          document.getElementById('passed').value = data[documentId].passed;
          document.getElementById('majorInj').value = data[documentId].majorInj;
          document.getElementById('minorInj').value = data[documentId].minorInj;
          document.getElementById('missing').value = data[documentId].missing;
          document.getElementById('refLocation').value = data[documentId].refLocation;
          document.getElementById('sum').value = data[documentId].sum;
          document.getElementById('majorDamage').value = data[documentId].majorDamage;
          document.getElementById('minorDamage').value = data[documentId].minorDamage;
          document.getElementById('situation').value = data[documentId].situation;
          document.getElementById('action').value = data[documentId].action;
          document.getElementById('PMINeeds').value = data[documentId].PMINeeds;
          document.getElementById('victimNeeds').value = data[documentId].victimNeeds;
          document.getElementById('contact').value = data[documentId].contact;



          document.getElementById('status').value = data[documentId].status;
        }
      });
    });
  </script>

  @endsection