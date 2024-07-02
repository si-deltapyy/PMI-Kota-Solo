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
        .logo {
            width: 60px;
            margin: -20px 0 ;
        }

        .head-logo{
            width: 20%;
            /* background-image: scr('https://i.ibb.co.com/7t9ghTB/logo-pmi.png'); */
            background-color: #ffffff;
            color: #000;
        }
        .text-logo{
            margin: 1px 0;
            text-align: center;
        }
        .text{
            width: 60%;
            text-align: center;
            background-color: #ffffff;
            color: #000;
        }
        .text-side{
            width: 20%;
            background-color: #ffffff;
            color: #000;
        }
        .side{
            margin: 3px 0;
            font-size: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <!-- {{--  <img src="logo_pmi.png" alt="Logo PMI">  --}}
        <div class="header-title">
            PALANG MERAH INDONESIA<br>Format Assessment Cepat
        </div> -->
        <table>
          <tr>
              <th class="head-logo" rowspan="2">
                  <h4 class="text-logo">PALANG MERAH INDONESIA</h4>
                  <h5 class="text-logo">Kota Surakarta</h5>
              </th>
              <th class="text">
                  LEMBARAN<BR>
              </th>
              <th class="text-side" rowspan="2">
                  <p class="side">NO: PMISKA-KR-FAC-{{$id}}</p>
                  <p class="side">Versi: 001</p>
                  <p class="side">Tanggal: {{$tanggal_now}}</p>
              </th>
          </tr>
          <tr>
              <th class="text">Format Assessment Cepat</th>
          </tr>
      </table>
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
                <td colspan="2">{{ $tanggal }}</td>
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
    <!-- Section 7: Kontak Person -->
    <div class="section">
        <div class="section-title">7. KONTAK PERSON</div>
        <table>
            @foreach($kejadian->narahubung as $kontak)
            <tr>
                <th>Nama Lengkap</th>
                <th>Posisi</th>
                <th>Kontak</th>
            </tr>
            <tr>
                <td>{{ $kontak->nama_lengkap }}</td>
                <td>{{ $kontak->posisi }}</td>
                <td>{{ $kontak->kontak }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="section">
        <div class="section-title">8. PETUGAS ASSESSMENT</div>
        <table>
            <tr>
                <td>{{ $kejadian->relawan->name ?? '-' }}</td>
            </tr>
        </table>
</div>
</body>
</html>
