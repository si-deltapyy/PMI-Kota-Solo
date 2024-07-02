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
                            
                            <form action="{{ route('store-lapsit', $kejadian->id_assessment) }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="id_relawan" value="{{auth()->user()->id}}">
                                <input type="hidden" name="id_admin" value="1">
                                <input type="hidden" name="id_report" value="{{ $report}}">
                                {{-- <input type="hidden" name="id_personil" value="{{$personil->id_personil}}">
                                <input type="hidden" name="id_tsr" value="{{$tsr->id_tsr}}">
                                <input type="hidden" name="id_alat_tdb" value="{{$alat_tdb->id_alat_tdb}}"> --}}
                                <input type="hidden" name="id_jeniskejadian" value="{{ $jeniskejadian->id_jeniskejadian }}">
                                <div class="form-group">
                                    <label for="kejadian_musibah">Jenis Kejadian Bencana</label>
                                    <input type="text" class="form-control"value="{{ $jeniskejadian->nama_kejadian }}" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="waktu_kejadian">Tanggal Kejadian</label>
                                    <input type="date" class="form-control" id="waktu_kejadian" name="tanggal_kejadian" value="{{ $kejadian->tanggal_kejadian }}" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ $kejadian->lokasi }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" id="update" name="update">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                                </div>

                                <div class="form-group">
                                    <label>Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="form-control" name="dukungan_internasional">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak" >Tidak</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="form-control" id="akses_ke_lokasi" name="akses_ke_lokasi" style="background-color: white; color: black;">
                                        <option value="Accessible">Aman</option>
                                        <option value="Not Accessible">Tidak Aman</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="kebutuhan">Kebutuhan</label>
                                    <input type="text" class="form-control" name="kebutuhan" id="kebutuhan">
                                </div>
                                
                                <div class="form-group">
                                    <label for="kebutuhan">Giat Pemerintah</label>
                                    <input type="text" class="form-control" name="giat_pemerintah" id="giat_pemerintah">
                                </div>
                                
                                <div class="form-group">
                                    <label for="kebutuhan">Hambatan</label>
                                    <input type="text" class="form-control" name="hambatan" id="hambatan">
                                </div>
                                {{-- INPUT DAMPAK --}}
                                <h4 class="card-title">Data Dampak Kejadian</h4>

                                <div id="form_jumlah_kk">
                                    <h6><b>Korban Terdampak</b></h6>
                                    <div class="form-group">
                                        <label for="kk">Jumlah KK</label>
                                        <input type="number" class="form-control" name="kk" id="kk">
                                    </div>
                                    <div class="form-group">
                                        <label for="jiwa">Jumlah Orang</label>
                                        <input type="number" class="form-control" name="jiwa" id="jiwa">                                    
                                    </div>
                                    <h6><b>Korban Jiwa/Luka/Mengungsi</b></h6>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" name="luka_berat" id="luka_berat">                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_ringan">Luka Ringan</label>
                                        <input type="number" class="form-control" name="luka_ringan" id="luka_ringan">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggaljlw">Meninggal</label>
                                        <input type="number" class="form-control" name="meninggal" id="meninggal">
                                    </div>
                                    <div class="form-group">
                                        <label for="hilang">Hilang</label>
                                        <input type="number" class="form-control" name="hilang" id="hilang">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" name="mengungsi" id="mengungsi">
                                    </div>

                                    <h6><b>Kerusakan Rumah</b></h6>

                                    <div class="form-group">
                                        <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" name="rusak_berat" id="rusak_berat">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" name="rusak_sedang" id="rusak_sedang">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                        <input type="number" class="form-control" name="rusak_ringan" id="rusak_ringan">
                                    </div>

                                    <h6><b>Kerusakan Fasilitas Sosial & Infrastruktur</b></h6>
                                    <div class="form-group">
                                        <label for="sekolah">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" name="sekolah" id="sekolah">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" name="tempat_ibadah" id="tempat_ibadah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control"  name="rumah_sakit" id="rumah_sakit">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasar">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" name="pasar" id="pasar">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" name="gedung_pemerintah" id="gedung_pemerintah">
                                    </div>
                                    <div class="form-group">
                                        <label for="lain_lain">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" name="lain_lain" id="lain_lain">
                                    </div>

                                    <h6><b>Kerusakan Infrastruktur</b></h6>

                                    <div class="form-group">
                                        <label for="desc_kerusakan">Deskripsi Kerusakan</label>
                                        <input type="text" class="form-control" name="desc_kerusakan" id="desc_kerusakan">
                                    </div>
                                </div> 
                                {{-- Input Giat PMI --}}
                                <div class="form-group">

                                    <h4 class="card-title">Data Giat PMI</h4>
                                    <h6><b>Evakuasi Korban</b></h6>
                                    <div class="form-group">
                                        <label for="luka_ringanberat">Luka Ringan/Berat</label>
                                        <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggalevakuasi">Meninggal</label>
                                        <input type="number" class="form-control" id="meninggalevakuasi" name="meninggalevakuasi">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan_evakuasi" name="keterangan_evakuasi">
                                    </div>

                                    <h6><b>Layanan Korban</b></h6>
                                    <div class="form-group">
                                        <label for="distribusi">Distribusi</label>
                                        <input type="text" class="form-control" id="distribusi" name="distribusi">
                                    </div>
                                    <div class="form-group">
                                        <label for="dapur_umum">Dapur Umum</label>
                                        <input type="text" class="form-control" id="dapur_umum" name="dapur_umum">
                                    </div>
                                    <div class="form-group">
                                        <label for="evakuasi">Evakuasi</label>
                                        <input type="text" class="form-control" id="evakuasi" name="evakuasi">
                                    </div>
                                    <div class="form-group">
                                        <label for="layanan_kesehatan">Layanan Kesehatan</label>
                                        <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan">
                                    </div>
                                </div>

                                <h4 class="card-title">Lampiran Dokumentasi</h4>

                                <div id="form_area_cp">
                                    <!--button type="button" class="btn btn-primary" id="add-dokumentasi">Input File Dokumentasi</button-->
                                    <br>
                                    <div id="dokumentasi-container">
                                    
                                    </div>
                                </div>
                                <button type="button" id="add-dokumentasi" class="btn btn-success mb-3">Tambah Dokumentasi</button>

                            <script>
                            $(document).ready(function() {
                                let dokumentasiIndex = 0;

                                function initFileUpload() {
                                    $('.file-upload-browse').off('click').on('click', function() {
                                        var fileInput = $(this).parents('.form-group').find('.file-upload-default');
                                        fileInput.trigger('click');
                                    });

                                    $('.file-upload-default').off('change').on('change', function() {
                                        var fileName = $(this).val().split('\\').pop();
                                        $(this).parent().find('.form-control').val(fileName);
                                    });
                                }

                                initFileUpload();

                                $('#add-dokumentasi').click(function() {
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

                                $(document).on('click', '.remove-dokumentasi', function() {
                                    var item = $(this).closest('.dokumentasi-item');
                                    item.find('.delete-flag').val('1');
                                    item.hide();  // Sembunyikan item tapi jangan hapus dari DOM
                                });
                            });
                            </script>

                                <h4 class="card-title" id="subtitle">Personil</h4>
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="pengurus">Pengurus</label>
                                        <input type="number" class="form-control" id="pengurus" name="pengurus" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staf_markas_kabkot">Staf Markas Kab/Kota</label>
                                        <input type="number" class="form-control" id="staf_markas_kabkot" name="staf_markas_kabkota" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staf_markas_prov">Staf Markas Provinsi</label>
                                        <input type="number" class="form-control" id="staf_markas_prov" name="staf_markas_prov" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staf_markas_pusat">Staf Markas Pusat</label>
                                        <input type="number" class="form-control" id="staf_markas_pusat" name="staf_markas_pusat" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_kabkota">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="relawan_pmi_kabkota" name="relawan_pmi_kabkota" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_prov">Relawan PMI Provinsi</label>
                                        <input type="number" class="form-control" id="relawan_pmi_prov" name="relawan_pmi_prov" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_linprov">Relawan Lintas Provinsi</label>
                                        <input type="number" class="form-control" id="relawan_pmi_linprov" name="relawan_pmi_linprov" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="sukarelawan_sip">Sukarelawan Spesialis</label>
                                        <input type="number" class="form-control" id="sukarelawan_sip" name="sukarelawan_sip" placeholder="Masukan jumlah">
                                    </div>
                                </div>

                                <h4 class="card-title" id="subtitle">Spesialis</h4>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="medis">Medis</label>
                                        <input type="number" class="form-control" id="medis" name="medis" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="paramedis">Paramedis</label>
                                        <input type="number" class="form-control" id="paramedis" name="paramedis" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="relief">Relief</label>
                                        <input type="number" class="form-control" id="relief" name="relief" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="logistik">Logistik</label>
                                        <input type="number" class="form-control" id="logistik" name="logistik" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="watsan">Watsan</label>
                                        <input type="number" class="form-control" id="watsan" name="watsan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="it_telekom">IT Telekom</label>
                                        <input type="number" class="form-control" id="it_telekom" name="it_telekom" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="sheltering">Sheltering</label>
                                        <input type="number" class="form-control" id="sheltering" name="sheltering" placeholder="Masukan jumlah">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Alat Utama
                                    </p>
                                    <div class="form-group">
                                        <label for="kend_ops">Kendaraan Operasional</label>
                                        <input type="number" class="form-control" id="kend_ops" name="kend_ops" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_angkut">Truk Angkutan</label>
                                        <input type="number" class="form-control" id="truk_angkut" name="truk_angkut" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="truk_tanki">Truk Tangki</label>
                                        <input type="number" class="form-control" id="truk_tanki" name="truk_tanki" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="double_cabin">Double Cabin</label>
                                        <input type="number" class="form-control" id="double_cabin" name="double_cabin" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_du">Alat DU</label>
                                        <input type="number" class="form-control" id="alat_du" name="alat_du" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="ambulans">Ambulans</label>
                                        <input type="number" class="form-control" id="ambulans" name="ambulans" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_watsan">Alat Watsan</label>
                                        <input type="number" class="form-control" id="alat_watsan" name="alat_watsan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rs_lapangan">RS Lapangan</label>
                                        <input type="number" class="form-control" id="rs_lapangan" name="rs_lapangan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_pkdd">Alat PKDD</label>
                                        <input type="number" class="form-control" id="alat_pkdd" name="alat_pkdd" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_lapangan">Gudang Lapangan</label>
                                        <input type="number" class="form-control" id="gudang_lapangan" name="gudang_lapangan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="posko_aju">Posko Aju</label>
                                        <input type="number" class="form-control" id="mengungsi" name="posko_aju" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_it_lapangan">Alat IT/Tel Lapangan</label>
                                        <input type="number" class="form-control" id="alat_it_lapangan" name="alat_it_lapangan" placeholder="Masukan jumlah">
                                    </div>
                                </div>
                                {{-- Tambah Pengungsian --}}
                                <h6><b>Pengungsian</b></h6>

                                <div id="form_area">
                                <button type="button" id="add-pengungsian" class="btn btn-primary me-2">Input Pengungsian</button>
                                <br>
                                <!--p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Pengungsian</p-->
                                <div id="pengungsian-container">
                                    
                                </div>
                            </div>

                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let pengungsianCount = 0;
                                const addPengungsianBtn = document.getElementById('add-pengungsian');
                                const pengungsianContainer = document.getElementById('pengungsian-container');

                                addPengungsianBtn.addEventListener('click', function() {
                                    const newPengungsian = document.createElement('div');
                                    newPengungsian.className = 'pengungsian-item mb-3';
                                    newPengungsian.innerHTML = `
                                        <h5>Pengungsian Baru #${pengungsianCount + 1}</h5>
                                        <div class="form-group">
                                            <label for="nama_lokasi_${pengungsianCount}">Nama Lokasi</label>
                                            <input type="text" class="form-control" name="pengungsian[${pengungsianCount}][nama_lokasi]" id="nama_lokasi_${pengungsianCount}" placeholder="Masukan nama lokasi">
                                        </div>
                                        <div class="form-group">
                                            <label for="kk_${pengungsianCount}">KK</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][kk]" id="kk_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jiwa_${pengungsianCount}">Jiwa</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][jiwa]" id="jiwa_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki_${pengungsianCount}">Laki-laki</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][laki_laki]" id="laki_laki_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan_${pengungsianCount}">Perempuan</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][perempuan]" id="perempuan_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5_${pengungsianCount}">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][kurang_dari_5]" id="kurang_dari_5_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="atr_5_sampai_18_${pengungsianCount}">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][atr_5_sampai_18]" id="atr_5_sampai_18_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18_${pengungsianCount}">Lebih dari 18 Tahun</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][lebih_dari_18]" id="lebih_dari_18_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_${pengungsianCount}">Jumlah</label>
                                            <input type="number" class="form-control" name="pengungsian[${pengungsianCount}][jumlah]" id="jumlah_${pengungsianCount}" placeholder="Masukan jumlah">
                                        </div>
                                        <button type="button" class="btn btn-danger btn-sm remove-pengungsian">Hapus</button>
                                    `;
                                    
                                    pengungsianContainer.appendChild(newPengungsian);
                                    pengungsianCount++;
                                });

                                pengungsianContainer.addEventListener('click', function(e) {
                                    if (e.target && e.target.classList.contains('remove-pengungsian')) {
                                        e.target.closest('.pengungsian-item').remove();
                                    }
                                });
                            });
                            </script>

                                <h4 class="card-title">Evakuasi Korban Luka</h4>
                                <div class="form-group">
                                    <label for="luka_ringanberat">Luka Ringan/Berat</label>
                                    <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat" placeholder="Masukan jumlah">

                                    <!--label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Rincian korban luka"-->
                                </div>
                                <div class="form-group">
                                    <label for="meninggalevakuasi">Meninggal</label>
                                    <input type="number" class="form-control" id="meninggalevakuasi" name="meninggalevakuasi" placeholder="Masukan jumlah">

                                    <!--label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Rincian korban meninggal"-->
                                </div>

                                <h4 class="card-title">Data Personil Narahubung</h4>

                                <div id="form_area_cp">
                                    <button type="button" class="btn btn-primary" id="add-narahubung">Input Personil Narahubung</button>
                                    <br>
                                    <!--p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Personil yang dapat dihubungi</p-->
                                    
                                    <div id="narahubung-container">
                                        
                                            
                                        
                                    </div>
                                </div>

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let narahubungCount = 0;
                                    const addNarahubungBtn = document.getElementById('add-narahubung');
                                    const narahubungContainer = document.getElementById('narahubung-container');

                                    addNarahubungBtn.addEventListener('click', function() {
                                        const newNarahubung = document.createElement('div');
                                        newNarahubung.className = 'narahubung-item mb-3';
                                        newNarahubung.innerHTML = `
                                            <h5>Narahubung Baru #${narahubungCount + 1}</h5>
                                            <div class="form-group">
                                                <label for="nama_lengkap_${narahubungCount}">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="narahubung[${narahubungCount}][nama_lengkap]" id="nama_lengkap_${narahubungCount}" placeholder="Masukan nama lengkap narahubung">
                                            </div>
                                            <div class="form-group">
                                                <label for="posisi_${narahubungCount}">Posisi</label>
                                                <input type="text" class="form-control" name="narahubung[${narahubungCount}][posisi]" id="posisi_${narahubungCount}" placeholder="Masukan posisi narahubung">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak_${narahubungCount}">Kontak</label>
                                                <input type="phone" class="form-control" name="narahubung[${narahubungCount}][kontak]" id="kontak_${narahubungCount}" placeholder="Masukan kontak narahubung">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-narahubung">Hapus</button>
                                        `;
                                        
                                        narahubungContainer.appendChild(newNarahubung);
                                        narahubungCount++;
                                    });

                                    narahubungContainer.addEventListener('click', function(e) {
                                        if (e.target && e.target.classList.contains('remove-narahubung')) {
                                            e.target.closest('.narahubung-item').remove();
                                        }
                                    });
                                });
                                </script>

                                <h4 class="card-title">Data Petugas Posko</h4>

                                <div id="form_area_cp">
                                    <button type="button" class="btn btn-primary" id="add-petugasPosko">Input Petugas Posko</button>
                                    <br>
                                    <!--p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Personil yang dapat dihubungi</p-->
                                    
                                    <div id="petugasPosko-container">
                                        
                                            
                                        
                                    </div>
                                </div>

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let petugasPoskoCount = 0;
                                    const addPetugasPoskoBtn = document.getElementById('add-petugasPosko');
                                    const petugasPoskoContainer = document.getElementById('petugasPosko-container');

                                    addPetugasPoskoBtn.addEventListener('click', function() {
                                        const newPetugasPosko = document.createElement('div');
                                        newPetugasPosko.className = 'petugasPosko-item mb-3';
                                        newPetugasPosko.innerHTML = `
                                            <h5>Petugas Posko Baru #${petugasPoskoCount + 1}</h5>
                                            <div class="form-group">
                                                <label for="nama_lengkap_${petugasPoskoCount}">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="petugasPosko[${petugasPoskoCount}][nama_lengkap]" id="nama_lengkap_${petugasPoskoCount}" placeholder="Masukan nama lengkap petugas">
                                            </div>
                                            <div class="form-group">
                                                <label for="kontak_${petugasPoskoCount}">Kontak</label>
                                                <input type="phone" class="form-control" name="petugasPosko[${petugasPoskoCount}][kontak]" id="kontak_${petugasPoskoCount}" placeholder="Masukan kontak petugas">
                                            </div>
                                            <button type="button" class="btn btn-danger btn-sm remove-petugasPosko">Hapus</button>
                                        `;
                                        
                                        petugasPoskoContainer.appendChild(newPetugasPosko);
                                        petugasPoskoCount++;
                                    });

                                    petugasPoskoContainer.addEventListener('click', function(e) {
                                        if (e.target && e.target.classList.contains('remove-petugasPosko')) {
                                            e.target.closest('.petugasPosko-item').remove();
                                        }
                                    });
                                });
                                </script>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ route('relawan-lapsit', $kejadian->id_kejadian) }}" class="btn btn-light">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
           
        </script>

                                
