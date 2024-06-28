@php
use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Situasi</title>
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
            PALANG MERAH INDONESIA<br>Laporan Situasi
        </div>
    </div>

    <!-- Section 1: Umum -->
    <div class="section">
        {{--  <div class="section-title">1. UMUM</div>  --}}
        <table>
            <tr>
                <th>Kejadian Bencana</th>
                <th colspan="2">: {{ $kejadian->jenisKejadian->nama_kejadian ?? '-' }}</th>
            </tr>
            <tr>
                <th>Lokasi Kejadian</th>
                <td colspan="2">: {{ $kejadian->lokasi ?? '-' }}</td>
            </tr>
            <tr>
                <th>Waktu Kejadian</th>
                <td colspan="2">: {{ $kejadian->tanggal_kejadian ? Carbon::parse($kejadian->tanggal_kejadian)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
            </tr>
            <tr>
                <th>Update</th>
                <td colspan="2">: {{ $kejadian->update ? Carbon::parse($kejadian->update)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
            </tr>
        </table>
    </div>
    
    <!-- Section 1: dukungan internasioanl -->
    <div class="section">
        {{--  <div class="section-title">1. UMUM</div>  --}}
        <table>
            <tr>
                <th>Pemerintah membutuhkan dukungan internasional</th>
                <th colspan="2">: {{ $kejadian->dukungan_internasional ?? 'TIDAK' }}</th>
            </tr>
        </table>
    </div>

    <!-- Section 2: Informasi Umum -->
    <div class="section">
        {{--  <div class="section-title">2. INFORMASI UMUM</div>  --}}
        <table>
            <tr>
                <th>Gambaran Umum Situasi</th>
                <th colspan="2">: {{ $kejadian->keterangan ?? '-' }}</th>
            </tr>
        </table>
        <table>
            <tr>
                <th>Keterangan Akses Menuju Lokasi</th>
                <th colspan="2">: {{ $kejadian->akses_ke_lokasi ?? '-' }}</th>
            </tr>
        </table>
    </div>

    <!-- Section 3: Dampak Sarana & Prasarana -->
    <div class="section">
        <div class="section-title"><h2>DAMPAK</h2></div>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Korban Terdampak</th>
            </tr>
            <tr>
                <th>KK</th>
                <td>{{ $kejadian->dampak->korbanTerdampak->kk ?? 0 }} </td>
            </tr>
            <tr>
                <th>Jiwa</th>
                <td>{{ $kejadian->dampak->korbanTerdampak->jiwa ?? 0 }} </td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Korban Jiwa/Luka/Mengungsi</th>
            </tr>
            <tr>
                <th>Luka Berat</th>
                <td>{{ $kejadian->dampak->korbanJlw->luka_berat ?? 0 }}</td>
            </tr>
            <tr>
                <th>Luka Ringan</th>
                <td>{{ $kejadian->dampak->korbanJlw->luka_ringan ?? 0 }}</td>
            </tr>
            <tr>
                <th>Meninggal</th>
                <td>{{ $kejadian->dampak->korbanJlw->meninggal ?? 0 }}</td>
            </tr>
            <tr>
                <th>Hilang</th>
                <td>{{ $kejadian->dampak->korbanJlw->hilang ?? 0 }}</td>
            </tr>
            <tr>
                <th>Mengungsi</th>
                <td>{{ $kejadian->dampak->korbanJlw->mengungsi ?? 0 }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th rowspan="4"></th>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Kerusakan Rumah</th>
            </tr>
            <tr>
                <th></th>
                <th>Rusak Berat</th>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_berat ?? 0 }} (rumah)</td>
            </tr>
            <tr>
                <th></th>
                <th>Rusak Sedang</th>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_sedang ?? 0 }} (rumah)</td>
            </tr>
            <tr>
                <th></th>
                <th>Rusak Ringan</th>
                <td>{{ $kejadian->dampak->kerusakanRumah->rusak_ringan ?? 0 }} (rumah)</td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Kerusakan Fasilitas Sosial/Umum</th>
            </tr>
            <tr>
                <th>Sekolah</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->sekolah ?? 0 }}</td>
            </tr>
            <tr>
                <th>Tempat Ibadah</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0 }}</td>
            </tr>
            <tr>
                <th>Rumah Sakit</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0 }}</td>
            </tr>
            <tr>
                <th>Pasar</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->pasar ?? 0 }}</td>
            </tr>
            <tr>
                <th>Gedung Pemerintah</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->gedung_pemerintah ?? 0 }}</td>
            </tr>
            <tr>
                <th>Lain-lain</th>
                <td>{{ $kejadian->dampak->kerusakanFasilitasSosial->lain_lain ?? 0 }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Kerusakan Infrastruktur</th>
            </tr>
            <tr>
                <td colspan="2">{{ $kejadian->dampak->kerusakanInfrastruktur->desc_kerusakan ?? 0 }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="9" align="center" style="text-align: center; background-color: yellow;">Pengungsian</th>
            </tr>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            <tr>
                <th>Nama Lokasi</th>
                <th>KK</th>
                <th>Jiwa</th>
                <th>L</th>
                <th>P</th>
                <th>Kurang dari 5 Tahun</th>
                <th>Antara 5-18 Tahun</th>
                <th>Lebih dari 18 Tahun</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>{{ $pengungsian->nama_lokasi }}</td>
                <td>{{ $pengungsian->kk }}</td>
                <td>{{ $pengungsian->jiwa }}</td>
                <td>{{ $pengungsian->laki_laki }}</td>
                <td>{{ $pengungsian->perempuan }}</td>
                <td>{{ $pengungsian->kurang_dari_5 }}</td>
                <td>{{ $pengungsian->atr_5_sampai_18 }}</td>
                <td>{{ $pengungsian->lebih_dari_18 }}</td>
                <td>{{ $pengungsian->jumlah }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <div class="section">
        <div class="section-title"><h2>Mobilisasi Sumber Daya PMI</h2></div>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Personil</th>
            </tr>
            <tr>
                <th>Pengurus</th>
                <td>{{ $kejadian->mobilisasiSd->personil->pengurus ?? 0 }} </td>
            </tr>
            <tr>
                <th>Staf Markas Kab/Kota</th>
                <td>{{ $kejadian->mobilisasiSd->personil->staf_markas_kabkota ?? 0 }} </td>
            </tr>
            <tr>
                <th>Staf Markas Provinsi</th>
                <td>{{ $kejadian->mobilisasiSd->personil->staf_markas_prov ?? 0 }} </td>
            </tr>
            <tr>
                <th>Staf Markas Pusat</th>
                <td>{{ $kejadian->mobilisasiSd->personil->staf_markas_pusat ?? 0 }} </td>
            </tr>
            <tr>
                <th>Relawan PMI Kab/Kota</th>
                <td>{{ $kejadian->mobilisasiSd->personil->relawan_pmi_kabkota ?? 0 }} </td>
            </tr>
            <tr>
                <th>Relawan PMI Lintas Provinsi</th>
                <td>{{ $kejadian->mobilisasiSd->personil->relawan_pmi_linprov ?? 0 }} </td>
            </tr>
            <tr>
                <th>Relawan PMI Provinsi</th>
                <td>{{ $kejadian->mobilisasiSd->personil->relawan_pmi_prov ?? 0 }} </td>
            </tr>
            <tr>
                <th>Sukarelawan Spesialis</th>
                <td>{{ $kejadian->mobilisasiSd->personil->sukarelawan_sip ?? 0 }} </td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Personil Bantuan Teknis/Ahli/Spesialis (TSR)</th>
            </tr>
            <tr>
                <th>Medis</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->medis ?? 0 }} </td>
            </tr>
            <tr>
                <th>Paramedis</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->paramedis ?? 0 }} </td>
            </tr>
            <tr>
                <th>Relief</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->relief ?? 0 }} </td>
            </tr>
            <tr>
                <th>Logistics</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->logistik ?? 0 }} </td>
            </tr>
            <tr>
                <th>Watsan</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->watsan ?? 0 }} </td>
            </tr>
            <tr>
                <th>IT-Telekom</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->it_telekom ?? 0 }} </td>
            </tr>
            <tr>
                <th>Sheltering</th>
                <td>{{ $kejadian->mobilisasiSd->tsr->sheltering ?? 0 }} </td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Alat Utama Sistem TDB</th>
            </tr>
            <tr>
                <th>Kend. Ops</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->kend_ops ?? 0 }} </td>
            </tr>
            <tr>
                <th>Truk angkutan</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->truk_angkut ?? 0 }} </td>
            </tr>
            <tr>
                <th>Truk tangki</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->truk_tanki ?? 0 }} </td>
            </tr>
            <tr>
                <th>Double Cabin</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->double_cabin ?? 0 }} </td>
            </tr>
            <tr>
                <th>Alat DU</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->alat_du ?? 0 }} </td>
            </tr>
            <tr>
                <th>Ambulans</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->ambulans ?? 0 }} </td>
            </tr>
            <tr>
                <th>Alat Watsan</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->alat_watsan ?? 0 }} </td>
            </tr>
            <tr>
                <th>RS Lapangan</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->rs_lapangan ?? 0 }} </td>
            </tr>
            <tr>
                <th>Alat PKDD</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->alat_pkdd ?? 0 }} </td>
            </tr>
            <tr>
                <th>Gudang Lapangan</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->gudang_lapangan ?? 0 }} </td>
            </tr>
            <tr>
                <th>Posko Aju</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->posko_aju ?? 0 }} </td>
            </tr>
            <tr>
                <th>Alat IT/Tel lapangan</th>
                <td>{{ $kejadian->mobilisasiSd->alatTdb->alat_it_lapangan ?? 0 }} </td>
            </tr>
        </table>
       </div>
       <div class="section">
        <div class="section-title"><h2>Giat PMI</h2></div>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Evakuasi Korban</th>
            </tr>
            <tr>
                <th>Luka Ringan/Berat</th>
                <td>{{ $kejadian->mobilisasiSd->personil->pengurus ?? 0 }} </td>
            </tr>
            <tr>
                <th>Meninggal</th>
                <td>{{ $kejadian->mobilisasiSd->personil->staf_markas_kabkota ?? 0 }} </td>
            </tr>
        </table>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Layanan Korban</th>
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

    <!-- Section 4: Situasi Keamanan -->
    <table>
            <tr>
                <th>Giat Pemerintah</th>
                <th colspan="2">: {{ $kejadian->giat_pemerintah ?? '-' }}</th>
            </tr>
    </table>
    <table>
            <tr>
                <th>Kebutuhan</th>
                <th colspan="2">: {{ $kejadian->kebutuhan ?? '-' }}</th>
            </tr>
    </table>
    <table>
            <tr>
                <th>Hambatan</th>
                <th colspan="2">: {{ $kejadian->hambatan ?? '-' }}</th>
            </tr>
    </table>

    <!-- Section 6: Kontak Person -->
    <div class="section">
        <div class="section-title"></div>
        <table>
            <tr>
                <th colspan="3" align="center" style="text-align: center; background-color: yellow;">Personil yang bisa dihubungi</th>
            </tr>
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

    <!-- Section 7: Petugas Posko -->
    <div class="section">
        <div class="section-title"></div>
        <table>
            <tr>
                <th colspan="2" align="center" style="text-align: center; background-color: yellow;">Petugas Posko</th>
            </tr>
            @foreach($kejadian->petugasPosko as $petugasPosko)
            <tr>
                <th>Nama Lengkap</th>
                <th>Kontak</th>

            </tr>
            <tr>
                <td>{{ $petugasPosko->nama_lengkap }}</td>
                <td>{{ $petugasPosko->kontak }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>
