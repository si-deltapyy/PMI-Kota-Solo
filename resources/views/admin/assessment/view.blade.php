@extends('layouts-admin.default')

@section('content')
<div class="content-wrapper">
    <div class="row">


        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Laporan Assessment</h3>
                    <div class="card-description">
                        <div class="home-tab">
                            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                    <div class="btn-wrapper ms-auto">
                                        <a href="{{ route('assessment.pdf', ['id' => $assessment->id_assessment]) }}" class="btn btn-primary text-white me-0">
                                            <i class="icon-download"></i> Unduh Laporan PDF
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <form class="forms-sample">
                    
                        <h5>Detail Kejadian</h5>
                        <br>
                        <hr>
                        <br>
                        <div class="form-group">
                            <label for="kejadian_musibah">Kejadian Bencana</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah"
                                placeholder="Nama Kejadian"
                                value="{{ $assessment->report->jenisKejadian->nama_kejadian }}">
                        </div>
                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input readonly type="email" class="form-control" id="lokasi" placeholder="Lokasi"
                                value="{{ $assessment->locationName }}">
                            <br>
                            <a href="{{ $assessment->googleMapsLink }}" class="btn btn-info btn-sm" id="lihat-lokasi">Lihat
                                Lokasi</a>
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Waktu Kejadian</label>
                            <input readonly type="text" class="form-control" id="waktu_kejadian" value="{{ isset($assessment->waktuKejadian['date']) ? $assessment->waktuKejadian['date'] : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="update">Update</label>
                            <input readonly type="text" class="form-control" id="update" placeholder="Update" value="{{ $assessment->updateAt['date'] }}">
                        </div>
                        <div class="form-group">
                            <label for="update">Gambaran Umum Situasi</label>
                            <input readonly type="text" class="form-control" id="update" placeholder="Update" value="{{ $firstKejadian->keterangan }}">
                        </div>

                        {{-- <div class="form-group">
                            <label>File upload</label>
                            <input type="file" name="img[]" class="file-upload-default">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                </span>
                            </div>
                        </div> --}}
                        {{-- <div class="form-group">
                            <label>Pemerintah membutuhkan Dukungan Internasional</label>
                            <select class="js-example-basic-single w-100">
                                <option value="AL">Ya</option>
                                <option value="WY">Tidak</option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label>Pemerintah Membutuhkan Dukungan Internasional</label>
                            <select readonly class="js-example-basic-single w-100">
                                @if($firstKejadian->dukungan_internasional == "Ya")
                                <option selected value="AL">Ya</option>
                                <option value="WY">Tidak</option>
                                @else
                                <option value="AL">Ya</option>
                                <option selected value="WY">Tidak</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan Akses Menuju Lokasi</label>
                            <select readonly class="js-example-basic-single w-100">
                                @if($firstKejadian->akses_ke_lokasi == "Accessible")
                                <option selected value="AL">Aman</option>
                                <option value="WY">Tidak Aman</option>
                                @else
                                <option value="AL">Aman</option>
                                <option selected value="WY">Tidak Aman</option>
                                @endif
                            </select>
                        </div>
                        {{-- Inpu Dampak --}}
                        <!-- <div class="form-group">
                            <button type="button" id="dampak" class="btn btn-primary me-2">Tampilkan Dampak</button>
                        </div> -->

                        <h5>Dampak</h5>
                        <br>
                        <hr>
                        <br>

                        <div class="form-group">
                            <p class="card-description" id="subtitle">
                                Korban Terdampak
                            </p>
                            <div class="form-group">
                                <label for="jumlah_kk">Jumlah KK</label>
                                <input readonly type="number" class="form-control" id="jumlah_kk" value="{{ $firstKejadian->korbanTerdampak->kk }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Jumlah Orang</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->korbanTerdampak->jiwa }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_berat">Luka Berat</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->korbanJlw->luka_berat }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_berat">Luka Ringan</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->korbanJlw->luka_ringan }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Meninggal</label>
                                <input readonly type="number" class="form-control" id="meninggal" value="{{ $firstKejadian->korbanJlw->meninggal }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Hilang</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->korbanJlw->hilang }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Mengungsi</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->korbanJlw->mengungsi }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Kerusakan Rumah Terdampak
                            </p>
                            <div class="form-group">
                                <label for="jumlah_kk">Kerusakan Rumah Berat</label>
                                <input readonly type="number" class="form-control" id="jumlah_kk" value="{{ $firstKejadian->kerusakanRumah->rusak_berat }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Kerusakan Rumah Sedang</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->kerusakanRumah->rusak_sedang }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Kerusakan Rumah Ringan</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->kerusakanRumah->rusak_ringan }}">
                            </div>
                            <p class="card-description" id="subtitle">
                                Kerusakan Fasilitas Sosial
                            </p>
                            <div class="form-group">
                                <label for="luka_berat">Kerusakan Sekolah</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->kerusakanFasilitasSosial->sekolah }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Kerusakan Tempat Ibadah</label>
                                <input readonly type="number" class="form-control" id="meninggal" value="{{ $firstKejadian->kerusakanFasilitasSosial->tempat_ibadah }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Kerusakan Rumah Sakit</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->kerusakanFasilitasSosial->rumah_sakit }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Kerusakan Pasar</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->kerusakanFasilitasSosial->pasar }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Kerusakan Gedung Pemerintahan</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->kerusakanFasilitasSosial->gedung_pemerintah }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Kerusakan Lain Lain</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->kerusakanFasilitasSosial->lain_lain }}">
                            </div>

                            <div class="form-group">
                                <label for="mengungsi">Kerusakan Infrastruktur</label>
                                <input readonly type="text" class="form-control" id="mengungsi" value="{{ $firstKejadian->kerusakanInfrastruktur->desc_kerusakan }}">
                            </div>
                        </div>

                        {{-- Tambah Pengungsian --}}

                        <!-- <div class="form-group">
                            <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                Pengungsian</button>
                        </div> -->

                        <h5>Pengungsian</h5>
                        <br>
                        <hr>
                        <br>

                        @foreach ($firstKejadian->pengungsian as $pengungsian)
                        
                        <div id="form_area">
                            <div id="form_pengungsian" >
                                <!-- <h4 class="card-title" id="subtitle">Pengungsian</h4> -->
                                <div class="form-group">
                                    <label for="nama_lokasi">Nama Lokasi</label>
                                    <input readonly type="text" class="form-control" name="nama_lokasi[]" value="{{ $pengungsian->nama_lokasi }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_kk">KK</label>
                                    <input readonly type="number" class="form-control" name="jumlah_kk[]" value="{{ $pengungsian->kk }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_orang">Jiwa</label>
                                    <input readonly type="number" class="form-control" name="jumlah_orang[]" value="{{ $pengungsian->jiwa }}">
                                </div>
                                <div class="form-group">
                                    <label for="laki_laki">Laki-Laki</label>
                                    <input readonly type="number" class="form-control" name="laki_laki[]" value="{{ $pengungsian->laki_laki }}">
                                </div>
                                <div class="form-group">
                                    <label for="perempuan">Perempuan</label>
                                    <input readonly type="number" class="form-control" name="perempuan[]" value="{{ $pengungsian->perempuan }}">
                                </div>
                                <div class="form-group">
                                    <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                    <input readonly type="number" class="form-control" name="kurang_dari_5[]" value="{{ $pengungsian->kurang_dari_5 }}">
                                </div>
                                <div class="form-group">
                                    <label for="antara_5_18">Antara 5-18 Tahun</label>
                                    <input readonly type="number" class="form-control" name="antara_5_18[]" value="{{ $pengungsian->atr_5_sampai_18 }}">
                                </div>
                                <div class="form-group">
                                    <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                    <input readonly type="number" class="form-control" name="lebih_dari_18[]" value="{{ $pengungsian->lebih_dari_18 }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input readonly type="number" class="form-control" name="jumlah[]" value="{{ $pengungsian->jumlah }}">
                                </div>
                            </div>
                        </div>

                        @endforeach

                        {{-- Personil --}}
                        {{-- <div class="form-group">
                            <button type="button" id="personil" class="btn btn-primary me-2">Input
                                Personil</button>
                        </div> --}}

                        <h4>Mobilisasi SDM PMI</h4>
                        <br>
                        <hr>
                        <br>

                        <div id="form_personil">
                            <p class="card-description" id="subtitle">
                                Personil
                            </p>
                            <div class="form-group">
                                <label for="jumlah_kk">Pengurus</label>
                                <input readonly type="number" class="form-control" id="jumlah_kk" value="{{ $firstKejadian->personil->pengurus }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Staf Markas Kab/Kota</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->personil->staf_markas_kabkota }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_berat">Staf Markas Provinsi</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->personil->staf_markas_prov }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Staf Markas Pusat</label>
                                <input readonly type="number" class="form-control" id="meninggal" value="{{ $firstKejadian->personil->staf_markas_pusat }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Relawan PMI Kab/Kota</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->personil->relawan_pmi_kabkota }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Relawan PMI Provinsi</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->personil->relawan_pmi_prov }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Relawan Lintas Provinsi</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->personil->relawan_pmi_linprov }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Personil Bantuan Teknis/Ahli/Spesialis
                            </p>
                            <div class="form-group">
                                <label for="jumlah_kk">Medis</label>
                                <input readonly type="number" class="form-control" id="jumlah_kk" value="{{ $firstKejadian->tsr->medis }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Paramedis</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->tsr->paramedis }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_berat">Relief</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->tsr->relief }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Logistik</label>
                                <input readonly type="number" class="form-control" id="meninggal" value="{{ $firstKejadian->tsr->logistik }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Watsan</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->tsr->watsan }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">IT Telkom</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->tsr->it_telekom }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Sheltering</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->tsr->sheltering }}">
                            </div>

                            <p class="card-description" id="subtitle">
                                Alat Utama
                            </p>
                            <div class="form-group">
                                <label for="jumlah_kk">Kend Ops</label>
                                <input readonly type="number" class="form-control" id="jumlah_kk" value="{{ $firstKejadian->alatTdb->kend_ops }}">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_orang">Truk Angkutan</label>
                                <input readonly type="number" class="form-control" id="jumlah_orang" value="{{ $firstKejadian->alatTdb->truk_angkut }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_berat">Truk Tanki</label>
                                <input readonly type="number" class="form-control" id="luka_berat" value="{{ $firstKejadian->alatTdb->truk_tanki }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggal">Double Cabin</label>
                                <input readonly type="number" class="form-control" id="meninggal" value="{{ $firstKejadian->alatTdb->double_cabin }}">
                            </div>
                            <div class="form-group">
                                <label for="hidup">Alat DU</label>
                                <input readonly type="number" class="form-control" id="hidup" value="{{ $firstKejadian->alatTdb->alat_du }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Ambulans</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->ambulans }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Alat Watsan</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->alat_watsan }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">RS Lapangan</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->rs_lapangan }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Alat PKDD</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->alat_pkdd }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Gudang Lapangan</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->gudang_lapangan }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Posko Aju</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->posko_aju }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Alat IT/Tel Lapangan</label>
                                <input readonly type="number" class="form-control" id="mengungsi" value="{{ $firstKejadian->alatTdb->alat_it_lapangan }}">
                            </div>
                        </div>

                        <h3 class="card-title">Giat PMI</h3>
                        <br>

                        <h4>Evakuasi Korban Luka</h4>
                        <br>
                        <hr>
                        <br>
                        <!-- <div class="form-group">
                            <label for="kejadian_musibah">Tempat/Lokasi</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div> -->
                        <!-- <div>
                            <p class="card-description">KK/Orang</p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios1" value="">
                                    KK
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios2" value="option2" checked>
                                    Orang
                                </label>
                            </div>
                        </div> -->
                        <div class="form-group">
                            <label for="waktu_kejadian">Luka Ringan/Berat</label>
                            <input readonly type="number" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->evakuasiKorban->luka_ringanberat }}"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Meninggal</label>
                            <input readonly type="number" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->evakuasiKorban->meninggal }}"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Keterangan</label>
                            <input readonly type="text" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->evakuasiKorban->keterangan }}"
                                placeholder="Password">
                        </div>
                        {{-- <h4 class="card-title">Distribusi Non-Food Item</h4>
                        <div class="form-group">
                            <label for="kejadian_musibah">Tempat/Lokasi</label>
                            <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div> --}}
                        {{-- <div>
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
                            <input type="number" class="form-control" id="waktu_kejadian" placeholder="Password">
                        </div> --}}
                        <!-- <h4 class="card-title">Layanan Kesehatan</h4> -->
                        <div class="form-group">
                            <label for="waktu_kejadian">Distribusi</label>
                            <input readonly type="text" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->layananKorban->distribusi }}"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Evakuasi</label>
                            <input readonly type="text" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->layananKorban->evakuasi }}"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Dapur Umum</label>
                            <input readonly type="text" class="form-control" id="waktu_kejadian" value="{{ $firstKejadian->layananKorban->dapur_umum }}"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="kejadian_musibah">Layanan Kesehatan</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name" value="{{ $firstKejadian->layananKorban->layanan_kesehatan }}">
                        </div>
                        <!-- <h4 class="card-title">Layanan Air Bersih</h4> -->
                        <!-- <div class="form-group">
                            <label for="kejadian_musibah">Tempat/Lokasi</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div>
                        <div>
                            <p class="card-description">KK/Orang</p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios1" value="">
                                    KK
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios2" value="option2" checked>
                                    Orang
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Jumlah</label>
                            <input readonly type="number" class="form-control" id="waktu_kejadian"
                                placeholder="Password">
                        </div> -->
                        <!-- <h4 class="card-title">Lain Lain</h4>
                        <div class="form-group">
                            <label for="kejadian_musibah">Tempat/Lokasi</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div>
                        <div>
                            <p class="card-description">KK/Orang</p>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios1" value="">
                                    KK
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input readonly type="radio" class="form-check-input" name="optionsRadios"
                                        id="optionsRadios2" value="option2" checked>
                                    Orang
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Jumlah</label>
                            <input readonly type="number" class="form-control" id="waktu_kejadian"
                                placeholder="Password">
                        </div> -->

                        {{-- <div class="form-group">
                            <label for="kejadian_musibah">Giat Pemerintahan</label>
                            <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div> --}}

                        <h4 >Giat Pemerintah</h4>
                        <br>

                        <div class="form-group">
                            <label for="kejadian_musibah">Giat Pemerintah</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name" value="{{ $firstKejadian->giat_pemerintah }}">
                        </div>

                        <h4>Kebutuhan</h4>
                        <br>
                        <hr>
                        <br>

                        <div class="form-group">
                            <label for="kejadian_musibah">Kebutuhan</label>
                            <input readonly type="text" class="form-control" id="kejadian_musibah" placeholder="Name" value="{{ $firstKejadian->kebutuhan }}">
                        </div>

                        {{-- <div class="form-group">
                            <label for="kejadian_musibah">Hambatan</label>
                            <input type="text" class="form-control" id="kejadian_musibah" placeholder="Name">
                        </div> --}}

                        <!-- <div class="form-group">
                            <button type="button" id="tambah_cp" class="btn btn-primary me-2">Tambah
                                CP Personil</button>
                        </div> -->

                        <h4>CP Personil</h4>
                        <br>
                        <hr>
                        <br>

                        @foreach ($firstKejadian->narahubung as $narahubung)
                        <div id="form_area_cp">
                            <div id="form_cp">
                                <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                <div class="form-group">
                                    <label for="nama_lokasi">Nama Lengkap</label>
                                    <input readonly type="text" class="form-control" name="nama_lokasi[]" value="{{ $narahubung->nama_lengkap }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_kk">Posisi</label>
                                    <input readonly type="text" class="form-control" name="jumlah_kk[]" value="{{ $narahubung->posisi }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_orang">Kontak</label>
                                    <input readonly type="phone" class="form-control" name="jumlah_orang[]" value="{{ $narahubung->kontak }}">
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- <div class="form-group">
                            <button type="button" id="tambah_petugas_posko" class="btn btn-primary me-2">Petugas
                                Assessment</button>
                        </div> -->

                        <h4>Petugas Posko</h4>
                        <br>
                        <hr>
                        <br>

                        @foreach ($firstKejadian->petugas_posko as $petugasPosko)
                        <div id="form_area_petugas">
                            <div id="form_petugas" >
                                <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                <div class="form-group">
                                    <label for="nama_lokasi">Nama Lengkap</label>
                                    <input readonly type="text" class="form-control" name="nama_lokasi[]" value="{{ $petugasPosko->nama_lengkap }}">
                                </div>
                                <div class="form-group">
                                    <label for="jumlah_orang">Kontak</label>
                                    <input readonly type="phone" class="form-control" name="jumlah_orang[]" value="{{ $petugasPosko->kontak }}">
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <!-- <button type="submit" class="btn btn-primary me-2">Submit</button> -->
                        <a class="btn btn-light" href="{{ route('admin-assessment') }}">Back</a>
                        
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