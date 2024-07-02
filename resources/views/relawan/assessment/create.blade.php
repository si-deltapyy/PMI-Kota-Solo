@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Assessment</h4>
                            <!-- Update Alert-->
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif
                            <!-- End of Update Alert-->
                            {{--  @if($kejadian->giatPmi)
                                <p>{{ $kejadian->giatPmi->evakuasiKorban }}</p>
                            @else
                                <p>Data Giat PMI tidak tersedia.</p>
                            @endif

                            @if($kejadian->dampak)
                                <p>{{ $kejadian->dampak->korban_terdampak }}</p>
                            @else
                                <p>Data Dampak tidak tersedia.</p>
                            @endif  --}}
                            <form action="{{ url('/relawan/assessment/store') }}" method="POST" class="forms-sample" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_relawan" value="{{auth()->user()->id}}">
                                <input type="hidden" name="id_admin" value="1">
                                <input type="hidden" name="id_report" value="{{ $kejadian->id_report }}">
                                <input type="hidden" name="id_personil" value="{{$personil->id_personil}}">
                                <input type="hidden" name="id_tsr" value="{{$tsr->id_tsr}}">
                                <input type="hidden" name="id_alat_tdb" value="{{$alat_tdb->id_alat_tdb}}">
                                <input type="hidden" name="id_jeniskejadian" value="{{ $jeniskejadian->id_jeniskejadian }}">
                                {{-- <input type="hidden" name="id_admin" value="{{User::role('admin')->inRandomOrder()->first()}}"> --}}
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
                                    <input type="text" class="form-control" id="lokasi" name="lokasi">
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
                                {{-- Tambah Pengungsian --}}
                                {{-- <h6><b>Pengungsian</b></h6>

                                <div id="form_area">
                                <button type="button" id="add-pengungsian" class="btn btn-primary me-2">Input Pengungsian</button>
                                <br>
                                <p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Pengungsian</p>
                                <div id="pengungsian-container">
                                    @if($kejadian->dampak && $kejadian->dampak->pengungsian)
                                        @foreach($kejadian->dampak->pengungsian as $index => $pengungsian)
                                            <div class="pengungsian-item mb-3">
                                                <h5>Pengungsian #{{ $index + 1 }}</h5>
                                                <input type="hidden" name="pengungsian[{{ $index }}][id_pengungsian]" value="{{ $pengungsian->id_pengungsian }}">
                                                <div class="form-group">
                                                    <label for="nama_lokasi_{{ $index }}">Nama Lokasi</label>
                                                    <input type="text" class="form-control" name="pengungsian[{{ $index }}][nama_lokasi]" id="nama_lokasi_{{ $index }}" value="{{ $pengungsian->nama_lokasi }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kk_{{ $index }}">KK</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][kk]" id="kk_{{ $index }}" value="{{ $pengungsian->kk }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jiwa_{{ $index }}">Jiwa</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][jiwa]" id="jiwa_{{ $index }}" value="{{ $pengungsian->jiwa }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="laki_laki_{{ $index }}">Laki-Laki</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][laki_laki]" id="laki_laki_{{ $index }}" value="{{ $pengungsian->laki_laki }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="perempuan_{{ $index }}">Perempuan</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][perempuan]" id="perempuan_{{ $index }}" value="{{ $pengungsian->perempuan }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="kurang_dari_5_{{ $index }}">Kurang dari 5 Tahun</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][kurang_dari_5]" id="kurang_dari_5_{{ $index }}" value="{{ $pengungsian->kurang_dari_5 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="atr_5_sampai_18_{{ $index }}">Antara 5-18 Tahun</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][atr_5_sampai_18]" id="atr_5_sampai_18_{{ $index }}" value="{{ $pengungsian->atr_5_sampai_18 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lebih_dari_18_{{ $index }}">Lebih Dari 18 Tahun</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][lebih_dari_18]" id="lebih_dari_18_{{ $index }}" value="{{ $pengungsian->lebih_dari_18 }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="jumlah_{{ $index }}">Jumlah</label>
                                                    <input type="number" class="form-control" name="pengungsian[{{ $index }}][jumlah]" id="jumlah_{{ $index }}" value="{{ $pengungsian->jumlah }}">
                                                </div>
                                                <button type="button" class="btn btn-danger btn-sm remove-pengungsian">Hapus</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div> --}}
                            </div>

                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let pengungsianCount = {{ $kejadian->dampak && $kejadian->dampak->pengungsian ? $kejadian->dampak->pengungsian->count() : 0 }};
                                const addPengungsianBtn = document.getElementById('add-pengungsian');
                                const pengungsianContainer = document.getElementById('pengungsian-container');

                                addPengungsianBtn.addEventListener('click', function() {
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

                                pengungsianContainer.addEventListener('click', function(e) {
                                    if (e.target && e.target.classList.contains('remove-pengungsian')) {
                                        e.target.closest('.pengungsian-item').remove();
                                    }
                                });
                            });
                            </script>

{{--  giat pmi - evakuasi korban layanan korban  --}}
  
                                    
                                {{-- <h4 class="card-title">Data Personil Narahubung</h4>

                                <div id="form_area_cp">
                                    <button type="button" class="btn btn-primary" id="add-narahubung">Input Personil Narahubung</button>
                                    <br>
                                    <p class="card-description" id="subtitle">Tambah, Edit, dan Hapus Data Personil yang dapat dihubungi</p>
                                    
                                    <div id="narahubung-container">
                                        @if($narahubung->isNotEmpty())
                                            @foreach($narahubung as $index => $narahubung)
                                                <div class="narahubung-item mb-3">
                                                    <h5>Narahubung #{{ $index + 1 }}</h5>
                                                    <input type="hidden" name="narahubung[{{ $index }}][id_narahubung]" value="{{ $narahubung->id_narahubung }}">
                                                    <div class="form-group">
                                                        <label for="nama_lengkap_{{ $index }}">Nama Lengkap</label>
                                                        <input type="text" class="form-control" name="narahubung[{{ $index }}][nama_lengkap]" id="nama_lengkap_{{ $index }}" value="{{ $narahubung->nama_lengkap }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="posisi_{{ $index }}">Posisi</label>
                                                        <input type="text" class="form-control" name="narahubung[{{ $index }}][posisi]" id="posisi_{{ $index }}" value="{{ $narahubung->posisi }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kontak_{{ $index }}">Kontak</label>
                                                        <input type="phone" class="form-control" name="narahubung[{{ $index }}][kontak]" id="kontak_{{ $index }}" value="{{ $narahubung->kontak }}">
                                                    </div>
                                                    <button type="button" class="btn btn-danger btn-sm remove-narahubung">Hapus</button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div> --}}

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let narahubungCount = {{ $narahubung->count() }};
                                    const addNarahubungBtn = document.getElementById('add-narahubung');
                                    const narahubungContainer = document.getElementById('narahubung-container');

                                    addNarahubungBtn.addEventListener('click', function() {
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

                                    narahubungContainer.addEventListener('click', function(e) {
                                        if (e.target && e.target.classList.contains('remove-narahubung')) {
                                            e.target.closest('.narahubung-item').remove();
                                        }
                                    });
                                });
                                </script>
                                <div class="form-group d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary mr-2 ml-3">Submit</button>
                                    <a href="{{ route('relawan-assessment', $kejadian->id_kejadian) }}" class="btn btn-light ml-3">Cancel</a>
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
