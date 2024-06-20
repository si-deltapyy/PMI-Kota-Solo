@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
    <div class="row">


        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laporan Situasi</h4>
                    @if($kejadian->giatPmi)
                        <p>{{ $kejadian->giatPmi->evakuasiKorban }}</p>
                    @else
                        <p>Data Giat PMI tidak tersedia.</p>
                    @endif

                    @if($kejadian->dampak)
                        <p>{{ $kejadian->dampak->korban_terdampak }}</p>
                    @else
                        <p>Data Dampak tidak tersedia.</p>
                    @endif
                    <form class="forms-sample" action="{{ route('update-assessment', $kejadian->id_kejadian) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kejadian_musibah">Jenis Kejadian Bencana</label>
                            <input type="text" class="form-control" id="kejadian_musibah"
                                value="{{ $kejadian->id_jeniskejadian }}">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="email" class="form-control" id="lokasi" value="{{ $kejadian->lokasi }}">
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Tanggal Kejadian</label>
                            <input type="date" class="form-control" id="waktu_kejadian"
                                value="{{ $kejadian->tanggal_kejadian }}">
                        </div>
                        <div class="form-group">
                            <label for="update">Update</label>
                            <input type="date" class="form-control" id="update" value="{{ $kejadian->update }}">
                        </div>
                        <div class="form-group">
                            <label>File upload</label>
                            {{-- <input type="file" class="file-upload-default" id="file_dokumentasi"
                                value="{{ $kejadian->lampiran_dokumentasi->file_dokumentasi }}">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div> --}}
                        </div>
                        <div class="form-group">
                            <label>Pemerintah membutuhkan Dukungan Internasional</label>
                            <select class="js-example-basic-single w-100" name="dukungan_internasional">
                                <option value="Ya" {{ $kejadian->dukungan_internasional == "Ya" ? 'selected' : '' }}>Ya
                                </option>
                                <option value="Tidak" {{ $kejadian->dukungan_internasional == "Tidak" ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan Akses Menuju Lokasi</label>
                            <select class="js-example-basic-single w-100" id="akses_ke_lokasi" name="akses_ke_lokasi">
                                <option value="Aman" {{ $kejadian->akses_ke_lokasi == "Accessible" ? 'selected' : '' }}>
                                    Aman</option>
                                <option value="Tidak Aman" {{ $kejadian->akses_ke_lokasi == "Not Accessible" ? 'selected' : '' }}>Tidak Aman</option>
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
                                <label for="jumlah_kk">Jumlah KK</label>
                                <input type="number" class="form-control" id="kk"
                                    value="{{ $kejadian->dampak->korban_terdampak->kk }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input type="number" class="form-control" id="jiwa"
                                    value="{{ $kejadian->dampak->korban_terdampak->jumlah }}">
                            </div>
                            <p class="card-description" id="subtitle">
                                Korban Jiwa/Luka/Mengungsi
                            </p>
                            <div class="form-group">
                                <label for="luka_berat">Luka Berat</label>
                                <input type="number" class="form-control" id="luka_berat"
                                    value="{{ $kejadian->dampak->korban_jlw->luka_berat }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_ringan">Luka Berat</label>
                                <input type="number" class="form-control" id="luka_berat"
                                    value="{{ $kejadian->dampak->korban_jlw->luka_ringan }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Meninggal</label>
                                <input type="number" class="form-control" id="meninggal"
                                    value="{{ $kejadian->dampak->korban_jlw->meninggal }}">
                            </div>
                            <div class="form-group">
                                <label for="hilang">Hilang</label>
                                <input type="number" class="form-control" id="hilang"
                                    value="{{ $kejadian->dampak->korban_jlw->hilang }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Mengungsi</label>
                                <input type="number" class="form-control" id="mengungsi"
                                    value="{{ $kejadian->dampak->korban_jlw->mengungsi }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Kerusakan Rumah
                            </p>
                            <div class="form-group">
                                <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                <input type="number" class="form-control" id="rusak_berat"
                                    value="{{ $kejadian->dampak->kerusakan_rumah->rusak_berat }}">
                            </div>
                            <div class="form-group">
                                <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                <input type="number" class="form-control" id="rusak_sedang"
                                    value="{{ $kejadian->dampak->kerusakan_rumah->rusak_sedang }}">
                            </div>
                            <div class="form-group">
                                <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                <input type="number" class="form-control" id="rusak_ringan"
                                    value="{{ $kejadian->dampak->kerusakan_rumah->rusak_ringan }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Kerusakan Fasilitas Sosial & Infrastruktur
                            </p>
                            <div class="form-group">
                                <label for="sekolah">Kerusakan Sekolah</label>
                                <input type="number" class="form-control" id="sekolah"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->sekolah }}">
                            </div>
                            <div class="form-group">
                                <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                <input type="number" class="form-control" id="tempat_ibadah" value="1"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->tempat_ibadah }}">
                            </div>
                            <div class="form-group">
                                <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                <input type="number" class="form-control" id="rumah_sakit"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->rumah_sakit }}">
                            </div>
                            <div class="form-group">
                                <label for="pasar">Kerusakan Pasar</label>
                                <input type="number" class="form-control" id="pasar"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->pasar }}">
                            </div>
                            <div class="form-group">
                                <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                <input type="number" class="form-control" id="gedung_pemerintah"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->gedung_pemerintah }}">
                            </div>
                            <div class="form-group">
                                <label for="lain_lain">Kerusakan Lain Lain</label>
                                <input type="number" class="form-control" id="lain_lain"
                                    value="{{ $kejadian->dampak->kerusakan_fasil_sosial->lain_lain }}">
                            </div>

                            <div class="form-group">
                                <label for="desc_kerusakan">Kerusakan Infrastruktur</label>
                                <input type="text" class="form-control" id="desc_kerusakan"
                                    value="{{ $kejadian->dampak->kerusakan_infrastruktur->desc_kerusakan }}">
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
                                    <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi"
                                        value="{{ $kejadian->dampak->pengungsian->nama_lokasi }}">
                                </div>
                                <div class="form-group">
                                    <label for="kk">KK</label>
                                    <input type="number" class="form-control" name="kk" id="kk"
                                        value="{{ $kejadian->dampak->pengungsian->kk }}">
                                </div>
                                <div class="form-group">
                                    <label for="jiwa">Jiwa</label>
                                    <input type="number" class="form-control" name="jiwa" id="jiwa"
                                        value="{{ $kejadian->dampak->pengungsian->jiwa }}">
                                </div>
                                <div class="form-group">
                                    <label for="laki_laki">Laki-Laki</label>
                                    <input type="number" class="form-control" name="laki_laki" id="laki_laki"
                                        value="{{ $kejadian->dampak->pengungsian->laki_laki }}">
                                </div>
                                <div class="form-group">
                                    <label for="perempuan">Perempuan</label>
                                    <input type="number" class="form-control" name="perempuan" id="perempuan"
                                        value="{{ $kejadian->dampak->pengungsian->perempuan }}">
                                </div>
                                <div class="form-group">
                                    <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                    <input type="number" class="form-control" name="kurang_dari_5" id="kurang_dari_5"
                                        value="{{ $kejadian->dampak->pengungsian->kurang_dari_5 }}">
                                </div>
                                <div class="form-group">
                                    <label for="atr_5_sampai_18">Antara 5-18 Tahun</label>
                                    <input type="number" class="form-control" name="atr_5_sampai_18"
                                        id="atr_5_sampai_18"
                                        value="{{ $kejadian->dampak->pengungsian->atr_5_sampai_18 }}">
                                </div>
                                <div class="form-group">
                                    <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                    <input type="number" class="form-control" name="lebih_dari_18" id="lebih_dari_18"
                                        value="{{ $kejadian->dampak->pengungsian->lebih_dari_18 }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" id="jumlah"
                                        value="{{ $kejadian->dampak->pengungsian->jumlah }}">
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
                                <input type="number" class="form-control" name="pengurus" id="pengurus"
                                    value="{{ $kejadian->mobilisasi_sd->personil->pengurus }}">
                            </div>
                            <div class="form-group">
                                <label for="staff_markas_kabkota">Staf Markas Kab/Kota</label>
                                <input type="number" class="form-control" name="staff_markas_kabkota"
                                    id="staff_markas_kabkota"
                                    value="{{ $kejadian->mobilisasi_sd->personil->staff_markas_kabkota }}">
                            </div>
                            <div class="form-group">
                                <label for="staff_markas_prov">Staf Markas Provinsi</label>
                                <input type="number" class="form-control" name="staff_markas_prov"
                                    id="staff_markas_prov"
                                    value="{{ $kejadian->mobilisasi_sd->personil->staff_markas_prov }}">
                            </div>
                            <div class="form-group">
                                <label for="staff_markas_pusat">Staf Markas Pusat</label>
                                <input type="number" class="form-control" name="staff_markas_pusat"
                                    id="staff_markas_pusat"
                                    value="{{ $kejadian->mobilisasi_sd->personil->staff_markas_pusat }}">
                            </div>
                            <div class="form-group">
                                <label for="relawan_pmi_kabkot">Relawan PMI Kab/Kota</label>
                                <input type="number" class="form-control" name="relawan_pmi_kabkot"
                                    id="relawan_pmi_kabkot"
                                    value="{{ $kejadian->mobilisasi_sd->personil->relawan_pmi_kabkot }}">
                            </div>
                            <div class="form-group">
                                <label for="relawan_pmi_prov">Relawan PMI Provinsi</label>
                                <input type="number" class="form-control" name="relawan_pmi_prov" id="relawan_pmi_prov"
                                    value="{{ $kejadian->mobilisasi_sd->personil->relawan_pmi_prov }}">
                            </div>
                            <div class="form-group">
                                <label for="relawan_pmi_linprov">Relawan Lintas Provinsi</label>
                                <input type="number" class="form-control" name="relawan_pmi_linprov"
                                    id="relawan_pmi_linprov"
                                    value="{{ $kejadian->mobilisasi_sd->personil->relawan_pmi_linprov }}">
                            </div>
                            <div class="form-group">
                                <label for="sukarelawan_sp">Sukarelawan Spesialis</label>
                                <input type="number" class="form-control" name="sukarelawan_sp" id="sukarelawan_sp"
                                    value="{{ $kejadian->mobilisasi_sd->personil->sukarelawan_sp }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Spesialis
                            </p>
                            <div class="form-group">
                                <label for="medis">Medis</label>
                                <input type="number" class="form-control" name="medis" id="medis"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->medis }}">
                            </div>
                            <div class="form-group">
                                <label for="paramedis">Paramedis</label>
                                <input type="number" class="form-control" name="paramedis" id="paramedis"
                                    value="{{$kejadian->mobilisasi_sd->tsr->paramedis }}">
                            </div>
                            <div class="form-group">
                                <label for="relief">Relief</label>
                                <input type="number" class="form-control" name="relief" id="relief"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->relief }}">
                            </div>
                            <div class="form-group">
                                <label for="logistik">Logistik</label>
                                <input type="number" class="form-control" name="logistik" id="logistik"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->logistik }}">
                            </div>
                            <div class="form-group">
                                <label for="watsan">Watsan</label>
                                <input type="number" class="form-control" name="watsan" id="watsan"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->watsan }}">
                            </div>
                            <div class="form-group">
                                <label for="it_telkom">IT Telkom</label>
                                <input type="number" class="form-control" name="it_telkom" id="it_telkom"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->it_telkom }}">
                            </div>
                            <div class="form-group">
                                <label for="sheltering">Sheltering</label>
                                <input type="number" class="form-control" name="sheltering" id="sheltering"
                                    value="{{ $kejadian->mobilisasi_sd->tsr->sheltering }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Alat Utama
                            </p>
                            <div class="form-group">
                                <label for="kend_ops">Kend Ops</label>
                                <input type="number" class="form-control" name="kend_ops" id="kend_ops"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->kend_ops }}">
                            </div>
                            <div class="form-group">
                                <label for="truk_angkut">Truk Angkutan</label>
                                <input type="number" class="form-control" name="truk_angkut" id="truk_angkut"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->truk_angkut }}">
                            </div>
                            <div class="form-group">
                                <label for="truk_tanki">Truk Tanki</label>
                                <input type="number" class="form-control" name="truk_tanki" id="truk_tanki"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->truk_tanki }}">
                            </div>
                            <div class="form-group">
                                <label for="double_cabin">Double Cabin</label>
                                <input type="number" class="form-control" name="double_cabin" id="double_cabin"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->double_cabin }}">
                            </div>
                            <div class="form-group">
                                <label for="alat_du">Alat DU</label>
                                <input type="number" class="form-control" name="alat_du" id="alat_du"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->alat_du }}">
                            </div>
                            <div class="form-group">
                                <label for="ambulans">Ambulans</label>
                                <input type="number" class="form-control" name="ambulans" id="ambulans"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->ambulans }}">
                            </div>
                            <div class="form-group">
                                <label for="alat_watsan">Alat Watsan</label>
                                <input type="number" class="form-control" name="alat_watsan" id="alat_watsan"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->alat_watsan }}">
                            </div>
                            <div class="form-group">
                                <label for="rs_lapangan">RS Lapangan</label>
                                <input type="number" class="form-control" name="rs_lapangan" id="rs_lapangan"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->rs_lapangan }}">
                            </div>
                            <div class="form-group">
                                <label for="alat_pkdd">Alat PKDD</label>
                                <input type="number" class="form-control" name="alat_pkdd" id="alat_pkdd"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->alat_pkdd }}">
                            </div>
                            <div class="form-group">
                                <label for="gudang_lapangan">Gudang Lapangan</label>
                                <input type="number" class="form-control" name="gudang_lapangan" id="gudang_lapangan"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->gudang_lapangan }}">
                            </div>
                            <div class="form-group">
                                <label for="posko_aju">Posko Aju</label>
                                <input type="number" class="form-control" name="posko_aju" id="posko_aju"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->posko_aju }}">
                            </div>
                            <div class="form-group">
                                <label for="alat_it_lapangan">Alat IT/Tel Lapangan</label>
                                <input type="number" class="form-control" name="alat_it_lapangan" id="alat_it_lapangan"
                                    value="{{ $kejadian->mobilisasi_sd->alat_tdb->alat_it_lapangan }}">
                            </div>
                        </div>


                        <h4 class="card-title">Evakuasi Korban</h4>
                        <div class="form-group">
                            <label for="luka_ringanberat">Luka Ringan/Berat</label>
                            <input type="text" class="form-control" id="luka_ringanberat" name="luka_ringanberat"
                                value="{{ $kejadian->giat_pmi->evakuasi_korban->luka_ringanberat }}">
                        </div>
                        <div class="form-group">
                            <label for="meninggal">Meninggal</label>
                            <input type="text" class="form-control" id="meninggal" name="meninggal"
                                value="{{ $kejadian->giat_pmi->evakuasi_korban->meninggal }}">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                value="{{ $kejadian->giat_pmi->evakuasi_korban->keterangan }}">
                        </div>

                        <h4 class="card-title">Layanan Korban</h4>
                        <div class="form-group">
                            <label for="distribusi">Distribusi</label>
                            <input type="text" class="form-control" id="distribusi" name="distribusi"
                                value="{{ $kejadian->giat_pmi->layanan_korban->distribusi }}">
                        </div>
                        <div class="form-group">
                            <label for="dapur_umum">Dapur Umum</label>
                            <input type="text" class="form-control" id="dapur_umum" name="dapur_umum"
                                value="{{ $kejadian->giat_pmi->layanan_korban->dapur_umum }}">
                        </div>
                        <div class="form-group">
                            <label for="evakuasi">Evakuasi</label>
                            <input type="text" class="form-control" id="evakuasi" name="evakuasi"
                                value="{{ $kejadian->giat_pmi->layanan_korban->evakuasi }}">
                        </div>
                        <div class="form-group">
                            <label for="layanan_kesehatan">Layanan Kesehatan</label>
                            <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan"
                                value="{{ $kejadian->giat_pmi->layanan_korban->layanan_kesehatan }}">
                        </div>

                        <div class="form-group">
                            <label for="giat_pemerintah">Giat Pemerintahan</label>
                            <input type="text" class="form-control" name="giat_pemerintah" id="giat_pemerintah"
                                value="{{ $kejadian->giat_pemerintah }}">
                        </div>

                        <div class="form-group">
                            <label for="kebutuhan">Kebutuhan</label>
                            <input type="text" class="form-control" name="kebutuhan" id="kebutuhan"
                                value="{{ $kejadian->kebutuhan }}">
                        </div>

                        <div class="form-group">
                            <label for="hambatan">Hambatan</label>
                            <input type="text" class="form-control" name="hambatan" id="hambatan"
                                value="{{ $kejadian->hammbatan }}">
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
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                        value="{{ $kejadian->personil_narahubung->nama_lengkap }}">
                                </div>
                                <div class="form-group">
                                    <label for="posisi">Posisi</label>
                                    <input type="text" class="form-control" name="posisi" id="posisi"
                                        value="{{ $kejadian->personil_narahubung->posisi }}">
                                </div>
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="phone" class="form-control" name="kontak" id="kontak"
                                        value="{{ $kejadian->personil_narahubung->kontak }}">
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
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                        value="{{ $kejadian->personil_narahubung->nama_lengkap }}">
                                </div>
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input type="phone" class="form-control" name="kontak" id="kontak"
                                        value="{{ $kejadian->personil_narahubung->kontak }}">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @endsection


        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                document.getElementById('personil').addEventListener('click', function () {
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
                document.getElementById('dampak').addEventListener('click', function () {
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
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('tambah_pengungsian').addEventListener('click', function () {
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
                    cancelBtn.addEventListener('click', function () {
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

            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('tambah_cp').addEventListener('click', function () {
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
                    cancelBtn.addEventListener('click', function () {
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
            document.addEventListener('DOMContentLoaded', function () {
                document.getElementById('tambah_petugas_posko').addEventListener('click', function () {
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
                    cancelBtn.addEventListener('click', function () {
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