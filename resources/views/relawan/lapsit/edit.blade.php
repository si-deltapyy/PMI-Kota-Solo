@extends('layouts-relawan.default')

@section('content')
<div class="content-wrapper">
    <div class="row">


        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Laporan Situasi</h4>
                    <!-- Update Alert-->
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <!-- End of Update Alert-->
                    {{-- @if($kejadian->giatPmi)
                    <p>{{ $kejadian->giatPmi->evakuasiKorban }}</p>
                    @else
                    <p>Data Giat PMI tidak tersedia.</p>
                    @endif

                    @if($kejadian->dampak)
                    <p>{{ $kejadian->dampak->korban_terdampak }}</p>
                    @else
                    <p>Data Dampak tidak tersedia.</p>
                    @endif --}}
                    <form class="forms-sample" action="{{ route('edit-lapsit.update', $kejadian->id_kejadian) }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="kejadian_musibah">Jenis Kejadian Bencana</label>
                            <select class="form-control" id="kejadian_musibah" name="id_jeniskejadian" disabled
                                style="color: black;">
                                @foreach($jenisKejadian as $jenis)
                                    <option value="{{ $jenis->id_jeniskejadian }}" {{ $jenis->id_jeniskejadian == $kejadian->id_jeniskejadian ? 'selected' : '' }}>
                                        {{ $jenis->nama_kejadian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="lokasi">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                value="{{ $kejadian->lokasi }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="waktu_kejadian">Tanggal Kejadian</label>
                            <input type="date" class="form-control" id="waktu_kejadian" name="waktu_kejadian"
                                value="{{ $kejadian->tanggal_kejadian }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="update">Update</label>
                            <input type="date" class="form-control" id="update" name="update"
                                value="{{ $kejadian->update }}">
                        </div>

                        <div class="form-group">
                            <label>Pemerintah membutuhkan dukungan internasional</label>
                            <select class="form-control" id="dukungan_internasional" name="dukungan_internasional"
                                style="background-color: white; color: black;">
                                <option value="Ya" {{ $kejadian->dukungan_internasional == "Ya" ? 'selected' : '' }}>Ya
                                </option>
                                <option value="Tidak" {{ $kejadian->dukungan_internasional == "Tidak" ? 'selected' : '' }}>Tidak</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Keterangan Akses Menuju Lokasi</label>
                            <select class="form-control" id="akses_ke_lokasi" name="akses_ke_lokasi"
                                style="background-color: white; color: black;">
                                <option value="Accessible" {{ $kejadian->akses_ke_lokasi == "Accessible" ? 'selected' : '' }}>Aman</option>
                                <option value="Not Accessible" {{ $kejadian->akses_ke_lokasi == "Not Accessible" ? 'selected' : '' }}>Tidak Aman</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Gambaran Umum Situasi</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                value="{{ $kejadian->keterangan }}">
                        </div>
                        {{-- Input Dampak --}}
                        {{-- <div class="form-group">
                            <button type="button" id="dampak" class="btn btn-primary me-2">Input Dampak</button>
                        </div> --}}
                        <h4 class="card-title">Data Dampak Kejadian</h4>

                        <div id="form_jumlah_kk">
                            <h6><b>Korban Terdampak</b></h6>
                            <div class="form-group">
                                <label for="kk">Jumlah KK</label>
                                <input type="number" class="form-control" name="kk" id="kk"
                                    value="{{ $kejadian->dampak?->korbanTerdampak?->kk ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="jiwa">Jumlah Orang</label>
                                <input type="number" class="form-control" name="jiwa" id="jiwa"
                                    value="{{ $kejadian->dampak?->korbanTerdampak?->jiwa ?? '' }}">
                            </div>
                            <h6><b>Korban Jiwa/Luka/Mengungsi</b></h6>
                            <div class="form-group">
                                <label for="luka_berat">Luka Berat</label>
                                <input type="number" class="form-control" name="luka_berat" id="luka_berat"
                                    value="{{ $kejadian->dampak?->korbanJlw?->luka_berat ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="luka_ringan">Luka Ringan</label>
                                <input type="number" class="form-control" name="luka_ringan" id="luka_ringan"
                                    value="{{ $kejadian->dampak?->korbanJlw?->luka_ringan ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="meninggaljlw">Meninggal</label>
                                <input type="number" class="form-control" name="meninggaljlw" id="meninggaljlw"
                                    value="{{ $kejadian->dampak?->korbanJlw?->meninggal ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="hilang">Hilang</label>
                                <input type="number" class="form-control" name="hilang" id="hilang"
                                    value="{{ $kejadian->dampak?->korbanJlw?->hilang ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="mengungsi">Mengungsi</label>
                                <input type="number" class="form-control" name="mengungsi" id="mengungsi"
                                    value="{{ $kejadian->dampak?->korbanJlw?->mengungsi ?? '' }}">
                            </div>

                            <h6><b>Kerusakan Rumah</b></h6>

                            <div class="form-group">
                                <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                <input type="number" class="form-control" name="rusak_berat" id="rusak_berat"
                                    value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_berat ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                <input type="number" class="form-control" name="rusak_sedang" id="rusak_sedang"
                                    value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_sedang ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                <input type="number" class="form-control" name="rusak_ringan" id="rusak_ringan"
                                    value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_ringan ?? '' }}">
                            </div>

                            <h6><b>Kerusakan Fasilitas Sosial & Infrastruktur</b></h6>
                            <div class="form-group">
                                <label for="sekolah">Kerusakan Sekolah</label>
                                <input type="number" class="form-control" name="sekolah" id="sekolah"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->sekolah ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                <input type="number" class="form-control" name="tempat_ibadah" id="tempat_ibadah"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->tempat_ibadah ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                <input type="number" class="form-control" name="rumah_sakit" id="rumah_sakit"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->rumah_sakit ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="pasar">Kerusakan Pasar</label>
                                <input type="number" class="form-control" name="pasar" id="pasar"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->pasar ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                <input type="number" class="form-control" name="gedung_pemerintah"
                                    id="gedung_pemerintah"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->gedung_pemerintah ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="lain_lain">Kerusakan Lain Lain</label>
                                <input type="number" class="form-control" name="lain_lain" id="lain_lain"
                                    value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->lain_lain ?? '' }}">
                            </div>

                            <h6><b>Kerusakan Infrastruktur</b></h6>

                            <div class="form-group">
                                <label for="desc_kerusakan">Deskripsi Kerusakan</label>
                                <input type="text" class="form-control" name="desc_kerusakan" id="desc_kerusakan"
                                    value="{{ $kejadian->dampak?->kerusakanInfrastruktur?->desc_kerusakan ?? '' }}">
                            </div>
                        </div>

                        {{-- Tambah Pengungsian --}}
                        <h6><b>Pengungsian</b></h6>

                        <div id="form_area">
                            <button type="button" id="add-pengungsian" class="btn btn-primary me-2">Input
                                Pengungsian</button>
                            <br>
                            <p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Pengungsian</p>
                            <div id="pengungsian-container">
                                @if($kejadian->dampak && $kejadian->dampak->pengungsian)
                                    @foreach($kejadian->dampak->pengungsian as $index => $pengungsian)
                                        <div class="pengungsian-item mb-3">
                                            <h5>Pengungsian #{{ $index + 1 }}</h5>
                                            <input type="hidden" name="pengungsian[{{ $index }}][id_pengungsian]"
                                                value="{{ $pengungsian->id_pengungsian }}">
                                            <div class="form-group">
                                                <label for="nama_lokasi_{{ $index }}">Nama Lokasi</label>
                                                <input type="text" class="form-control"
                                                    name="pengungsian[{{ $index }}][nama_lokasi]" id="nama_lokasi_{{ $index }}"
                                                    value="{{ $pengungsian->nama_lokasi }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kk_{{ $index }}">KK</label>
                                                <input type="number" class="form-control" name="pengungsian[{{ $index }}][kk]"
                                                    id="kk_{{ $index }}" value="{{ $pengungsian->kk }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jiwa_{{ $index }}">Jiwa</label>
                                                <input type="number" class="form-control" name="pengungsian[{{ $index }}][jiwa]"
                                                    id="jiwa_{{ $index }}" value="{{ $pengungsian->jiwa }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="laki_laki_{{ $index }}">Laki-Laki</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][laki_laki]" id="laki_laki_{{ $index }}"
                                                    value="{{ $pengungsian->laki_laki }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="perempuan_{{ $index }}">Perempuan</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][perempuan]" id="perempuan_{{ $index }}"
                                                    value="{{ $pengungsian->perempuan }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kurang_dari_5_{{ $index }}">Kurang dari 5 Tahun</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][kurang_dari_5]"
                                                    id="kurang_dari_5_{{ $index }}" value="{{ $pengungsian->kurang_dari_5 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="atr_5_sampai_18_{{ $index }}">Antara 5-18 Tahun</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][atr_5_sampai_18]"
                                                    id="atr_5_sampai_18_{{ $index }}"
                                                    value="{{ $pengungsian->atr_5_sampai_18 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="lebih_dari_18_{{ $index }}">Lebih Dari 18 Tahun</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][lebih_dari_18]"
                                                    id="lebih_dari_18_{{ $index }}" value="{{ $pengungsian->lebih_dari_18 }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_{{ $index }}">Jumlah</label>
                                                <input type="number" class="form-control"
                                                    name="pengungsian[{{ $index }}][jumlah]" id="jumlah_{{ $index }}"
                                                    value="{{ $pengungsian->jumlah }}">
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-pengungsian">Hapus</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let pengungsianCount = {{ $kejadian->dampak && $kejadian->dampak->pengungsian ? $kejadian->dampak->pengungsian->count() : 0 }};
                                const addPengungsianBtn = document.getElementById('add-pengungsian');
                                const pengungsianContainer = document.getElementById('pengungsian-container');

                                addPengungsianBtn.addEventListener('click', function () {
                                    const newPengungsian = document.createElement('div');
                                    newPengungsian.className = 'pengungsian-item mb-3';
                                    newPengungsian.innerHTML = `
                                        <h5>Pengungsian Baru #${pengungsianCount + 1}</h5>
                                        <div class="form-group">
                                            <label for="nama_lokasi_${pengungsianCount}">Nama Lokasi</label>
                                            <input type="text" class="form-control" name="pengungsian[${pengungsianCount}][nama_lokasi]" id="nama_lokasi_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_${pengungsianCount}">KK</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][kk]" id="kk_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jiwa_${pengungsianCount}">Jiwa</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][jiwa]" id="jiwa_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki_${pengungsianCount}">Laki-laki</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][laki_laki]" id="laki_laki_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan_${pengungsianCount}">Perempuan</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][perempuan]" id="perempuan_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5_${pengungsianCount}">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][kurang_dari_5]" id="kurang_dari_5_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="atr_5_sampai_18_${pengungsianCount}">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][atr_5_sampai_18]" id="atr_5_sampai_18_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18_${pengungsianCount}">Lebih dari 18 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][lebih_dari_18]" id="lebih_dari_18_${pengungsianCount}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_${pengungsianCount}">Jumlah</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][jumlah]" id="jumlah_${pengungsianCount}">
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-pengungsian">Hapus</button>
                                    `;

                                    pengungsianContainer.appendChild(newPengungsian);
                                    pengungsianCount++;
                                });

                                pengungsianContainer.addEventListener('click', function (e) {
                                    if (e.target && e.target.classList.contains('remove-pengungsian')) {
                                        e.target.closest('.pengungsian-item').remove();
                                    }
                                });
                            });
                        </script>

                        <h4 class="card-title">Data Mobilisasi Sumber Daya</h4>

                        {{-- mobilisasi sd - tsr, alat tdb, personil --}}
                        <h6><b>Personil</b></h6>
                        <div class="form-group">
                            <label for="pengurus">Pengurus</label>
                            <input type="number" class="form-control" id="pengurus" name="pengurus"
                                value="{{ $kejadian->mobilisasiSd?->personil?->pengurus ?? '' }}">

                        </div>

                        <div class="form-group">
                            <label for="staf_markas_kabkota">Staf Markas Kab/Kota</label>
                            <input type="number" class="form-control" id="staf_markas_kabkota"
                                name="staf_markas_kabkota"
                                value="{{ $kejadian->mobilisasiSd?->personil?->staf_markas_kabkota ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="staf_markas_prov">Staf Markas Provinsi</label>
                            <input type="number" class="form-control" id="staf_markas_prov" name="staf_markas_prov"
                                value="{{ $kejadian->mobilisasiSd?->personil?->staf_markas_prov ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="staf_markas_pusat">Staf Markas Pusat</label>
                            <input type="number" class="form-control" id="staf_markas_pusat" name="staf_markas_pusat"
                                value="{{ $kejadian->mobilisasiSd?->personil?->staf_markas_pusat ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="relawan_pmi_kabkota">Relawan PMI Kab/Kota</label>
                            <input type="number" class="form-control" id="relawan_pmi_kabkota"
                                name="relawan_pmi_kabkota"
                                value="{{ $kejadian->mobilisasiSd?->personil?->relawan_pmi_kabkota ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="relawan_pmi_prov">Relawan PMI Provinsi</label>
                            <input type="number" class="form-control" id="relawan_pmi_prov" name="relawan_pmi_prov"
                                value="{{ $kejadian->mobilisasiSd?->personil?->relawan_pmi_prov ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="relawan_pmi_linprov">Relawan PMI Lintas Provinsi</label>
                            <input type="number" class="form-control" id="relawan_pmi_linprov"
                                name="relawan_pmi_linprov"
                                value="{{ $kejadian->mobilisasiSd?->personil?->relawan_pmi_linprov ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="sukarelawan_sip">Sukarelawan Spesialis</label>
                            <input type="number" class="form-control" id="sukarelawan_sip" name="sukarelawan_sip"
                                value="{{ $kejadian->mobilisasiSd?->personil?->sukarelawan_sip ?? '' }}">
                        </div>

                        <h6><b>Personil Bantuan Teknis/Ahli/Spesialis (TSR)</b></h6>
                        <div class="form-group">
                            <label for="medis">Medis</label>
                            <input type="number" class="form-control" id="medis" name="medis"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->medis ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="paramedis">Paramedis</label>
                            <input type="number" class="form-control" id="paramedis" name="paramedis"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->paramedis ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="relief">Relief</label>
                            <input type="number" class="form-control" id="relief" name="relief"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->relief ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="logistik">Logistik</label>
                            <input type="number" class="form-control" id="logistik" name="logistik"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->logistik ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="watsan">Watsan</label>
                            <input type="number" class="form-control" id="watsan" name="watsan"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->watsan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="it_telekom">IT dan Telekomunikasi</label>
                            <input type="number" class="form-control" id="it_telekom" name="it_telekom"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->it_telekom ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="sheltering">Sheltering</label>
                            <input type="number" class="form-control" id="sheltering" name="sheltering"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->sheltering ?? '' }}">
                        </div>

                        <h6><b>Alat Utama Sistem TDB</b></h6>
                        <div class="form-group">
                            <label for="kend_ops">Kendaraan Operasional</label>
                            <input type="text" class="form-control" id="kend_ops" name="kend_ops"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->kend_ops ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="truk_angkut">Truk Angkut</label>
                            <input type="text" class="form-control" id="truk_angkut" name="truk_angkut"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->truk_angkut ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="truk_tanki">Truk Tanki</label>
                            <input type="text" class="form-control" id="truk_tanki" name="truk_tanki"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->truk_tanki ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="double_cabin">Double Cabin</label>
                            <input type="text" class="form-control" id="double_cabin" name="double_cabin"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->double_cabin ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_du">Alat DU</label>
                            <input type="text" class="form-control" id="alat_du" name="alat_du"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_du ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="ambulans">Ambulans</label>
                            <input type="text" class="form-control" id="ambulans" name="ambulans"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->ambulans ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_watsan">Alat Watsan</label>
                            <input type="text" class="form-control" id="alat_watsan" name="alat_watsan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_watsan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="rs_lapangan">RS Lapangan</label>
                            <input type="text" class="form-control" id="rs_lapangan" name="rs_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->rs_lapangan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_pkdd">Alat PKDD</label>
                            <input type="text" class="form-control" id="alat_pkdd" name="alat_pkdd"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_pkdd ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="gudang_lapangan">Gudang Lapangan</label>
                            <input type="text" class="form-control" id="gudang_lapangan" name="gudang_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->gudang_lapangan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="posko_aju">Posko Aju</label>
                            <input type="text" class="form-control" id="posko_aju" name="posko_aju"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->posko_aju ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_it_lapangan">Alat IT Lapangan</label>
                            <input type="text" class="form-control" id="alat_it_lapangan" name="alat_it_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_it_lapangan ?? '' }}">
                        </div>

                        <h4 class="card-title">Data Giat PMI</h4>

                        {{-- giat pmi - evakuasi korban layanan korban --}}
                        <h6><b>Evakuasi Korban</b></h6>
                        <div class="form-group">
                            <label for="luka_ringanberat">Luka Ringan/Berat</label>
                            <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat"
                                value="{{ $kejadian->giatPmi?->evakuasiKorban?->luka_ringanberat ?? '' }}">

                        </div>

                        <div class="form-group">

                            <label for="sukarelawan_sip">Sukarelawan Spesialis</label>
                            <input type="number" class="form-control" id="sukarelawan_sip" name="sukarelawan_sip"
                                value="{{ $kejadian->mobilisasiSd?->personil?->sukarelawan_sip ?? '' }}">
                        </div>

                        <h6><b>Personil Bantuan Teknis/Ahli/Spesialis (TSR)</b></h6>
                        <div class="form-group">
                            <label for="medis">Medis</label>
                            <input type="number" class="form-control" id="medis" name="medis"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->medis ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="paramedis">Paramedis</label>
                            <input type="number" class="form-control" id="paramedis" name="paramedis"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->paramedis ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="relief">Relief</label>
                            <input type="number" class="form-control" id="relief" name="relief"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->relief ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="logistik">Logistik</label>
                            <input type="number" class="form-control" id="logistik" name="logistik"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->logistik ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="watsan">Watsan</label>
                            <input type="number" class="form-control" id="watsan" name="watsan"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->watsan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="it_telekom">IT dan Telekomunikasi</label>
                            <input type="number" class="form-control" id="it_telekom" name="it_telekom"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->it_telekom ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="sheltering">Sheltering</label>
                            <input type="number" class="form-control" id="sheltering" name="sheltering"
                                value="{{ $kejadian->mobilisasiSd?->tsr?->sheltering ?? '' }}">
                        </div>

                        <h6><b>Alat Utama Sistem TDB</b></h6>
                        <div class="form-group">
                            <label for="kend_ops">Kendaraan Operasional</label>
                            <input type="text" class="form-control" id="kend_ops" name="kend_ops"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->kend_ops ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="truk_angkut">Truk Angkut</label>
                            <input type="text" class="form-control" id="truk_angkut" name="truk_angkut"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->truk_angkut ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="truk_tanki">Truk Tanki</label>
                            <input type="text" class="form-control" id="truk_tanki" name="truk_tanki"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->truk_tanki ?? '' }}">
                        </div>

                        <div class="form-group">

                            <label for="double_cabin">Double Cabin</label>
                            <input type="text" class="form-control" id="double_cabin" name="double_cabin"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->double_cabin ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_du">Alat DU</label>
                            <input type="text" class="form-control" id="alat_du" name="alat_du"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_du ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="ambulans">Ambulans</label>
                            <input type="text" class="form-control" id="ambulans" name="ambulans"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->ambulans ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_watsan">Alat Watsan</label>
                            <input type="text" class="form-control" id="alat_watsan" name="alat_watsan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_watsan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="rs_lapangan">RS Lapangan</label>
                            <input type="text" class="form-control" id="rs_lapangan" name="rs_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->rs_lapangan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_pkdd">Alat PKDD</label>
                            <input type="text" class="form-control" id="alat_pkdd" name="alat_pkdd"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_pkdd ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="gudang_lapangan">Gudang Lapangan</label>
                            <input type="text" class="form-control" id="gudang_lapangan" name="gudang_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->gudang_lapangan ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="posko_aju">Posko Aju</label>
                            <input type="text" class="form-control" id="posko_aju" name="posko_aju"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->posko_aju ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="alat_it_lapangan">Alat IT Lapangan</label>
                            <input type="text" class="form-control" id="alat_it_lapangan" name="alat_it_lapangan"
                                value="{{ $kejadian->mobilisasiSd?->alatTdb?->alat_it_lapangan ?? '' }}">
                        </div>

                        <h4 class="card-title">Data Giat PMI</h4>

                        {{-- giat pmi - evakuasi korban layanan korban --}}
                        <h6><b>Evakuasi Korban</b></h6>
                        <div class="form-group">
                            <label for="luka_ringanberat">Luka Ringan/Berat</label>
                            <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat"
                                value="{{ $kejadian->giatPmi?->evakuasiKorban?->luka_ringanberat ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="meninggalevakuasi">Meninggal</label>
                            <input type="number" class="form-control" id="meninggalevakuasi" name="meninggalevakuasi"
                                value="{{ $kejadian->giatPmi?->evakuasiKorban?->meninggal ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="evakuasi_keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="evakuasi_keterangan" name="evakuasi_keterangan"
                                value="{{ $kejadian->giatPmi?->evakuasiKorban?->keterangan ?? '' }}">
                        </div>
                        <!--div class="form-group">
                                    <label for="evakuasi_keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="evakuasi_keterangan" name="evakuasi_keterangan" value="{{ $kejadian->giatPmi?->evakuasiKorban?->keterangan ?? '' }}">
                                </div-->

                        <h6><b>Layanan Korban</b></h6>
                        <div class="form-group">
                            <label for="distribusi">Distribusi</label>
                            <input type="text" class="form-control" id="distribusi" name="distribusi"
                                value="{{ $kejadian->giatPmi?->layananKorban?->distribusi ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="dapur_umum">Dapur Umum</label>
                            <input type="text" class="form-control" id="dapur_umum" name="dapur_umum"
                                value="{{ $kejadian->giatPmi?->layananKorban?->dapur_umum ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="evakuasi">Evakuasi</label>
                            <input type="text" class="form-control" id="evakuasi" name="evakuasi"
                                value="{{ $kejadian->giatPmi?->layananKorban?->evakuasi ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="layanan_kesehatan">Layanan Kesehatan</label>
                            <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan"
                                value="{{ $kejadian->giatPmi?->layananKorban?->layanan_kesehatan ?? '' }}">
                        </div>


                        <div class="form-group">
                            <label for="giat_pemerintah">Giat Pemerintah</label>
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
                                value="{{ $kejadian->hambatan }}">
                        </div>

                        <h4 class="card-title">Data Personil Narahubung</h4>

                        <div id="form_area_cp">
                            <button type="button" class="btn btn-primary" id="add-narahubung">Input Personil
                                Narahubung</button>
                            <br>
                            <p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Personil yang dapat
                                dihubungi</p>

                            <div id="narahubung-container">
                                @if($kejadian->narahubung->isNotEmpty())
                                    @foreach($kejadian->narahubung as $index => $narahubung)
                                        <div class="narahubung-item mb-3">
                                            <h5>Narahubung #{{ $index + 1 }}</h5>
                                            <input type="hidden" name="narahubung[{{ $index }}][id_narahubung]"
                                                value="{{ $narahubung->id_narahubung }}">
                                            <div class="form-group">
                                                <label for="nama_lengkap_{{ $index }}">Nama Lengkap</label>
                                                <input type="text" class="form-control"
                                                    name="narahubung[{{ $index }}][nama_lengkap]" id="nama_lengkap_{{ $index }}"
                                                    value="{{ $narahubung->nama_lengkap }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="posisi_{{ $index }}">Posisi</label>
                                                <input type="text" class="form-control" name="narahubung[{{ $index }}][posisi]"
                                                    id="posisi_{{ $index }}" value="{{ $narahubung->posisi }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak_{{ $index }}">Kontak</label>
                                                <input type="phone" class="form-control" name="narahubung[{{ $index }}][kontak]"
                                                    id="kontak_{{ $index }}" value="{{ $narahubung->kontak }}">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-narahubung">Hapus</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let narahubungCount = {{ $kejadian->narahubung->count() }};
                                const addNarahubungBtn = document.getElementById('add-narahubung');
                                const narahubungContainer = document.getElementById('narahubung-container');

                                addNarahubungBtn.addEventListener('click', function () {
                                    const newNarahubung = document.createElement('div');
                                    newNarahubung.className = 'narahubung-item mb-3';
                                    newNarahubung.innerHTML = `
                                            <h5>Narahubung Baru #${narahubungCount + 1}</h5>
                                            <div class="form-group">
                                                <label for="nama_lengkap_${narahubungCount}">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="narahubung[${narahubungCount}][nama_lengkap]" id="nama_lengkap_${narahubungCount}">
                                            </div>
                                            <div class="form-group">
                                                <label for="posisi_${narahubungCount}">Posisi</label>
                                                <input type="text" class="form-control" name="narahubung[${narahubungCount}][posisi]" id="posisi_${narahubungCount}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak_${narahubungCount}">Kontak</label>
                                                <input type="phone" class="form-control" name="narahubung[${narahubungCount}][kontak]" id="kontak_${narahubungCount}">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-narahubung">Hapus</button>
                                        `;

                                    narahubungContainer.appendChild(newNarahubung);
                                    narahubungCount++;
                                });

                                narahubungContainer.addEventListener('click', function (e) {
                                    if (e.target && e.target.classList.contains('remove-narahubung')) {
                                        e.target.closest('.narahubung-item').remove();
                                    }
                                });
                            });
                        </script>

                        <div id="form_area_cp">
                            <button type="button" class="btn btn-primary" id="add-petugas-posko">Input Petugas
                                Posko</button>
                            <br>
                            <p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Petugas Posko</p>

                            <div id="petugas-posko-container">
                                @if($kejadian->petugasPosko->isNotEmpty())
                                    @foreach($kejadian->petugasPosko as $index => $petugasPosko)
                                        <div class="petugas-posko-item mb-3">
                                            <h5>Petugas Posko #{{ $index + 1 }}</h5>
                                            <input type="hidden" name="petugasPosko[{{ $index }}][id_petugas_posko]"
                                                value="{{ $petugasPosko->id_petugas_posko }}">
                                            <div class="form-group">
                                                <label for="nama_lengkap_{{ $index }}">Nama Lengkap</label>
                                                <input type="text" class="form-control"
                                                    name="petugasPosko[{{ $index }}][nama_lengkap]"
                                                    id="nama_lengkap_{{ $index }}" value="{{ $petugasPosko->nama_lengkap }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak_{{ $index }}">Kontak</label>
                                                <input type="phone" class="form-control"
                                                    name="petugasPosko[{{ $index }}][kontak]" id="kontak_{{ $index }}"
                                                    value="{{ $petugasPosko->kontak }}">
                                            </div>
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-petugas-posko">Hapus</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                let petugasPoskoCount = {{ $kejadian->petugasPosko->count() }};
                                const addPetugasPoskoBtn = document.getElementById('add-petugas-posko');
                                const petugasPoskoContainer = document.getElementById('petugas-posko-container');

                                addPetugasPoskoBtn.addEventListener('click', function () {
                                    const newPetugasPosko = document.createElement('div');
                                    newPetugasPosko.className = 'petugas-posko-item mb-3';
                                    newPetugasPosko.innerHTML = `
                                            <h5>Petugas Posko Baru #${petugasPoskoCount + 1}</h5>
                                            <div class="form-group">
                                                <label for="nama_lengkap2_${petugasPoskoCount}">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="petugasPosko[${petugasPoskoCount}][nama_lengkap]" id="nama_lengkap_${petugasPoskoCount}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak2_${petugasPoskoCount}">Kontak</label>
                                                <input type="phone" class="form-control" name="petugasPosko[${petugasPoskoCount}][kontak]" id="kontak_${petugasPoskoCount}">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-petugas-posko">Hapus</button>
                                        `;

                                    petugasPoskoContainer.appendChild(newPetugasPosko);
                                    petugasPoskoCount++;
                                });

                                petugasPoskoContainer.addEventListener('click', function (e) {
                                    if (e.target && e.target.classList.contains('remove-petugas-posko')) {
                                        e.target.closest('.petugas-posko-item').remove();
                                    }
                                });
                            });
                        </script>

                        <h4 class="card-title">Dokumentasi</h4>
                        <div id="dokumentasi-container">
                            @foreach($kejadian->dokumentasi as $index => $dokumentasi)
                                <div class="form-group dokumentasi-item">
                                    <label>File Dokumentasi {{ $index + 1 }}</label>
                                    <input type="hidden" name="dokumentasi[{{ $index }}][id_dokumentasi]"
                                        value="{{ $dokumentasi->id_dokumentasi }}">
                                    <input type="hidden" name="dokumentasi[{{ $index }}][delete]" class="delete-flag"
                                        value="0">
                                    <input type="file" name="dokumentasi[{{ $index }}][file_dokumentasi]"
                                        class="file-upload-default" style="display: none;">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            value="{{ $dokumentasi->file_dokumentasi }}">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            <button class="btn btn-danger remove-dokumentasi" type="button">Hapus</button>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="add-dokumentasi" class="btn btn-success mb-3">Tambah
                            Dokumentasi</button>

                        <script>
                            $(document).ready(function () {
                                let dokumentasiIndex = {{ $kejadian->dokumentasi->count() }};

                                function initFileUpload() {
                                    $('.file-upload-browse').off('click').on('click', function () {
                                        var fileInput = $(this).parents('.form-group').find('.file-upload-default');
                                        fileInput.trigger('click');
                                    });

                                    $('.file-upload-default').off('change').on('change', function () {
                                        var fileName = $(this).val().split('\\').pop();
                                        $(this).parent().find('.form-control').val(fileName);
                                    });
                                }

                                initFileUpload();

                                $('#add-dokumentasi').click(function () {
                                    let newDokumentasi = `
                                        <div class="form-group dokumentasi-item">
                                            <label>File Dokumentasi ${dokumentasiIndex + 1}</label>
                                            <input type="file" name="dokumentasi[${dokumentasiIndex}][file_dokumentasi]" class="file-upload-default" style="display: none;">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                    <button class="btn btn-danger remove-dokumentasi" type="button">Hapus</button>
                                                </span>
                                            </div>
                                        </div>
                                    `;
                                    $('#dokumentasi-container').append(newDokumentasi);
                                    dokumentasiIndex++;
                                    initFileUpload();
                                });

                                $(document).on('click', '.remove-dokumentasi', function () {
                                    var item = $(this).closest('.dokumentasi-item');
                                    item.find('.delete-flag').val('1');
                                    item.hide();  // Sembunyikan item tapi jangan hapus dari DOM
                                });
                            });
                        </script>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">Update Laporan Situasi</button>
                            <a href="{{ route('relawan-lapsit', $kejadian->id_kejadian) }}"
                                class="btn btn-light">Cancel</a>
                        </div>
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
        </script>