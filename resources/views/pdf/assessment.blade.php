@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Format Assessment Cepat</title>
    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #000;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 50px; /* Sesuaikan ukuran logo sesuai keinginan */
            height: auto;
            margin-right: 20px;
        }
        .header-title {
            text-align: center;
            font-weight: bold;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        {{--  <img src="logo_pmi.png" alt="Logo PMI">  --}}
        <div class="header-title">
            PALANG MERAH INDONESIA<br>Format Assessment Cepat
        </div>
    </div>

    <!-- Section 1: Umum -->
    <div class="section">
        <div class="section-title">1. UMUM</div>
        <table>
            <tr>
                <th>Jenis Kejadian</th>
                <th colspan="2">Keterangan</th>
            </tr>
            <tr>
                <td>Bencana Alam</td>
                <td colspan="2">{{ $kejadian->jenisKejadian->nama_kejadian ?? '-' }}</td>
            </tr>
            <tr>
                <td>Konflik</td>
                <td colspan="2">-</td>
            </tr>
            <tr>
                <td>Kecelakaan</td>
                <td colspan="2">-</td>
            </tr>
            <tr>
                <td>Dan lain-lain</td>
                <td colspan="2">-</td>
            </tr>
            <tr>
                <th>Lokasi Kejadian</th>
                <td colspan="2">{{ $kejadian->lokasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Tanggal Kejadian</th>
                <td colspan="2">{{ $kejadian->tanggal_kejadian ? Carbon::parse($kejadian->tanggal_kejadian)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
            </tr>
            <tr>
                <th>Petugas Assessment</th>
                <td colspan="2">{{ $kejadian->relawan->name ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 2: Informasi Umum -->
    <div class="section">
        <div class="section-title">2. INFORMASI UMUM</div>
        <table>
            <tr>
                <th>Jumlah Korban</th>
                <th colspan="2">Total</th>
            </tr>
            <tr>
                <td>Meninggal dunia</td>
                <td colspan="2">{{ $kejadian->dampak->korbanJlw->meninggal ?? 0 }}</td>
            </tr>
            <tr>
                <td>Luka berat</td>
                <td colspan="2">{{ $kejadian->dampak->korbanJlw->luka_berat ?? 0 }}</td>
            </tr>
            <tr>
                <td>Luka ringan</td>
                <td colspan="2">{{ $kejadian->dampak->korbanJlw->luka_ringan ?? 0 }}</td>
            </tr>
            <tr>
                <td>Hilang</td>
                <td colspan="2">{{ $kejadian->dampak->korbanJlw->hilang ?? 0 }}</td>
            </tr>
            <tr>
                <td>Mengungsi</td>
                <td colspan="2">{{ $kejadian->dampak->korbanJlw->mengungsi ?? 0 }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Pengungsi / IDP's</th>
                <th colspan="2">Keterangan</th>
            </tr>
            <tr>
                <td>Lokasi Pengungsian</td>
                <td colspan="2">{{ $kejadian->dampak->pengungsian->pluck('nama_lokasi')->implode(', ') }}</td>
            </tr>
            <tr>
                <td>Jumlah</td>
                <td colspan="2">{{ $kejadian->dampak->pengungsian->sum('jumlah') ?? 0 }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 3: Dampak Sarana & Prasarana -->
    <div class="section">
        <div class="section-title">3. DAMPAK SARANA & PRASARANA</div>
        <table>
            <tr>
                <th>Rusak Berat</th>
                <th>Rusak Sedang</th>
                <th>Rusak Ringan</th>
            </tr>
            <tr>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_berat ?? 0 }} (rumah)</td>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_sedang ?? 0 }} (rumah)</td>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_ringan ?? 0 }} (rumah)</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Akses Ke Lokasi</th>
            </tr>
            <tr>
                <td>{{ $kejadian->akses_ke_lokasi ?? '-' }}</td>
               
            </tr>
        </table>
        <table>
            <tr>
                <th>Fasilitas Umum Terdampak</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>RS/Fasilitas Kesehatan</td>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0 }}</td>
            </tr>
            <tr>
                <td>Sekolah</td>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->sekolah ?? 0 }}</td>
            </tr>
            <tr>
                <td>Tempat ibadah</td>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0 }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 4: Situasi Keamanan -->
    <div class="section">
        <div class="section-title">4. SITUASI KEAMANAN</div>
        <table>
            <tr>
                <td>{{ $kejadian->keterangan ?? 'Lokasi aman dan terkendali' }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 5: Tindakan yang Sudah Dilakukan -->
    <div class="section">
        <div class="section-title">5. TINDAKAN YANG SUDAH DILAKUKAN</div>
        <table>
            <tr>
                <th>Jenis Tindakan</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>Evakuasi</td>
                <td>{{ $kejadian->giatPmi->layananKorban->evakuasi ?? '-' }}</td>
            </tr>
            <tr>
                <td>Layanan Kesehatan</td>
                <td>{{ $kejadian->giatPmi->layananKorban->layanan_kesehatan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Distribusi</td>
                <td>{{ $kejadian->giatPmi->layananKorban->distribusi ?? '-' }}</td>
            </tr>
            <tr>
                <td>Dapur Umum</td>
                <td>{{  $kejadian->giatPmi->layananKorban->dapur_umum ?? '-' }}</td>
            </tr>
        </table>
    </div>

    <!-- Section 6: Kebutuhan Mendesak -->
    <div class="section">
        <div class="section-title">6. KEBUTUHAN MENDESAK</div>
        <table>
            <tr>
                <td>{{ $kejadian->kebutuhan ?? '-' }}</td>
            </tr>
        </table>
    </div>


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
</div>
</body>
</html>
