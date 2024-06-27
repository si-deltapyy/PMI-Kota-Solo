@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
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
                                
                                <div class="form-group">
                                    <label for="kejadian_musibah">Kejadian Bencana</label>
                                    <select name="id_jeniskejadian" id="kejadian_musibah" class="form-control form-control-sm" placeholder="- Pilih Jenis Kejadian -" disabled>
                                        <option value="">- Pilih Jenis Kejadian -</option>
                                        @foreach($jenisKejadian as $jenis)
                                        <option value="{{ $jenis-> id_jeniskejadian }}" {{ $jenis->id_jeniskejadian == $kejadian->id_jeniskejadian ? 'selected' : '' }}>
                                            {{ $jenis-> nama_kejadian }}
                                        </option>
                                        @endforeach
                                    </select>

                                    <!--input type="text" class="form-control" name="nama_kejadian" id="nama_kejadian" value="{{ $kejadian->nama_kejadian }}" placeholder="Nama Kejadian" disabled-->
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{old('lokasi', $kejadian->lokasi)}}" placeholder="Lokasi" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Waktu Kejadian</label>
                                    <input type="date" class="form-control" name="waktu_kejadian" id="waktu_kejadian" value="{{old('tanggal_kejadian', $kejadian->tanggal_kejadian)}}" placeholder="Waktu Kejadian" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" name="update" id="update" placeholder="Update">
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
                                
                                <!--script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        let dokumentasiCount = 0;
                                        const addDokumentasiBtn = document.getElementById('add-dokumentasi');
                                        const dokumentasiContainer = document.getElementById('dokumentasi-container');

                                        addDokumentasiBtn.addEventListener('click', function() {
                                            const newDokumentasi = document.createElement('div');
                                            newDokumentasi.className = 'dokumentasi-item mb-3';
                                            newDokumentasi.innerHTML = `
                                                <h5>File Dokumentasi #${dokumentasiCount + 1}</h5>
                                                <div class="form-group">
                                                    <label for="file_dokumentasi_${dokumentasiCount}">File upload</label>
                                                    <input type="file" name="dokumentasi[]" class="file-upload-default" id="file_dokumentasi_${dokumentasiCount}" accept=".jpg, .jpeg, .png">
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm remove-dokumentasi">Hapus</button>
                                            `;
                                            
                                            dokumentasiContainer.appendChild(newDokumentasi);
                                            dokumentasiCount++;

                                            initFileUpload(newDokumentasi.querySelector('.file-upload-default'));
                                        });

                                        dokumentasiContainer.addEventListener('click', function(e) {
                                            if (e.target && e.target.classList.contains('remove-dokumentasi')) {
                                                e.target.closest('.dokumentasi-item').remove();
                                            }
                                        });

                                        function initFileUpload(input) {
                                            const parent = input.parentElement;
                                            const fileUploadInfoInput = parent.querySelector('.file-upload-info');
                                            const fileUploadBrowseButton = parent.querySelector('.file-upload-browse');

                                            fileUploadBrowseButton.addEventListener('click', function() {
                                                input.click();
                                            });

                                            input.addEventListener('change', function() {
                                                const fileName = input.files[0] ? input.files[0].name : 'No file chosen';
                                                fileUploadInfoInput.value = fileName;
                                            });
                                        }
                                    });
                                </script-->

                                <div class="form-group">
                                    <label>Pemerintah membutuhkan Dukungan Internasional</label>
                                    <select class="js-example-basic-single w-100" id="dukungan_internasional" name="dukungan_internasional">
                                        <option value="Ya" {{$kejadian->dukungan_internasional == 'Ya' ? 'selected' : ''}}>Ya</option>
                                        <option value="Tidak" {{$kejadian->dukungan_internasional == 'Tidak' ? 'selected' : ''}}>Tidak</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Gambaran Umum Situasi</label>
                                    <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Deskripsi Situasi">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="js-example-basic-single w-100" name="akses_ke_lokasi" disabled>
                                        <option value="Accessible" {{$kejadian->akses_ke_lokasi == 'Accessible' ? 'selected' : ''}}>Accessible</option>
                                        <option value="Not Accessible" {{$kejadian->akses_ke_lokasi == 'Not Accessible' ? 'selected' : ''}}>Not Accessible</option>
                                    </select>
                                </div>

                                <!--================================= KODE 26/6/2024 (COBA FORM-NYA DI LUAR) =================================-->

                                <h4 class="card-title" id="subtitle">Korban Terdampak</h4>
                                <div class="form-group">
                                    
                                        <div class="form-group">
                                            <label for="kk">Jumlah KK</label>
                                            <input type="number" class="form-control" id="kk" name="kk" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jiwa">Jumlah Orang</label>
                                            <input type="number" class="form-control" id="jiwa" name="jiwa" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="luka_berat">Luka Berat</label>
                                            <input type="number" class="form-control" id="luka_berat" name="luka_berat" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="luka_ringan">Luka Ringan</label>
                                            <input type="number" class="form-control" id="luka_ringan" name="luka_ringan" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="meninggaljlw">Meninggal</label>
                                            <input type="number" class="form-control" id="meninggaljlw" name="meninggaljlw" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="hilang">Hilang</label>
                                            <input type="number" class="form-control" id="hilang" name="hilang" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="mengungsi">Mengungsi</label>
                                            <input type="number" class="form-control" id="mengungsi" name="mengungsi" placeholder="Masukan jumlah">
                                        </div>
                                </div>

                                <h4 class="card-title" id="subtitle">Fasilitas/Rumah Terdampak</h4>
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" id="rusak_berat" name="rusak_berat" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" id="rusak_sedang" name="rusak_sedang" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                        <input type="number" class="form-control" id="rusak_ringan" name="rusak_ringan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="sekolah">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" id="sekolah" name="sekolah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" id="tempat_ibadah" name="tempat_ibadah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control" id="rumah_sakit" name="rumah_sakit" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasar">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" id="pasar" name="pasar" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" id="gedung_pemerintah" name="gedung_pemerintah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="lain_lain">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" id="lain_lain" name="lain_lain" placeholder="Masukan jumlah">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_kerusakan">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" id="desc_kerusakan" name="desc_kerusakan" placeholder="Deskripsi Kerusakan">
                                    </div>
                                </div>

                                <h4 class="card-title" id="subtitle">Personil</h4>
                                <div class="form-group">

                                    <div class="form-group">
                                        <label for="pengurus">Pengurus</label>
                                        <input type="number" class="form-control" id="pengurus" name="pengurus" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staf_markas_kabkot">Staf Markas Kab/Kota</label>
                                        <input type="number" class="form-control" id="staf_markas_kabkot" name="staf_markas_kabkot" placeholder="Masukan jumlah">
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
                                        <label for="relawan_pmi_kabkot">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="relawan_pmi_kabkot" name="relawan_pmi_kabkot" placeholder="Masukan jumlah">
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
                                        <input type="number" class="form-control" id="gedung_lapangan" name="gedung_lapangan" placeholder="Masukan jumlah">
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
                                {{-- Input Dampak --}}
                                <!--div class="form-group">
                                    <button type="button" id="dampak" class="btn btn-primary me-2">Input Dampak</button>
                                </div>

                                <div id="form_jumlah_kk" style="display:none;">
                                    <p class="card-description" id="subtitle">
                                        Korban Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="kk">Jumlah KK</label>
                                        <input type="number" class="form-control" id="kk" name="kk" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="jiwa">Jumlah Orang</label>
                                        <input type="number" class="form-control" id="jiwa" name="jiwa" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" id="luka_berat" name="luka_berat" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_ringan">Luka Ringan</label>
                                        <input type="number" class="form-control" id="luka_ringan" name="luka_ringan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Meninggal</label>
                                        <input type="number" class="form-control" id="meninggal" name="meninggal" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="hilang">Hilang</label>
                                        <input type="number" class="form-control" id="hilang" name="hilang" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" id="mengungsi" name="mengungsi" placeholder="Masukan jumlah">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Fasilitas/Rumah Terdampak
                                    </p>
                                    <div class="form-group">
                                        <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                        <input type="number" class="form-control" id="rusak_berat" name="rusak_berat" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                        <input type="number" class="form-control" id="rusak_sedang" name="rusak_sedang" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                        <input type="number" class="form-control" id="rusak_ringan" name="rusak_ringan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="sekolah">Kerusakan Sekolah</label>
                                        <input type="number" class="form-control" id="sekolah" name="sekolah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                        <input type="number" class="form-control" id="tempat_ibadah" name="tempat_ibadah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                        <input type="number" class="form-control" id="rumah_sakit" name="rumah_sakit" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasar">Kerusakan Pasar</label>
                                        <input type="number" class="form-control" id="pasar" name="pasar" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                        <input type="number" class="form-control" id="gedung_pemerintah" name="gedung_pemerintah" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="lain_lain">Kerusakan Lain Lain</label>
                                        <input type="number" class="form-control" id="lain_lain" name="lain_lain" placeholder="Masukan jumlah">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_kerusakan">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" id="desc_kerusakan" name="desc_kerusakan" placeholder="Deskripsi Kerusakan">
                                    </div>
                                </div-->

                                <!--================================= KODE 27/6/2024 (COBA KODE SEKAR) =================================-->

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

                                <!--div class="form-group">
                                    <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                        Pengungsian</button>
                                </div>

                                <div id="form_area">
                                    <div id="form_pengungsian" style="display:none;">
                                        <p class="card-description" id="subtitle">Pengungsian</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" class="form-control" id="nama_lokasi" name="pengungsian[0][nama_lokasi]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kk">KK</label>
                                            <input type="number" class="form-control" id="jumlah_kk" name="pengungsian[0][jumlah_kk]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_orang">Jiwa</label>
                                            <input type="number" class="form-control" id="jumlah_orang" name="pengungsian[0][jumlah_orang]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki">Laki-Laki</label>
                                            <input type="number" class="form-control" id="laki_laki" name="pengungsian[0][laki_laki]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan">Perempuan</label>
                                            <input type="number" class="form-control" id="perempuan" name="pengungsian[0][perempuan]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" id="kurang_dari_5" name="pengungsian[0][kurang_dari_5]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="atr_5_sampai_18">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" id="atr_5_sampai_18" name="pengungsian[0][atr_5_sampai_18]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                            <input type="number" class="form-control" id="lebih_dari_18" name="pengungsian[0][lebih_dari_18]" placeholder="Masukan jumlah">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" id="jumlah" name="pengungsian[0][jumlah]" placeholder="Masukan jumlah">
                                        </div>
                                    </div>
                                </div-->

                                {{-- Personil --}}
                                <!--div class="form-group">
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
                                        <input type="number" class="form-control" id="staff_markas_kabkot" name="staff_markas_kabkot" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_prov">Staf Markas Provinsi</label>
                                        <input type="number" class="form-control" id="staff_markas_prov" name="staff_markas_prov" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="staff_markas_pusat">Staf Markas Pusat</label>
                                        <input type="number" class="form-control" id="staff_markas_pusat" name="staff_markas_pusat" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="relawan_pmi_kabkot">Relawan PMI Kab/Kota</label>
                                        <input type="number" class="form-control" id="relawan_pmi_kabkot" name="relawan_pmi_kabkot" placeholder="Masukan jumlah">
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
                                        <label for="sukarelawan_sp">Sukarelawan Spesialis</label>
                                        <input type="number" class="form-control" id="sukarelawan_sp" name="sukarelawan_sp" placeholder="Masukan jumlah">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Spesialis
                                    </p>
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
                                        <label for="kend_ops">Kend. Ops</label>
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
                                        <input type="number" class="form-control" id="gedung_lapangan" name="gedung_lapangan" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="posko_aju">Posko Aju</label>
                                        <input type="number" class="form-control" id="mengungsi" name="posko_aju" placeholder="Masukan jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label for="alat_it_lapangan">Alat IT/Tel Lapangan</label>
                                        <input type="number" class="form-control" id="alat_it_lapangan" name="alat_it_lapangan" placeholder="Masukan jumlah">
                                    </div>
                                </div-->


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

                                <h4 class="card-title">Layanan Korban Bencana</h4>
                                <!--div class="form-group">
                                    <label for="assessment">Assessment</label>
                                    <input type="text" class="form-control" id="assessment" name="assessment" placeholder="rincian assessment">
                                </div-->
                                <!--div class="form-group">
                                    <label>Assessment</label>
                                    <select class="js-example-basic-single w-100" id="assessment" name="assessment" disabled>
                                        <option value="On Process" {{$kejadian->assessment == 'On Process' ? 'selected' : ''}}>On Process</option>
                                        <option value="Aktif" {{$kejadian->assessment == 'Aktif' ? 'selected' : ''}}>Aktif</option>
                                        <option value="Selesai" {{$kejadian->assessment == 'Selesai' ? 'selected' : ''}}>Selesai</option>
                                    </select>
                                </div-->

                                <div class="form-group">
                                    <label for="distribusi">Distribusi</label>
                                    <input type="text" class="form-control" id="distribusi" name="distribusi" placeholder="Rincian distribusi">
                                </div>

                                <div class="form-group">
                                    <label for="evakuasi">Evakuasi</label>
                                    <input type="text" class="form-control" id="evakuasi" name="evakuasi" placeholder="Rincian evakuasi">
                                </div>

                                <div class="form-group">
                                    <label for="dapur_umum">Dapur Umum</label>
                                    <input type="text" class="form-control" id="dapur_umum" name="dapur_umum" placeholder="Rincian dapur umum">
                                </div>

                                <div class="form-group">
                                    <label for="layanan_kesehatan">Layanan Kesehatan</label>
                                    <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan" placeholder="Rincian layanan kesehatan">
                                </div>

                                <div class="form-group">
                                    <label for="giat_pemerintah">Giat Pemerintahan</label>
                                    <!--select class="js-example-basic-single w-100" name="giat_pemerintah">
                                        <option value="Ya" {{$kejadian->giat_pemerintah == 'Ya' ? 'selected' : ''}}>Ya</option>
                                        <option value="Tidak" {{$kejadian->giat_pemerintah == 'Tidak' ? 'selected' : ''}}>Tidak</option>
                                    </select-->
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

                                <!--================================= KODE 27/6/2024 (COBA KODE SEKAR) =================================-->

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

                                
