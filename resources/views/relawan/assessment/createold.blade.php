@extends('layouts-relawan.default')

@if($assessment)
<!-- Modal -->
<div class="modal show" id="assessmentModal" tabindex="-1" role="dialog" aria-labelledby="assessmentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="assessmentModalLabel">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sudah ada laporan assessment yang dibuat dari laporan kejadian ini. Laporan assessment hanya dapat dibuat satu kali. Silahkan melakukan edit untuk mengubah informasi.
      </div>
      <div class="modal-footer">
        <a href="{{ route('relawan-laporankejadian') }}" class="btn btn-secondary">OK</a>
        <a href="{{ route('edit-assessment', $assessment->id_assessment) }}" class="btn btn-primary">Edit Assessment</a>
      </div>
    </div>
  </div>
</div>
@endif


@section('content')
    <!-- <div class="main-panel"> -->
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Assessment</h4>
                            @php
                                $defaultDateTime = now()->format('Y-m-d\TH:i');
                            @endphp
                            <form action="{{ url('/relawan/assessment/store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="kategori_kejadian">Kategori Kejadian</label>
                                    <input type="text" class="form-control form-control-sm" id="kategori_kejadian" name="kategori_kejadian" value="{{ $report->jenisKejadian->nama_kejadian ?? '' }}" readonly>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="id_jeniskejadian">Jenis Kejadian</label>
                                    <select name="id_jeniskejadian" id="id_jeniskejadian" class="form-control form-control-sm" required>
                                        <option value="">- Pilih Jenis Kejadian -</option>
                                        @foreach ($jeniskejadian as $jenis)
                                            <option value="{{ $jenis->id_jeniskejadian }}">{{ $jenis->nama_kejadian }}</option>
                                        @endforeach
                                    </select>
                                </div> -->
                                <!-- Bagian Tanggal Kejadian -->
                                <div class="form-group">
                                    <label for="tanggal_kejadian">Tanggal Kejadian</label>
                                    <input type="datetime-local" class="form-control form-control-sm" id="tanggal_kejadian" name="tanggal_kejadian" value="{{ \Carbon\Carbon::parse($report->tanggal_kejadian)->format('Y-m-d\TH:i') }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control form-control-sm" id="keterangan" name="keterangan" placeholder="Keterangan" readonly>{{ $report->keterangan }}</textarea>
                                </div>
                                <!-- !-- Bagian Update 
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="datetime-local" class="form-control form-control-sm" id="update" name="update" value="{{ $defaultDateTime }}" required>
                                </div> -->
                                
                                <!-- Bagian Update -->
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="textarea" class="form-control form-control-sm" id="update" name="update" required>
                                </div>
                                <!-- Bagian Lokasi -->
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control form-control-sm" id="lokasi" name="lokasi" placeholder="Lokasi Kejadian" required>
                                </div>
                                <!-- Bagian File Upload -->
                                <!-- <div class="form-group">
                                    <label>Unggah Berkas</label>
                                    <input type="file" name="files[]" class="file-upload-default" multiple>
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Unggah Gambar">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Unggah</button>
                                        </span>
                                    </div>
                                </div> -->
                                <!-- Bagian Dukungan Internasional -->
                                <div class="form-group">
                                    <label for="dukungan_internasional">Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="form-control" id="dukungan_internasional" name="dukungan_internasional" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="akses_ke_lokasi">Akses Menuju Lokasi</label>
                                    <select class="form-control" id="akses_ke_lokasi" name="akses_ke_lokasi" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Accessible">Accessible</option>
                                        <option value="Not Accessible">Not Accessible</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="kebutuhan">Kebutuhan</label>
                                    <textarea class="form-control form-control-sm" id="kebutuhan" name="kebutuhan" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="giat_pemerintah">Giat Pemerintah</label>
                                    <select class="form-control" id="giat_pemerintah" name="giat_pemerintah" required>
                                        <option value="">- Pilih -</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="hambatan">Hambatan</label>
                                    <textarea class="form-control form-control-sm" id="hambatan" name="hambatan" required></textarea>
                                </div>
                                <!-- Bagian Personil -->
                                <div class="form-group">
                                    <button type="button" id="personil" class="btn btn-primary me-2">Input Personil</button>
                                </div>

                                <div id="form_personil" style="display:none;">
                                    <p class="card-description" id="subtitle">Input Personil</p>
                                    <!-- id_personil (personil) -->
                                    <!-- <div class="form-group">
                                        <label for="pengurus">Pengurus</label>
                                        <input type="text" class="form-control form-control-sm" id="pengurus" name="pengurus">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_kabkota">Staf Markas Kab/Kota</label>
                                        <input type="text" class="form-control form-control-sm" id="staff_markas_kabkota" name="staff_markas_kabkota">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_prov">Staf Markas Provinsi</label>
                                        <input type="text" class="form-control form-control-sm" id="staff_markas_prov" name="staff_markas_prov">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_pusat">Staf Markas Pusat</label>
                                        <input type="text" class="form-control form-control-sm" id="staff_markas_pusat" name="staff_markas_pusat">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_kabkot">Relawan PMI Kab/Kota</label>
                                        <input type="text" class="form-control form-control-sm" id="relawan_pmi_kabkot" name="relawan_pmi_kabkot">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_prov">Relawan PMI Provinsi</label>
                                        <input type="text" class="form-control form-control-sm" id="relawan_pmi_prov" name="relawan_pmi_prov">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_linprov">Relawan Lintas Provinsi</label>
                                        <input type="text" class="form-control form-control-sm" id="relawan_pmi_linprov" name="relawan_pmi_linprov">
                                    </div>
                                    <div class="form-group">
                                        <label for="sukarelawan_sp">Sukarelawan SIP</label>
                                        <input type="text" class="form-control form-control-sm" id="sukarelawan_sp" name="sukarelawan_sp">
                                    </div> -->

                                    <p class="card-description" id="subtitle">Spesialis</p>
                                    <!-- id_tsr (tsr) -->
                                    <!-- <div class="form-group">
                                        <label for="medis">Medis</label>
                                        <input type="text" class="form-control form-control-sm" id="medis" name="medis">
                                    </div>
                                    <div class="form-group">
                                        <label for="paramedis">Paramedis</label>
                                        <input type="text" class="form-control form-control-sm" id="paramedis" name="paramedis">
                                    </div>
                                    <div class="form-group">
                                        <label for="relief">Relief</label>
                                        <input type="text" class="form-control form-control-sm" id="relief" name="relief">
                                    </div>
                                    <div class="form-group">
                                        <label for="logistik">Logistik</label>
                                        <input type="text" class="form-control form-control-sm" id="logistik" name="logistik">
                                    </div>
                                    <div class="form-group">
                                        <label for="watsan">Watsan</label>
                                        <input type="text" class="form-control form-control-sm" id="watsan" name="watsan">
                                    </div>
                                    <div class="form-group">
                                        <label for="it_telkom">IT Telkom</label>
                                        <input type="text" class="form-control form-control-sm" id="it_telkom" name="it_telkom">
                                    </div>
                                    <div class="form-group">
                                        <label for="sheltering">Sheltering</label>
                                        <input type="text" class="form-control form-control-sm" id="sheltering" name="sheltering">
                                    </div> -->

                                    <p class="card-description" id="subtitle">Alat Utama</p>
                                    <!-- id_alat_tdb (alat_tdb) -->
                                    <!-- <div class="form-group">
                                        <label for="kend_ops">Kend Ops</label>
                                        <input type="text" class="form-control form-control-sm" id="kend_ops" name="kend_ops">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_angkut">Truk Angkutan</label>
                                        <input type="text" class="form-control form-control-sm" id="truk_angkut" name="truk_angkut">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_tanki">Truk Tanki</label>
                                        <input type="text" class="form-control form-control-sm" id="truk_tanki" name="truk_tanki">
                                    </div>
                                    <div class="form-group">
                                        <label for="double_cabin">Double Cabin</label>
                                        <input type="text" class="form-control form-control-sm" id="double_cabin" name="double_cabin">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_du">Alat DU</label>
                                        <input type="text" class="form-control form-control-sm" id="alat_du" name="alat_du">
                                    </div>
                                    <div class="form-group">
                                        <label for="ambulans">Ambulans</label>
                                        <input type="text" class="form-control form-control-sm" id="ambulans" name="ambulans">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_watsan">Alat Watsan</label>
                                        <input type="text" class="form-control form-control-sm" id="alat_watsan" name="alat_watsan">
                                    </div>
                                    <div class="form-group">
                                        <label for="rs_lapangan">RS Lapangan</label>
                                        <input type="text" class="form-control form-control-sm" id="rs_lapangan" name="rs_lapangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_pkdd">Alat PKDD</label>
                                        <input type="text" class="form-control form-control-sm" id="alat_pkdd" name="alat_pkdd">
                                    </div>
                                    <div class="form-group">
                                        <label for="gudang_lapangan">Gudang Lapangan</label>
                                        <input type="text" class="form-control form-control-sm" id="gudang_lapangan" name="gudang_lapangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="posko_aju">Posko Aju</label>
                                        <input type="text" class="form-control form-control-sm" id="posko_aju" name="posko_aju">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_it_lapangan">Alat IT/Tel Lapangan</label>
                                        <input type="text" class="form-control form-control-sm" id="alat_it_lapangan" name="alat_it_lapangan">
                                    </div> -->
                                </div>

                                <!-- Evakuasi Korban -->
                                <!-- <h4 class="card-title">Evakuasi Korban</h4>
                                <div class="form-group">
                                    <label for="luka_ringanberat">Luka Ringan dan Berat</label>
                                    <input type="text" class="form-control form-control-sm" id="luka_ringanberat" name="luka_ringanberat">
                                </div>
                                <div class="form-group">
                                    <label for="meninggal">Meninggal</label>
                                    <input type="text" class="form-control form-control-sm" id="meninggal" name="meninggal">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan_evakuasi">Keterangan</label>
                                    <textarea class="form-control form-control-sm" id="keterangan_evakuasi" name="keterangan_evakuasi" placeholder="keterangan"></textarea>
                                </div> -->

                                <!-- Layanan Korban -->
                                <h4 class="card-title">Layanan Korban</h4>
                                <!-- <div class="form-group">
                                    <label for="distribusi">Distribusi</label>
                                    <input type="text" class="form-control form-control-sm" id="distribusi" name="distribusi">
                                </div>
                                <div class="form-group">
                                    <label for="dapur_umum">Dapur Umum</label>
                                    <input type="text" class="form-control form-control-sm" id="dapur_umum" name="dapur_umum">
                                </div>
                                <div class="form-group">
                                    <label for="evakuasi">Evakuasi</label>
                                    <input type="text" class="form-control form-control-sm" id="evakuasi" name="evakuasi">
                                </div>
                                <div class="form-group">
                                    <label for="layanan_kesehatan">Layanan Kesehatan</label>
                                    <input type="text" class="form-control form-control-sm" id="layanan_kesehatan" name="layanan_kesehatan">
                                </div> -->

                                <!-- Petugas Narahubung -->
                                <!-- <h4 class="card-title">Petugas Narahubung</h4>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_lengkap" id="nama_lengkap">
                                </div>
                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <input type="text" class="form-control form-control-sm" name="posisi" id="posisi">
                                </div>
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="phone" class="form-control form-control-sm" name="kontak" id="kontak">
                                </div> -->

                                <!-- Petugas Posko -->
                                <!-- <h4 class="card-title">Petugas Posko</h4>
                                <div class="form-group">
                                    <label for="nama_lengkap_posko">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-sm" name="nama_lengkap_posko" id="nama_lengkap_posko">
                                </div>
                                <div class="form-group">
                                    <label for="kontak_posko">Kontak</label>
                                    <input type="text" class="form-control form-control-sm" name="kontak_posko" id="kontak_posko">
                                </div> -->

                                <!-- Bagian Dampak -->
                                <!-- <h4 class="card-title">Dampak</h4>
                                <div class="form-group">
                                    <label for="kk">Jumlah KK</label>
                                    <input type="number" class="form-control form-control-sm" id="kk" name="kk" required>
                                </div>
                                <div class="form-group">
                                    <label for="jiwa">Jumlah Jiwa</label>
                                    <input type="number" class="form-control form-control-sm" id="jiwa" name="jiwa" required>
                                </div>
                                <div class="form-group">
                                    <label for="luka_berat">Luka Berat</label>
                                    <input type="number" class="form-control form-control-sm" id="luka_berat" name="luka_berat" required>
                                </div>
                                <div class="form-group">
                                    <label for="luka_ringan">Luka Ringan</label>
                                    <input type="number" class="form-control form-control-sm" id="luka_ringan" name="luka_ringan" required>
                                </div>
                                <div class="form-group">
                                    <label for="meninggal">Meninggal</label>
                                    <input type="number" class="form-control form-control-sm" id="meninggal" name="meninggal" required>
                                </div>
                                <div class="form-group">
                                    <label for="hilang">Hilang</label>
                                    <input type="number" class="form-control form-control-sm" id="hilang" name="hilang" required>
                                </div>
                                <div class="form-group">
                                    <label for="mengungsi">Mengungsi</label>
                                    <input type="number" class="form-control form-control-sm" id="mengungsi" name="mengungsi" required>
                                </div> -->

                                <!-- Bagian Kerusakan Rumah -->
                                <h4 class="card-title">Kerusakan Rumah</h4>
                                <!-- <div class="form-group">
                                    <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                    <input type="number" class="form-control form-control-sm" id="rusak_berat" name="rusak_berat" required>
                                </div>
                                <div class="form-group">
                                    <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                    <input type="number" class="form-control form-control-sm" id="rusak_sedang" name="rusak_sedang" required>
                                </div>
                                <div class="form-group">
                                    <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                    <input type="number" class="form-control form-control-sm" id="rusak_ringan" name="rusak_ringan" required>
                                </div> -->

                                <!-- Bagian Kerusakan Fasilitas Sosial -->
                                <h4 class="card-title">Kerusakan Fasilitas Sosial</h4>
                                <!-- <div class="form-group">
                                    <label for="sekolah">Kerusakan Sekolah</label>
                                    <input type="number" class="form-control form-control-sm" id="sekolah" name="sekolah" required>
                                </div>
                                <div class="form-group">
                                    <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                    <input type="number" class="form-control form-control-sm" id="tempat_ibadah" name="tempat_ibadah" required>
                                </div>
                                <div class="form-group">
                                    <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                    <input type="number" class="form-control form-control-sm" id="rumah_sakit" name="rumah_sakit" required>
                                </div>
                                <div class="form-group">
                                    <label for="pasar">Kerusakan Pasar</label>
                                    <input type="number" class="form-control form-control-sm" id="pasar" name="pasar" required>
                                </div>
                                <div class="form-group">
                                    <label for="gedung_pemerintah">Kerusakan Gedung Pemerintah</label>
                                    <input type="number" class="form-control form-control-sm" id="gedung_pemerintah" name="gedung_pemerintah" required>
                                </div>
                                <div class="form-group">
                                    <label for="lain_lain">Kerusakan Lain-lain</label>
                                    <input type="number" class="form-control form-control-sm" id="lain_lain" name="lain_lain" required>
                                </div> -->

                                <!-- Bagian Kerusakan Infrastruktur -->
                                <!-- <h4 class="card-title">Kerusakan Infrastruktur</h4>
                                <div class="form-group">
                                    <label for="desc_kerusakan">Deskripsi Kerusakan Infrastruktur</label>
                                    <textarea class="form-control form-control-sm" id="desc_kerusakan" name="desc_kerusakan" required></textarea>
                                </div> -->

                                <!-- Bagian Pengungsian -->
                                <!-- <h4 class="card-title">Pengungsian</h4>
                                <div class="form-group">
                                    <label for="nama_lokasi">Nama Lokasi Pengungsian</label>
                                    <input type="text" class="form-control form-control-sm" id="nama_lokasi" name="nama_lokasi" required>
                                </div>
                                <div class="form-group">
                                    <label for="laki_laki">Jumlah Laki-laki</label>
                                    <input type="number" class="form-control form-control-sm" id="laki_laki" name="laki_laki" required>
                                </div>
                                <div class="form-group">
                                    <label for="perempuan">Jumlah Perempuan</label>
                                    <input type="number" class="form-control form-control-sm" id="perempuan" name="perempuan" required>
                                </div>
                                <div class="form-group">
                                    <label for="kurang_dari_5">Jumlah Anak di Bawah 5 Tahun</label>
                                    <input type="number" class="form-control form-control-sm" id="kurang_dari_5" name="kurang_dari_5" required>
                                </div>
                                <div class="form-group">
                                    <label for="atr_5_sampai_18">Jumlah Anak 5-18 Tahun</label>
                                    <input type="number" class="form-control form-control-sm" id="atr_5_sampai_18" name="atr_5_sampai_18" required>
                                </div>
                                <div class="form-group">
                                    <label for="lebih_dari_18">Jumlah Dewasa di Atas 18 Tahun</label>
                                    <input type="number" class="form-control form-control-sm" id="lebih_dari_18" name="lebih_dari_18" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah Total Pengungsi</label>
                                    <input type="number" class="form-control form-control-sm" id="jumlah" name="jumlah" required>
                                </div> -->

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button type="button" class="btn btn-light" onclick="window.history.back();">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('personil').addEventListener('click', function() {
            // Dapatkan elemen form
            var formPersonil = document.getElementById('form_personil');

            // Toggle display
            if (formPersonil.style.display === 'none') {
                formPersonil.style.display = 'block';
            } else {
                formPersonil.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('dampak').addEventListener('click', function() {
            // Dapatkan elemen form
            var formJumlahKK = document.getElementById('form_jumlah_kk');

            // Toggle display
            if (formJumlahKK.style.display === 'none') {
                formJumlahKK.style.display = 'block';
            } else {
                formJumlahKK.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tambah_pengungsian').addEventListener('click', function() {
            // Ambil elemen form pengungsian
            var formPengungsian = document.getElementById('form_pengungsian');
            // Klon elemen form pengungsian
            var clone = formPengungsian.cloneNode(true);
            // Tampilkan form klon
            clone.style.display = 'block';
            // Hapus atribut id agar tidak duplikat
            clone.removeAttribute('id');
            // Tambahkan form klon ke dalam form area
            document.getElementById('form_area').appendChild(clone);
            var cancelBtn = document.createElement('button');
            cancelBtn.setAttribute('type', 'button');
            cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
            cancelBtn.textContent = 'Cancel';
            // Tambahkan event listener untuk tombol "Cancel"
            cancelBtn.addEventListener('click', function() {
                // Hapus form yang baru saja ditambahkan
                clone.remove();
                // Hapus tombol "Cancel"
                cancelBtn.remove();
                // Tampilkan kembali tombol "Tambah Pengungsian"
                document.getElementById('tambah_pengungsian').style.display = 'block';
            });
            // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
            document.getElementById('form_area').appendChild(cancelBtn);
            // Sembunyikan tombol "Tambah Pengungsian"
            document.getElementById('tambah_pengungsian').style.display = 'none';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tambah_cp').addEventListener('click', function() {
            // Ambil elemen form pengungsian
            var formPengungsian = document.getElementById('form_cp');
            // Klon elemen form pengungsian
            var clone = formPengungsian.cloneNode(true);
            // Tampilkan form klon
            clone.style.display = 'block';
            // Hapus atribut id agar tidak duplikat
            clone.removeAttribute('id');
            // Tambahkan form klon ke dalam form area
            document.getElementById('form_area_cp').appendChild(clone);
            var cancelBtn = document.createElement('button');
            cancelBtn.setAttribute('type', 'button');
            cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
            cancelBtn.textContent = 'Cancel';
            // Tambahkan event listener untuk tombol "Cancel"
            cancelBtn.addEventListener('click', function() {
                // Hapus form yang baru saja ditambahkan
                clone.remove();
                // Hapus tombol "Cancel"
                cancelBtn.remove();
                // Tampilkan kembali tombol "Tambah Pengungsian"
                document.getElementById('tambah_cp').style.display = 'block';
            });
            // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
            document.getElementById('form_area_cp').appendChild(cancelBtn);
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('tambah_petugas_posko').addEventListener('click', function() {
            // Ambil elemen form pengungsian
            var formPengungsian = document.getElementById('form_petugas');
            // Klon elemen form pengungsian
            var clone = formPengungsian.cloneNode(true);
            // Tampilkan form klon
            clone.style.display = 'block';
            // Hapus atribut id agar tidak duplikat
            clone.removeAttribute('id');
            // Tambahkan form klon ke dalam form area
            document.getElementById('form_area_petugas').appendChild(clone);
            var cancelBtn = document.createElement('button');
            cancelBtn.setAttribute('type', 'button');
            cancelBtn.classList.add('btn', 'btn-danger', 'me-2');
            cancelBtn.textContent = 'Cancel';
            // Tambahkan event listener untuk tombol "Cancel"
            cancelBtn.addEventListener('click', function() {
                // Hapus form yang baru saja ditambahkan
                clone.remove();
                // Hapus tombol "Cancel"
                cancelBtn.remove();
                // Tampilkan kembali tombol "Tambah Pengungsian"
                document.getElementById('tambah_petugas_posko').style.display = 'block';
            });
            // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
            document.getElementById('form_area_petugas').appendChild(cancelBtn);
        });
        document.getElementById('tambah_petugas_narahubung').addEventListener('click', function() {
            // Ambil elemen form pengungsian
            var formPengungsian = document.getElementById('form_cp');
            // Klon elemen form pengungsian
            var clone = formPengungsian.cloneNode(true);
            // Tampilkan form klon
            clone.style.display = 'block';
            // Hapus atribut id agar tidak duplikat
            clone.removeAttribute('id');
            // Tambahkan form klon ke dalam form area
            document.getElementById('form_area_cp').appendChild(clone);
        });
    });
</script>
