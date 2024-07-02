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
                <td colspan="2" >: {{ $kejadian->update ? Carbon::parse($kejadian->update)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
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
        <table class="table table-bordered">
        <thead>
            <tr>
                <th align="center" style="text-align: left; color: white; background-color: red; width: 75px;">
                    Gambaran<br>Umum<br>Situasi
                </th>
                <th colspan="6">: {{ $kejadian->keterangan ?? '-' }}</th>
            </tr>
            <tr>
                <th colspan="7">
                </th>
            </tr>
            <tr>
                <th align="center" style="text-align: left; color: white; background-color: red; width: 75px;">
                    Keterangan<br>Akses menuju<br>Lokasi
                </th>
                <th colspan="6">: {{ $kejadian->akses_ke_lokasi ?? '-' }}</th>
            </tr>
            
    </table>
    </div>


    <!-- Section: Dampak -->
<div class="section">
    {{--  <div class="section-title"><h2>DAMPAK</h2></div>  --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th rowspan="15" align="center" style="text-align: center; color:white; background-color: red; width: 75px;">DAMPAK</th>
                <th colspan="6" align="center" style="text-align: center; background-color: red;">DAMPAK</th>
            </tr>
            <tr>
                <th align="center" style="text-align: center; background-color: orange;"></th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit Awal</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-1</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-2</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-3</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-4</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-warning">
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Korban Terdampak</th>
            </tr>
            <tr>
                <th>KK</th>
                @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                    <td>{{ $dampak[$lapsit]['korban_terdampak']['kk'] ?? '-' }}</td>
                @endforeach
            </tr>
            <tr>
                <th>Jiwa</th>
                @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                    <td>{{ $dampak[$lapsit]['korban_terdampak']['jiwa'] ?? '-' }}</td>
                @endforeach
            </tr>
            
            <tr class="bg-warning">
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Korban Jiwa/Luka/Mengungsi</th>
            </tr>
            @foreach(['luka_berat', 'luka_ringan', 'meninggal', 'hilang', 'mengungsi'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $dampak[$lapsit]['korban_jlw'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
            
            <tr class="bg-warning">
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Kerusakan Rumah</th>
            </tr>
            @foreach(['rusak_berat', 'rusak_sedang', 'rusak_ringan'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $dampak[$lapsit]['kerusakan_rumah'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        
    </table>

    
        <table>
        <thead>
            <tr>
                <th rowspan="11" align="center" style="text-align: center; color:white; background-color: red; width: 75px;">DAMPAK</th>
                <th colspan="6" align="center" style="text-align: center; background-color: red;">DAMPAK</th>
            </tr>
            <tr>
                <th align="center" style="text-align: center; background-color: orange;"></th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit Awal</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-1</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-2</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-3</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-4</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-warning">
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Kerusakan Fasilitas Sosial/Umum</th>
            </tr>
            @foreach(['sekolah', 'tempat_ibadah', 'rumah_sakit', 'pasar', 'gedung_pemerintah', 'lain_lain'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $dampak[$lapsit]['kerusakan_fasilitas'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Kerusakan Infrastruktur</th>
            </tr>
            <tr>
                <td colspan="6">{{ $kejadian->dampak->kerusakanInfrastruktur->desc_kerusakan ?? 0 }}</td>
            </tr>
            
        </table>
        <table>
        <thead>
            <tr>
                <th rowspan="4" align="center" style="text-align: center; color:white; background-color: red; width: 75px;"></th>
                <th colspan="9" align="center" style="text-align: center; background-color: yellow;">Pengungsian</th>
            </tr>
            <tr>
                <th align="center" style="text-align: center; background-color: yellow;">Nama Lokasi</th>
                <th align="center" style="text-align: center; background-color: yellow;">KK</th>
                <th align="center" style="text-align: center; background-color: yellow;">Jiwa</th>
                <th align="center" style="text-align: center; background-color: yellow;">L</th>
                <th align="center" style="text-align: center; background-color: yellow;">P</th>
                <th align="center" style="text-align: center; background-color: yellow;">Kurang dari 5 Tahun</th>
                <th align="center" style="text-align: center; background-color: yellow;">Antara 5-18 Tahun</th>
                <th align="center" style="text-align: center; background-color: yellow;">Lebih dari 18 Tahun</th>
                <th align="center" style="text-align: center; background-color: yellow;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kejadian->dampak->pengungsian as $pengungsian)
            
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

        <table>
        <thead>
           
            <tr>
                <th rowspan="23" align="center" style="text-align: center; color:white; background-color: red; width: 75px;">Mobilisasi Sumber Daya PMI</th>
                <th align="center" style="text-align: center; background-color: orange;"></th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit Awal</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-1</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-2</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-3</th>
                <th align="center" style="text-align: center; background-color: orange;">Lapsit-4</th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-warning">
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Personil</th>
            </tr>
            @foreach(['pengurus', 'staf_markas_kabkota', 'staf_markas_prov', 'staf_markas_pusat', 'relawan_pmi_kabkota', 'relawan_pmi_kabkota','relawan_pmi_linprov', 'relawan_pmi_prov', 'sukarelawan_sip'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $mobilisasiSd[$lapsit]['personil'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Personil Bantuan Teknis/Ahli/Spesialis (TSR)</th>
            </tr>
            @foreach(['medis','paramedis','relief','logistik','watsan','it_telekom','sheltering'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $mobilisasiSd[$lapsit]['tsr'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <th colspan="6" align="center" style="text-align: center; background-color: yellow;">Alat Utama Sistem TDB</th>
            </tr>
            @foreach(['kend_ops','truk_angkut','truk_tanki','double_cabin','alat_du','ambulans','alat_watsan','rs_lapangan','alat_pkdd','gudang_lapangan','posko_aju','alat_it_lapangan'] as $jenis)
                <tr>
                    <th>{{ ucwords(str_replace('_', ' ', $jenis)) }}</th>
                    @foreach(['lapsit_awal', 'lapsit_1', 'lapsit_2', 'lapsit_3', 'lapsit_4'] as $lapsit)
                        <td>{{ $mobilisasiSd[$lapsit]['alat_tdb'][$jenis] ?? '-' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    </div>

    <!-- Section 4: Situasi Keamanan -->
    <div class="section">
        {{--  <div class="section-title">2. INFORMASI UMUM</div>  --}}
        <table class="table table-bordered">
        <thead>
            <tr>
                <th align="center" style="text-align: left; color: white; background-color: red; width: 75px;">
                    Giat<br>Pemerintah
                </th>
                <th colspan="6">: {{ $kejadian->giat_pemerintah ?? '-' }}</th>
            </tr>
            <tr>
                <th colspan="7">
                </th>
            </tr>
            <tr>
                <th align="center" style="text-align: left; color: white; background-color: red; width: 75px;">
                    Kebutuhan
                </th>
                <th colspan="6">: {{ $kejadian->kebutuhan ?? '-' }}</th>
            </tr>
            <tr>
                <th colspan="7">
                </th>
            </tr>
            <tr>
                <th align="center" style="text-align: left; color: white; background-color: red; width: 75px;">
                    Hambatan
                </th>
                <th colspan="6">: {{ $kejadian->hambatan ?? '-' }}</th>
            </tr>
    </table>
    </div>

    <!-- Section 6: Kontak Person -->
    <div class="section">
        <div class="section-title"></div>
        <table>
        <thead>
            <tr>
                <th rowspan="6" align="center" style="text-align: center; color:white; background-color: red; width: 75px;">Personil yang bisa dihubungi</th>

                <th align="center" style="text-align: center; background-color: yellow;">Nama Lengkap</th>
                <th align="center" style="text-align: center; background-color: yellow;">Posisi</th>
                <th align="center" style="text-align: center; background-color: yellow;">Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kejadian->narahubung as $kontak)
            
            <tr>
                <td>{{ $kontak->nama_lengkap }}</td>
                <td>{{ $kontak->posisi }}</td>
                <td>{{ $kontak->kontak }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Section 6: Kontak Person -->
    <div class="section">
        <div class="section-title"></div>
        <table>
        <thead>
            <tr>
                <th rowspan="7" align="center" style="text-align: center; color:white; background-color: red; width: 75px;">Petugas Posko</th>

                <th align="center" style="text-align: center; background-color: yellow;">Nama Lengkap</th>
                <th align="center" style="text-align: center; background-color: yellow;">Kontak</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kejadian->petugasPosko as $petugasPosko)
            
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
