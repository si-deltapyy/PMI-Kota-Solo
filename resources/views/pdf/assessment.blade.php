<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      * {
        font-size: 1rem;
      }
      .wrapper {
        margin: auto;
        width: 70%;
      }
      .row {
        padding: 1rem;
      }
      .table {
        border: 1px solid black;
        width: 100%;
        text-align: left;
      }

      .field {
        background-color: rgba(255, 0, 0, 0.2);
        width: 100%;
        padding: 0 1rem;
      }
      .row {
        display: flex;
      }
      #title {
        background-color: red;
        width: 63%;
        font-size: 2rem !important;
        text-align: center;
        padding: 1rem;
        border: 1px solid black;
      }
      .column {
        width: 70%;
        border: 1px solid black;
      }
      .card-grid {
        display: grid;
        grid-template-columns: auto auto;

        width: 100%;
        font-size: 1rem;
      }

      .card-grid-many {
        display: grid;
        grid-template-columns: auto auto auto;

        width: 100%;
        font-size: 1rem;
      }

      .item-titles {
        grid-column-start: 1;
        grid-column-end: 10;
        text-align: center !important;
      }

      .card-grid > div,
      .card-grid-many > div {
        background-color: rgba(255, 255, 255, 0.8);
        text-align: start;
        padding: 0.5rem;
        border: 1px solid black;
      }

      .item-title {
        grid-column-start: 1;
        grid-column-end: 3;
        text-align: center !important;
        background-color: yellow !important;
      }

      #giat-pmi {
        display: grid;
        grid-template-columns: auto auto auto;

        width: 100%;
        font-size: 1rem;
      }
      #giat-pmi > .item-title {
        grid-column-start: 1;
        grid-column-end: 5;
        text-align: center !important;
      }

      #personil {
        display: grid;
        grid-template-columns: auto auto auto;

        width: 100%;
        font-size: 1rem;
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Dampak Section -->
      <div class="row">
        <div id="title" class="title">1. Umum</div>
        <div class="column">
          <div class="card-grid">
            <div class="item-title">Jenis Kejadian</div>
            <div class="subtitle">Bencana Alam</div>
            <div class="content">{{ $kejadian->jenisKejadian->nama_kejadian }}</div>
            <!--div class="subtitle">Konflik</div>
            <div class="content"></div>
            <div class="subtitle">Kecelakaan</div>
            <div class="content"></div>
            <div class="subtitle">Dan Lain Lain</div>
            <div class="content"></div-->
          </div>
          <div class="card-grid">
            <div class="item-title">Tempat Kejadian</div>
            <div class="subtitle">Tanggal</div>
            <div class="content">{{ $kejadian->tanggal_kejadian }}</div>
            <!--div class="subtitle">Waktu</div>
            <div class="content"></div-->
            <div class="subtitle">Lokasi</div>
            <div class="content">{{ $kejadian->lokasi }}</div>
            <!--div class="subtitle">Provinsi</div>
            <div class="content"></div>
            <div class="subtitle">Kabupaten</div>
            <div class="content"></div>
            <div class="subtitle">Kecamatan</div>
            <div class="content"></div>
            <div class="subtitle">Desa/ Kelurahan</div>
            <div class="content"></div-->
          </div>
        </div>
      </div>
      <!-- Mobilisasi Section -->
      <div class="row">
        <div id="title" class="title">2. Informasi Umum</div>
        <div class="column">
          <div class="card-grid">
            <div class="item-title">Jumlah Korban</div>
            <div class="subtitle">Meninggal</div>
            <div class="content">{{ $kejadian->dampak->korbanJlw->meninggal }}</div>
            <div class="subtitle">Luka Berat</div>
            <div class="content">{{ $kejadian->dampak->korbanJlw->luka_berat }}</div>
            <div class="subtitle">Luka Ringan</div>
            <div class="content">{{ $kejadian->dampak->korbanJlw->luka_ringan }}</div>
            <div class="subtitle">Hilang</div>
            <div class="content">{{ $kejadian->dampak->korbanJlw->hilang }}</div>
          </div>
          <div class="card-grid">
            <div class="item-title">Pengungsi IDP</div>
            <!--div class="subtitle">Ada</div>
            <div class="content">Tidak Ada</div-->
          </div>
          <div class="card-grid">
            <div class="item-title"></div>
            <div class="subtitle">Lokasi Pengungsian</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->nama_lokasi}}<br>
            </div>
            @endforeach

            <div class="subtitle">Jumlah</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->jumlah}}<br>
            </div>
            @endforeach

            <div class="subtitle">Laki-laki</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->laki_laki}}<br>
            </div>
            @endforeach

            <div class="subtitle">Perempuan</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->perempuan}}<br>
            </div>
            @endforeach

            <div class="subtitle">Kurang 5 Tahun</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->kurang_dari_5}}<br>
            </div>
            @endforeach

            <div class="subtitle">Antara 5 hingga 18 tahun</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->atr_5_sampai_18}}<br>
            </div>
            @endforeach

            <div class="subtitle">Lebih dari 18 tahun</div>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <div class="content">
              {{$pengungsian->lebih_dari_18}}<br>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <!-- Giat PMI Section -->
      <div class="row">
        <div id="title" class="title">3. Dampak Sarana Prasarana</div>
        <div class="column">
          <div class="card-grid">
            <div class="item-title"></div>
            <!--div class="subtitle">Rumah Tinggal</div>
            <div class="content">20</div-->
            <div class="subtitle">Rusak Berat</div>
            <div class="content">{{$kejadian->dampak->kerusakanRumah->rusak_berat}}</div>
            <div class="subtitle">Rusak Ringan</div>
            <div class="content">{{$kejadian->dampak->kerusakanRumah->rusak_ringan}}</div>
          </div>
          <div class="card-grid" id="giat-pmi">
            <div class="item-title">Akses Transportasi</div>
            <div class="subtitle">Jalan</div>
            <div class="content">{{$kejadian->akses_ke_lokasi}}</div>
            <!--div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div>
            <div class="subtitle">Jembatan</div>
            <div class="content"></div>
            <div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div>
            <div class="subtitle">Kendaraan Umum</div>
            <div class="content"></div>
            <div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div-->
          </div>

          <!--div class="card-grid">
            <div class="item-title">Akses Komunikasi</div>
            <div class="subtitle">Telepon/Fax</div>
            <div class="content"></div>
            <div class="subtitle">Telepon Seluler</div>
            <div class="content"></div>
            <div class="subtitle">Kantor Pos</div>
            <div class="content"></div>
            <div class="subtitle">Internet</div>
            <div class="content"></div>
          </div-->
          <div class="card-grid" id="giat-pmi">
            <div class="item-title">Sarana Umum</div>
            <div class="subtitle">RS</div>
            <div class="content">{{$kejadian->dampak->kerusakanFasilSosial->rumah_sakit ?? '0'}}</div>
            <!--div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div-->
            <!--div class="subtitle">Listrik</div>
            <div class="content"></div>
            <div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div>
            <div class="subtitle">Air</div>
            <div class="content"></div>
            <div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div-->
            <div class="subtitle">Sekolah</div>
            <div class="content">{{$kejadian->dampak->kerusakanFasilSosial->sekolah ?? '0'}}</div>
            <!--div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div-->
            <div class="subtitle">Tempat Ibadah</div>
            <div class="content">{{$kejadian->dampak->kerusakanFasilSosial->tempat_ibadah ?? '0'}}</div>
            <!--div class="subtitle">Berfungsi</div>
            <div class="subtitle">Tidak Berfungsi</div-->
          </div>
        </div>
      </div>
      <!-- Giat Pemerintah Section -->
      <div class="row">
        <div id="title" class="title">4.Situasi Keamanan</div>
        <div class="column">
          <div class="field">
            <p>{{$kejadian->dampak->kerusakanInfrastruktur->desc_kerusakan ?? ''}}</p>
          </div>
        </div>
      </div>
      <!-- Kebutuhan Section -->
      <div class="row">
        <div id="title" class="title">5. Tindakan yang sudah dilakukan</div>
        <div class="column">
          <div class="field">
            <p>{{$kejadian->giatPmi->layananKorban->distribusi ?? ''}}-</p>
          </div>
          <div class="field">
            <p>{{$kejadian->giatPmi->layananKorban->evakuasi ?? ''}}-</p>
          </div>
          <div class="field">
            <p>{{$kejadian->giatPmi->layananKorban->layanan_kesehatan ?? ''}}-</p>
          </div>
          <div class="field">
            <p>{{$kejadian->giatPmi->layananKorban->dapur_umum ?? '' }}-</p>
          </div>
        </div>
      </div>
      <!-- Personil CP Section -->
      <div class="row">
        <div id="title" class="title">6. Kebutuhan Mendesak</div>
        <div class="column">
          <div class="card-grid">
            <div class="item-title"></div>
            <div class="subtitle">Korban</div>
            <div class="Subtitle">PMI</div>
            <div class="content">{{$kejadian->kebutuhan ?? '' }}</div>
            <!--div class="content">--</div>
            <div class="content">-</div>
            <div class="content">--</div-->
          </div>
        </div>
      <div class="row">
        <div id="title" class="title">7. Kontak Person</div>
        <div class="column">
          <div class="field">
            @foreach($kejadian->narahubung as $narahubung)
            <p {{$narahubung->id_narahubung}}>{{ $narahubung->kontak }}</p>
            @endforeach
          </div>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="title">Petugas Assessment</div>
        <div class="field">
          <p>{{ $kejadian->user->name ?? '' }}</p>
        </div>
      </div>
    </div>
  </body>
</html>
