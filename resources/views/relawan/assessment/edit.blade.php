@extends('layouts-relawan.default')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">


                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Laporan Assessment</h4>
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
                            <form class="forms-sample" action="{{ route('edit-lapsit.update', $kejadian->id_kejadian ) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="kejadian_musibah">Jenis Kejadian Bencana</label>
                                    <select class="form-control" id="kejadian_musibah" name="id_jeniskejadian" disabled>
                                        @foreach($jenisKejadian as $jenis)
                                            <option value="{{ $jenis->id_jeniskejadian }}" {{ $jenis->id_jeniskejadian == $kejadian->id_jeniskejadian ? 'selected' : '' }}>
                                                {{ $jenis->nama_kejadian }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="email" class="form-control" id="lokasi" value="{{ $kejadian->lokasi }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="waktu_kejadian">Tanggal Kejadian</label>
                                    <input type="date" class="form-control" id="waktu_kejadian" value="{{ $kejadian->tanggal_kejadian }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="update">Update</label>
                                    <input type="date" class="form-control" id="update" value="{{ $kejadian->update }}">
                                </div>

                                <div class="form-group">
                                    <label>Keterangan Akses Menuju Lokasi</label>
                                    <select class="js-example-basic-single w-100" id="akses_ke_lokasi" name="akses_ke_lokasi">
                                        <option value="Aman" {{ $kejadian->akses_ke_lokasi == "Accessible" ? 'selected' : '' }}>Aman</option>
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
                                        <label for="kk">Jumlah KK</label>
                                        <input type="number" class="form-control" name="kk" id="kk" value="{{ $kejadian->dampak?->korbanTerdampak?->kk ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="jiwa">Jumlah Orang</label>
                                        <input type="number" class="form-control" name="jiwa" id="jiwa" value="{{ $kejadian->dampak?->korbanTerdampak?->jiwa ?? '' }}">                                    
                                    </div>
                                    <p class="card-description" id="subtitle">
                                        Korban Jiwa/Luka/Mengungsi
                                    </p>
                                    <div class="form-group">
                                        <label for="luka_berat">Luka Berat</label>
                                        <input type="number" class="form-control" name="luka_berat" id="luka_berat" value="{{ $kejadian->dampak?->korbanJlw?->luka_berat ?? '' }}">                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="luka_ringan">Luka Berat</label>
                                        <input type="number" class="form-control" name="luka_ringan" id="luka_ringan" value="{{ $kejadian->dampak?->korbanJlw?->luka_ringan ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meninggal">Meninggal</label>
                                        <input type="number" class="form-control" name="meninggal" id="meninggal" value="{{ $kejadian->dampak?->korbanJlw?->meninggal ?? ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hilang">Hilang</label>
                                        <input type="number" class="form-control" name="hilang" id="hilang" value="{{ $kejadian->dampak?->korbanJlw?->hilang ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="mengungsi">Mengungsi</label>
                                        <input type="number" class="form-control" name="mengungsi" id="mengungsi" value="{{ $kejadian->dampak?->korbanJlw?->mengungsi ?? '' }}">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Kerusakan Rumah
                                    </p>
                                    <div class="form-group">
                                        <label for="rusak_berat">Kerusakan Rumah Berat</label>
                                        <input type="text" class="form-control" name="rusak_berat" id="rusak_berat" value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_berat ?? ''}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_sedang">Kerusakan Rumah Sedang</label>
                                        <input type="text" class="form-control" name="rusak_sedang" id="rusak_sedang" value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_sedang ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rusak_ringan">Kerusakan Rumah Ringan</label>
                                        <input type="text" class="form-control" name="rusak_ringan" id="rusak_ringan" value="{{ $kejadian->dampak?->kerusakanRumah?->rusak_ringan ?? '' }}">
                                    </div>

                                    <p class="card-description" id="subtitle">
                                        Kerusakan Fasilitas Sosial & Infrastruktur
                                    </p>
                                    <div class="form-group">
                                        <label for="sekolah">Kerusakan Sekolah</label>
                                        <input type="text" class="form-control" name="sekolah" id="sekolah" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->sekolah ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tempat_ibadah">Kerusakan Tempat Ibadah</label>
                                        <input type="text" class="form-control" name="tempat_ibadah" id="tempat_ibadah" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->tempat_ibadah ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="rumah_sakit">Kerusakan Rumah Sakit</label>
                                        <input type="text" class="form-control"  name="rumah_sakit" id="rumah_sakit" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->rumah_sakit ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="pasar">Kerusakan Pasar</label>
                                        <input type="text" class="form-control" name="pasar" id="pasar" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->pasar ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="gedung_pemerintah">Kerusakan Gedung Pemerintahan</label>
                                        <input type="text" class="form-control" name="gedung_pemerintah" id="gedung_pemerintah" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->gedung_pemerintah ?? '' }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="lain_lain">Kerusakan Lain Lain</label>
                                        <input type="text" class="form-control" name="lain_lain" id="lain_lain" value="{{ $kejadian->dampak?->kerusakanFasilitasSosial?->lain_lain ?? '' }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="desc_kerusakan">Kerusakan Infrastruktur</label>
                                        <input type="text" class="form-control" name="desc_kerusakan" id="desc_kerusakan" value="{{ $kejadian->dampak?->kerusakanInfrastruktur?->desc_kerusakan ?? '' }}">
                                    </div>
                                </div>

                                {{-- Tambah Pengungsian --}}

                                {{--  <div class="form-group">
                                    <button type="button" id="tambah_pengungsian" class="btn btn-primary me-2">Tambah
                                        Pengungsian</button>
                                </div>

                                <div id="form_area">
                                    <div id="form_pengungsian" style="display:none;">
                                        <p class="card-description" id="subtitle">Pengungsian</p>
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" class="form-control" name="nama_lokasi" id="nama_lokasi" value="{{ $kejadian->dampak->pengungsian->nama_lokasi }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kk">KK</label>
                                            <input type="number" class="form-control" name="kk" id="kk" value="{{ $kejadian->dampak->pengungsian->kk }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jiwa">Jiwa</label> 
                                            <input type="number" class="form-control" name="jiwa" id="jiwa" value="{{ $kejadian->dampak->pengungsian->jiwa }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="laki_laki">Laki-Laki</label>
                                            <input type="number" class="form-control" name="laki_laki" id="laki_laki" value="{{ $kejadian->dampak->pengungsian->laki_laki }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="perempuan">Perempuan</label>
                                            <input type="number" class="form-control" name="perempuan" id="perempuan" value="{{ $kejadian->dampak->pengungsian->perempuan }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kurang_dari_5">Kurang dari 5 Tahun</label>
                                            <input type="number" class="form-control" name="kurang_dari_5" id="kurang_dari_5" value="{{ $kejadian->dampak->pengungsian->kurang_dari_5 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="atr_5_sampai_18">Antara 5-18 Tahun</label>
                                            <input type="number" class="form-control" name="atr_5_sampai_18" id="atr_5_sampai_18" value="{{ $kejadian->dampak->pengungsian->atr_5_sampai_18 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="lebih_dari_18">Lebih Dari 18 Tahun</label>
                                            <input type="number" class="form-control" name="lebih_dari_18" id="lebih_dari_18" value="{{ $kejadian->dampak->pengungsian->lebih_dari_18 }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ $kejadian->dampak->pengungsian->jumlah }}">
                                        </div>
                                    </div>
                                </div>  --}}

                                <h4 class="card-title">Evakuasi Korban</h4>
                                <div class="form-group">
                                    <label for="luka_ringanberat">Luka Ringan/Berat</label>
                                    <input type="number" class="form-control" id="luka_ringanberat" name="luka_ringanberat" value="{{ $kejadian->giatPmi?->evakuasiKorban?->luka_ringanberat ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="meninggal">Meninggal</label>
                                    <input type="number" class="form-control" id="meninggal" name="meninggal" value="{{ $kejadian->giatPmi?->evakuasiKorban?->meninggal ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ $kejadian->giatPmi?->evakuasiKorban?->keterangan ?? '' }}">
                                </div>

                                <h4 class="card-title">Layanan Korban</h4>
                                <div class="form-group">
                                    <label for="distribusi">Distribusi</label>
                                    <input type="text" class="form-control" id="distribusi" name="distribusi" value="{{ $kejadian->giatPmi?->layananKorban?->distribusi ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="dapur_umum">Dapur Umum</label>
                                    <input type="text" class="form-control" id="dapur_umum" name="dapur_umum" value="{{ $kejadian->giatPmi?->layananKorban?->dapur_umum ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="evakuasi">Evakuasi</label>
                                    <input type="text" class="form-control" id="evakuasi" name="evakuasi" value="{{ $kejadian->giatPmi?->layananKorban?->evakuasi ?? '' }}">
                                </div>
                                <div class="form-group">
                                    <label for="layanan_kesehatan">Layanan Kesehatan</label>
                                    <input type="text" class="form-control" id="layanan_kesehatan" name="layanan_kesehatan" value="{{ $kejadian->giatPmi?->layananKorban?->layanan_kesehatan ?? '' }}">
                                </div>

                                <div class="form-group">
                                    <label for="kebutuhan">Kebutuhan</label>
                                    <input type="text" class="form-control" name="kebutuhan" id="kebutuhan" value="{{ $kejadian->kebutuhan }}">
                                </div>

                                <div class="form-group">
                                    <button type="button" id="tambah_cp" class="btn btn-primary me-2">Tambah
                                        CP Personil</button>
                                </div>
                                {{-- narahubung --}} 
                                {{--  <div id="form_area_cp">
                                    <div id="form_cp" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama_lengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ $kejadian->narahubung?->nama_lengkap ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="posisi">Posisi</label>
                                            <input type="text" class="form-control" name="posisi" id="posisi" value="{{ $kejadian->narahubung?->posisi ?? '' }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="kontak">Kontak</label>
                                            <input type="phone" class="form-control" name="kontak" id="kontak" value="{{ $kejadian->narahubung?->kontak ?? '' }}">
                                        </div>
                                    </div>
                                </div>  --}}

                                {{-- petugas assessment
                                  
                                <div class="form-group">
                                    <button type="button" id="tambah_petugas_posko" class="btn btn-primary me-2">Petugas
                                        Assessment</button>
                                </div>  --}}

                                {{--  <div id="form_area_petugas">
                                    <div id="form_petugas" style="display:none;">
                                        <p class="card-description" id="subtitle">Personel yang dapat dihubungi</p>
                                        <div class="form-group">
                                            <label for="nama">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama" id="nama" value="{{ $kejadian->relawan?->nama ?? '' }}">
                                        </div>
                                    </div>
                                </div>  --}}

                                {{--  <button type="submit" class="btn btn-primary me-2">Submit</button>
<a href="{{ route('relawan-assessment') }}" class="btn btn-light">Cancel</a>  --}}
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
