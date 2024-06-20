@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Situasi</h4>

                            <form action="/relawan/lapsit/store" method="post" class="forms-sample">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="id_jeniskejadian">Kejadian Bencana</label>
                                    <!--select name="id_jeniskejadian" id="id_jeniskejadian" class="js-example-basic-single w-100" required>
                                        @foreach($jenisKejadian as $kejadian) 
                                        <option value="{{ $kejadian-> id_jeniskejadian }}">{{ $kejadian-> nama_kejadian }}</option>
                                        @endforeach
                                    </select-->
                                    <select name="id_jeniskejadian" id="id_jeniskejadian" class="form-control form-control-sm" placeholder="- Pilih Jenis Kejadian -" required>
                                        <option value="">- Pilih Jenis Kejadian -</option>
                                        @foreach ($jenisKejadian as $jenis)
                                        <option value="{{ $jenis-> id_jeniskejadian }}">{{ $jenis-> nama_kejadian }}</option>
                                        @endforeach
                                    </select>

                                    <!--input type="text" class="form-control" name="nama_kejadian" id="nama_kejadian" placeholder="Nama Kejadian"-->
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_kejadian">Waktu Kejadian</label>
                                    <input type="date" class="form-control" name="tanggal_kejadian" id="tanggal_kejadian" placeholder="Waktu Kejadian">
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" name="update" id="update" placeholder="Update">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="file_dokumentasi" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="js-example-basic-single w-100" name="dukungan_internasional">
                                        <option value="AL">Ya</option>
                                        <option value="WY">Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="gambaran_situasi">Gambaran Umum Situasi</label>
                                    <input type="text" class="form-control" name="gambaran_situasi" id="gambaran_situasi" placeholder="Deskripsi Situasi">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="js-example-basic-single w-100" name="akses_ke_lokasi">
                                        <option value="AL">Accessible</option>
                                        <option value="WY">Not Accessible</option>
                                    </select>
                                </div>
                                {{-- Input Dampak --}}
                                <div class="form-group">
                                    <button type="button" id="dampak" class="btn btn-primary me-2">Input Dampak</button>
                                </div>

                                <div id="form_jumlah_kk" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Korban Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="kk">Jumlah KK</label>
                                        <input type="number" class="form-control" id="kk" name="kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jiwa">Jumlah Orang</label>
                                        <input type="number" class="form-control" id="jiwa" name="jiwa">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" id="luka_berat" name="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_ringan">Luka Ringan</label>
                                        <input type="number" class="form-control" id="luka_ringan" name="luka_ringan">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Meninggal</label>
                                        <input type="number" class="form-control" id="meninggal" name="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hilang">Hilang</label>
                                        <input type="number" class="form-control" id="hilang" name="hilang">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" id="mengungsi" name="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Fasilitas/Rumah Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" id="rusak_berat" name="rusak_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" id="rusak_sedang" name="rusak_sedang">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                        <input type="number" class="form-control" id="rusak_ringan" name="rusak_ringan">
                                    </div>
                                    <div class="form-group">
                                        <label for="sekolah">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" id="sekolah" name="sekolah">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" id="tempat_ibadah" name="tempat_ibadah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control" id="rumah_sakit" name="rumah_sakit">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasar">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" id="pasar" name="pasar">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" id="gedung_pemerintah" name="gedung_pemerintah">
                                    </div>
                                    <div class="form-group">
                                        <label for="lain_lain">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" id="lain_lain" name="lain_lain">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_kerusakan">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" id="desc_kerusakan" name="desc_kerusakan" placeholder="Deskripsi Kerusakan">
                                    </div>
                                </div>

                                {{-- Tambah Pengungsian --}}

                                <div class="form-group">
                                    <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                        Pengungsian</button>
                                </div>

                                <div id="form_area">
                                    <div id="form_pengungsian" style="display:none;">
                                        <p class="card-description" id="subtitle">Pengungsian</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" class="form-control" id="nama_lokasi" name="nama_lokasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">KK</label>
                                            <input type="number" class="form-control" id="jumlah_kk" name="jumlah_kk">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Jiwa</label>
                                            <input type="number" class="form-control" id="jumlah_orang" name="jumlah_orang">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki">Laki-Laki</label>
                                            <input type="number" class="form-control" id="laki_laki" name="laki_laki">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan">Perempuan</label>
                                            <input type="number" class="form-control" id="perempuan" name="perempuan">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" id="kurang_dari_5" name="kurang_dari_5">
                                        </div>
                                        <div class="form-group">
                                            <label for="antara_5_18">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" id="antara_5_18" name="antara_5_18">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                            <input type="number" class="form-control" id="lebih_dari_18" name="lebih_dari_18">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                                        </div>
                                    </div>
                                </div>

                                {{-- Personil --}}
                                <div class="form-group">
                                    <button type="button" id="personil" class="btn btn-primary me-2">Input
                                        Personil</button>
                                </div>

                                <div id="form_personil" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Input Personil
                                    </p>
                                    <div class="form-group">
                                        <label for="pengurus">Pengurus</label>
                                        <input type="number" class="form-control" id="pengurus" name="pengurus">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_kabkot">Staf Markas Kab/Kota</label>
                                        <input type="number" class="form-control" id="staff_markas_kabkot" name="staff_markas_kabkot">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_prov">Staf Markas Provinsi</label>
                                        <input type="number" class="form-control" id="staff_markas_prov" name="staff_markas_prov">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_pusat">Staf Markas Pusat</label>
                                        <input type="number" class="form-control" id="staff_markas_pusat" name="staff_markas_pusat">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_kabkot">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="relawan_pmi_kabkot" name="relawan_pmi_kabkot">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_prov">Relawan PMI Provinsi</label>
                                        <input type="number" class="form-control" id="relawan_pmi_prov" name="relawan_pmi_prov">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_linprov">Relawan Lintas Provinsi</label>
                                        <input type="number" class="form-control" id="relawan_pmi_linprov" name="relawan_pmi_linprov">
                                    </div>
                                    <div class="form-group">
                                        <label for="sukarelawan_sp">Sukarelawan Spesialis</label>
                                        <input type="number" class="form-control" id="sukarelawan_sp" name="sukarelawan_sp">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Spesialis
                                    </p>
                                    <div class="form-group">
                                        <label for="medis">Medis</label>
                                        <input type="number" class="form-control" id="medis" name="medis">
                                    </div>
                                    <div class="form-group">
                                        <label for="paramedis">Paramedis</label>
                                        <input type="number" class="form-control" id="paramedis" name="paramedis">
                                    </div>
                                    <div class="form-group">
                                        <label for="relief">Relief</label>
                                        <input type="number" class="form-control" id="relief" name="relief">
                                    </div>
                                    <div class="form-group">
                                        <label for="logistik">Logistik</label>
                                        <input type="number" class="form-control" id="logistik" name="logistik">
                                    </div>
                                    <div class="form-group">
                                        <label for="watsan">Watsan</label>
                                        <input type="number" class="form-control" id="watsan" name="watsan">
                                    </div>
                                    <div class="form-group">
                                        <label for="it_telekom">IT Telekom</label>
                                        <input type="number" class="form-control" id="it_telekom" name="it_telekom">
                                    </div>
                                    <div class="form-group">
                                        <label for="sheltering">Sheltering</label>
                                        <input type="number" class="form-control" id="sheltering" name="sheltering">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Alat Utama
                                    </p>
                                    <div class="form-group">
                                        <label for="kend_ops">Kend. Ops</label>
                                        <input type="number" class="form-control" id="kend_ops" name="kend_ops">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_angkut">Truk Angkutan</label>
                                        <input type="number" class="form-control" id="truk_angkut" name="truk_angkut">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_tanki">Truk Tangki</label>
                                        <input type="number" class="form-control" id="truk_tanki" name="truk_tanki">
                                    </div>
                                    <div class="form-group">
                                        <label for="double_cabin">Double Cabin</label>
                                        <input type="number" class="form-control" id="double_cabin" name="double_cabin">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_du">Alat DU</label>
                                        <input type="number" class="form-control" id="alat_du" name="alat_du">
                                    </div>
                                    <div class="form-group">
                                        <label for="ambulans">Ambulans</label>
                                        <input type="number" class="form-control" id="ambulans" name="ambulans">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_watsan">Alat Watsan</label>
                                        <input type="number" class="form-control" id="alat_watsan" name="alat_watsan">
                                    </div>
                                    <div class="form-group">
                                        <label for="rs_lapangan">RS Lapangan</label>
                                        <input type="number" class="form-control" id="rs_lapangan" name="rs_lapangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_pkdd">Alat PKDD</label>
                                        <input type="number" class="form-control" id="alat_pkdd" name="alat_pkdd">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_lapangan">Gudang Lapangan</label>
                                        <input type="number" class="form-control" id="gedung_lapangan" name="gedung_lapangan">
                                    </div>
                                    <div class="form-group">
                                        <label for="posko_aju">Posko Aju</label>
                                        <input type="number" class="form-control" id="mengungsi" name="posko_aju">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_it_lapangan">Alat IT/Tel Lapangan</label>
                                        <input type="number" class="form-control" id="alat_it_lapangan" name="alat_it_lapangan">
                                    </div>
                                </div>


                                <h4 class="card-title">Evakuasi Korban Luka</h4>
                                <div class="form-group">
                                    <label for="luka_ringanberat">Luka Ringan/Berat</label>
                                    <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat">

                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="rincian korban luka">
                                </div>
                                <div class="form-group">
                                    <label for="korban_meninggal">Meninggal</label>
                                    <input type="number" class="form-control" id="korban_meninggal" name="korban_meninggal">

                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="rincian korban meninggal">
                                </div>
                                <!--div>
                                    <p class="card-description">Meninggal</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Distribusi Non-Food Item</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Layanan Kesehatan</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Layanan Air Bersih</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Lain Lain</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div-->
                                <h4 class="card-title">Layanan Korban Bencana</h4>
                                <!--div class="form-group">
                                    <label for="assessment">Assessment</label>
                                    <input type="text" class="form-control" id="assessment" name="assessment" placeholder="rincian assessment">
                                </div-->
                                <div class="form-group">
                                    <label>Assessment</label>
                                    <select class="js-example-basic-single w-100" id="assessment" name="assessment">
                                        <option value="AL">On Process</option>
                                        <option value="WY">Aktif</option>
                                        <option value="WY">Selesai</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="distribusi">Distribusi</label>
                                    <input type="text" class="form-control" id="distribusi" name="distribusi" placeholder="rincian distribusi">
                                </div>

                                <div class="form-group">
                                    <label for="evakuasi">Evakuasi</label>
                                    <input type="text" class="form-control" id="evakuasi" name="evakuasi" placeholder="rincian evakuasi">
                                </div>

                                <div class="form-group">
                                    <label for="dapur_umum">Dapur Umum</label>
                                    <input type="text" class="form-control" id="dapur_umum" name="dapur_umum" placeholder="rincian dapur umum">
                                </div>

                                <div class="form-group">
                                    <label for="layanan_kesehatan">Layanan Kesehatan</label>
                                    <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan" placeholder="rincian layanan kesehatan">
                                </div>

                                <div class="form-group">
                                    <label for="giat_pemerintah">Giat Pemerintahan</label>
                                    <input type="text" class="form-control" id="giat_pemerintah" name="giat_pemerintah" placeholder="Rincian Giat Pemerintah">
                                </div>

                                <div class="form-group">
                                    <label for="kebutuhan">Kebutuhan</label>
                                    <input type="text" class="form-control" id="kebutuhan" name="kebutuhan" placeholder="Rincian Kebutuhan">
                                </div>

                                <div class="form-group">
                                    <label for="hambatan">Hambatan</label>
                                    <input type="text" class="form-control" id="hambatan" name="hambatan" placeholder="Rincian Hambatan">
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_cp" class="btn btn-primary me-2">Tambah
                                        CP Personil</button>
                                </div>

                                <div id="form_area_cp">
                                    <div id="form_cp" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="posisi">Posisi</label>
                                            <input type="text" class="form-control" id="posisi" name="posisi">
                                        </div>
                                        <div class="form-group">
                                            <label for="kontak">Kontak</label>
                                            <input type="phone" class="form-control" id="kontak" name="kontak">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_petugas_posko" class="btn btn-primary me-2">Petugas Posko</button>
                                </div>

                                <div id="form_area_petugas">
                                    <div id="form_petugas" style="display:none;">
                                        <div class="form-group">
                                            <label for="nama_lengkap_posko">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama_lengkap_posko" name="nama_lengkap_posko">
                                        </div>
                                        <div class="form-group">
                                            <label for="kontak_posko">Kontak</label>
                                            <input type="phone" class="form-control" id="kontak_posko" name="kontak_posko">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <!--div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Situasi</h4>

                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="kejadian_musibah">Kejadian Musibah</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="email" class="form-control" id="lokasi" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">waktu Kejadian</label>
                                    <input type="date" class="form-control" id="waktu_kejadian" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" id="update" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label>File upload</label>
                                    <input type="file" name="img[]" class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary"
                                                type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="js-example-basic-single w-100">
                                        <option value="AL">Ya</option>
                                        <option value="WY">Tidak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="js-example-basic-single w-100">
                                        <option value="AL">Aman</option>
                                        <option value="WY">Tidak Aman</option>
                                    </select>
                                </div>
                                {{-- Inpu Dampak --}}
                                <div class="form-group">
                                    <button type="button" id="dampak" class="btn btn-primary me-2">Input Dampak</button>
                                </div>

                                <div id="form_jumlah_kk" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Korban Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Jumlah KK</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Jumlah Orang</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Meninggal</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Hidup</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Fasilitas/Rumah Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <div class="form-group">
                                        <label for="mengungsi">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" id="mengungsi">
                                    </div>
                                </div>

                                {{-- Tambah Pengungsian --}}

                                <div class="form-group">
                                    <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                        Pengungsian</button>
                                </div>

                                <div id="form_area">
                                    <div id="form_pengungsian" style="display:none;">
                                        <p class="card-description" id="subtitle">Pengungsian</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">KK</label>
                                            <input type="number" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Jiwa</label>
                                            <input type="number" class="form-control" name="jumlah_orang[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki">Laki-Laki</label>
                                            <input type="number" class="form-control" name="laki_laki[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan">Perempuan</label>
                                            <input type="number" class="form-control" name="perempuan[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" name="kurang_dari_5[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="antara_5_18">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" name="antara_5_18[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                            <input type="number" class="form-control" name="lebih_dari_18[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah[]">
                                        </div>
                                    </div>
                                </div>

                                {{-- Personil --}}
                                <div class="form-group">
                                    <button type="button" id="personil" class="btn btn-primary me-2">Input
                                        Personil</button>
                                </div>

                                <div id="form_personil" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Input Personil
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Pengurus</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Staf Markas Kab/Kota</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Staf Markas Provinsi</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Staf Markas Pusat</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Relawan PMI Provinsi</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Relawan Lintas Provinsi</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Spesialis
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Medis</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Paramedis</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Relief</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Logistik</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Watsan</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">IT Telkom</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Sheltering</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Alat Utama
                                    </p>
                                    <div class="form-group">
                                        <label for="jumlah_kk">Kend Ops</label>
                                        <input type="number" class="form-control" id="jumlah_kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_orang">Truk Angkutan</label>
                                        <input type="number" class="form-control" id="jumlah_orang">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Truk Tanki</label>
                                        <input type="number" class="form-control" id="luka_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Double Cabin</label>
                                        <input type="number" class="form-control" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hidup">Alat DU</label>
                                        <input type="number" class="form-control" id="hidup">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Ambulans</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat Watsan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">RS Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat PKDD</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Gudang Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Posko Aju</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Alat IT/Tel Lapangan</label>
                                        <input type="number" class="form-control" id="mengungsi">
                                    </div>
                                </div>


                                <h4 class="card-title">Evaluasi Korban Luka</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Distribusi Non-Food Item</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Layanan Kesehatan</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Layanan Air Bersih</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>
                                <h4 class="card-title">Lain Lain</h4>
                                <div class="form-group">
                                    <label for="kejadian_musibah">Tempat/Lokasi</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>
                                <div>
                                    <p class="card-description">KK/Orang</p>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios1" value="">
                                            KK
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="optionsRadios"
                                                id="optionsRadios2" value="option2" checked>
                                            Orang
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Jumlah</label>
                                    <input type="number" class="form-control" id="waktu_kejadian"
                                        placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <label for="kejadian_musibah">Giat Pemerintahan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="kejadian_musibah">Kebutuhan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <label for="kejadian_musibah">Hambatan</label>
                                    <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_cp" class="btn btn-primary me-2">Tambah
                                        CP Personil</button>
                                </div>

                                <div id="form_area_cp">
                                    <div id="form_cp" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">Posisi</label>
                                            <input type="text" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Kontak</label>
                                            <input type="phone" class="form-control" name="jumlah_orang[]">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_petugas_posko" class="btn btn-primary me-2">Petugas
                                        Posko</button>
                                </div>

                                <div id="form_area_petugas">
                                    <div id="form_petugas" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lokasi[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">Posisi</label>
                                            <input type="text" class="form-control" name="jumlah_kk[]">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Kontak</label>
                                            <input type="phone" class="form-control" name="jumlah_orang[]">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <button class="btn btn-light">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div-->
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
                        document.getElementById('tambah_personil').style.display = 'block';
                    });
                    // Sisipkan tombol "Cancel" setelah tombol "Tambah Pengungsian"
                    document.getElementById('form_area').appendChild(cancelBtn);
                    // Sembunyikan tombol "Tambah Pengungsian"
                    document.getElementById('tambah_personil').style.display = 'none';
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
            });
        </script>
