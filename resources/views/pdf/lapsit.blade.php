@php
use Carbon\Carbon;
@endphp
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
            border: 1px solid red;
            background-color: rgba(255, 0, 0, 0.2);

            padding: 0 1rem;
        }

        .row {
            display: flex;
        }

        #title {
            background-color: red;
            width: 30%;
            font-size: 1rem !important;
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

        .card-grid>div,
        .card-grid-many>div {
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

        #giat-pmi>.item-title {
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
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kejadian Bencana</th>
                        <th>: {{ $kejadian->jenisKejadian->nama_kejadian ?? '-' }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lokasi Kejadian</td>
                        <td class="columns">: {{ $kejadian->lokasi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Kejadian</td>
                        <td class="columns">: {{ $kejadian->tanggal_kejadian ? Carbon::parse($kejadian->tanggal_kejadian)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
                    </tr>
                    <tr>
                        <td>Update</td>
                        <td class="columns">: {{ $kejadian->update ? Carbon::parse($kejadian->update)->locale('id')->isoFormat('D MMMM YYYY') : '-' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="field" style=" width: 100% !important;">
                <p>Pemerintah Membutuhkan Dukungan Internasional : {{ $kejadian->dukungan_internasional ?? 'TIDAK' }}</p>
            </div>
        </div>
        <div class="row">
            <div id="title" class="title">Gambaran Umum Situasi</div>
            <div class="column" style="font-size: 0.75rem; padding: 1rem 2rem">
                {{ $kejadian->keterangan ?? '-' }}
            </div>
        </div>
        <div class="row">
            <div id="title" class="title">Keterangan Menuju Lokasi</div>
            <div class="column" style="font-size: 2rem; padding: 1rem 2rem">
                {{ $kejadian->akses_ke_lokasi ?? '-' }}
            </div>
        </div>
        <!-- Dampak Section -->
        <div class="row">
            <div id="title" class="title">Dampak</div>
            <div class="column">
                <div class="card-grid">
                    <div class="item-title">Korban Terdampak</div>
                    <div class="subtitle">KK</div>
                    <div class="content">{{ $kejadian->dampak->korbanTerdampak->kk ?? 0 }}</div>
                    <div class="subtitle">Jiwa</div>
                    <div class="content">{{ $kejadian->dampak->korbanTerdampak->jiwa ?? 0 }}</div>
                </div>
                <div class="card-grid">
                    <div class="item-title">Korban Jiwa/Luka/Mengungsi</div>
                    <div class="subtitle">Luka Berat</div>
                    <div class="content">{{ $kejadian->dampak->korbanJlw>luka_berat ?? 0 }}</div>
                    <div class="subtitle">Luka Ringan</div>
                    <div class="content">{{ $kejadian->dampak->korbanJlw>luka_ringan ?? 0 }}</div>
                    <div class="subtitle">Meninggal</div>
                    <div class="content">{{ $kejadian->dampak->korbanJlw>meninggal ?? 0 }}</div>
                    <div class="subtitle">Hilang</div>
                    <div class="content">{{ $kejadian->dampak->korbanJlw>hilang ?? 0 }}</div>
                    <div class="subtitle">Mengungsi</div>
                    <div class="content">{{ $kejadian->dampak->korbanJlw>mengungsi ?? 0 }}</div>
                </div>
                <div class="card-grid">
                    <div class="item-title">Kerusakan Rumah</div>
                    <div class="subtitle">Rusak Berat</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanRumah->rusak_berat ?? 0 }} (rumah)</div>
                    <div class="subtitle">Rusak Sedang</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanRumah->rusak_sedang ?? 0 }} (rumah)</div>
                    <div class="subtitle">Rusak Ringan</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanRumah->rusak_ringan ?? 0 }} (rumah)</div>
                </div>
                <div class="card-grid">
                    <div class="item-title">Kerusakan Fasilitas Sosial/Umum</div>
                    <div class="subtitle">Sekolah</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->sekolah ?? 0 }}</div>
                    <div class="subtitle">Tempat Ibadah</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0 }}</div>
                    <div class="subtitle">Rumah Sakit</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0 }}</div>
                    <div class="subtitle">Pasar</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->pasar ?? 0 }}</div>
                    <div class="subtitle">Gedung Pemerintah</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->gedung_pemerintah ?? 0 }}</div>
                    <div class="subtitle">Lain Lain</div>
                    <div class="content">{{ $kejadian->dampak->kerusakanFasilitasSosial->lain_lain ?? 0 }}</div>
                </div>

                <div class="card-grid">
                    <div class="item-title">Kerusakan Infrastruktur</div>
                    <div class="item-title">{{ $kejadian->dampak->kerusakanInfrastruktur>desc_kerusakan ?? 0 }}</div>
                </div>
                <div class="card-grid-many">
                    <div class="item-titles">Pengungsian</div>
                    <div class="subtitle-many" style="font-size: 0.8rem">
                        Nama Lokasi Kel,Kec
                    </div>
                    <div class="subtitle-many" id="KK">KK</div>
                    <div class="subtitle-many" id="Jiwa">Jiwa</div>
                    <div class="subtitle-many" id="L">L</div>
                    <div class="subtitle-many" id="P">P</div>
                    <div class="subtitle-many" id="5">
                        <5 </div>
                            <div class="subtitle-many" id="5-18">>5<18 </div>
                                    <div class="subtitle-many" id="18">>18</div>
                                    <div class="subtitle-many" id="Jumlah">Jumlah</div>
                                    <div class="subtitle-many" style="font-size: 0.8rem">
                                        Nama Lokasi Kel,Kec
                                    </div>
                                    <div class="subtitle-many" id="KK">10</div>
                                    <div class="subtitle-many" id="Jiwa">10</div>
                                    <div class="subtitle-many" id="L">10</div>
                                    <div class="subtitle-many" id="P">10</div>
                                    <div class="subtitle-many" id="5">10</div>
                                    <div class="subtitle-many" id="5-18">10</div>
                                    <div class="subtitle-many" id="18">18</div>
                                    <div class="subtitle-many" id="Jumlah">10</div>
                            </div>
                    </div>
                </div>
                <!-- Mobilisasi Section -->
                <div class="row">
                    <div id="title" class="title">Mobilisasi Sumber Daya PMI</div>
                    <div class="column">
                        <div class="card-grid">
                            <div class="item-title">Personil</div>
                            <div class="subtitle">Pengurus</div>
                            <div class="content">20</div>
                            <div class="subtitle">Staf Markas Kab/Kota</div>
                            <div class="content">405</div>
                            <div class="subtitle">Staf Markas Provinsi</div>
                            <div class="content">405</div>
                            <div class="subtitle">Staf Markas Pusat</div>
                            <div class="content">405</div>
                            <div class="subtitle">Relawan PMI Kab/Kota</div>
                            <div class="content">405</div>
                            <div class="subtitle">Relawan PMI Provinsi</div>
                            <div class="content">405</div>
                            <div class="subtitle">Relawan Lintas Provinsi</div>
                            <div class="content">405</div>
                            <div class="subtitle">Sukarelawan Spesialis</div>
                            <div class="content">405</div>
                        </div>
                        <div class="card-grid">
                            <div class="item-title">
                                Personil Bantuan Teknis/Ahli/Spesialis (TSR)
                            </div>
                            <div class="subtitle">Medis</div>
                            <div class="content">20</div>
                            <div class="subtitle">Paramedis</div>
                            <div class="content">405</div>
                            <div class="subtitle">Relief</div>
                            <div class="content">405</div>
                            <div class="subtitle">Logistics</div>
                            <div class="content">405</div>
                            <div class="subtitle">Watsan</div>
                            <div class="content">405</div>
                            <div class="subtitle">IT-Telkom</div>
                            <div class="content">405</div>
                            <div class="subtitle">Sheltering</div>
                            <div class="content">405</div>
                        </div>
                        <div class="card-grid">
                            <div class="item-title">Alat Utama Sistem TBD</div>
                            <div class="subtitle">Kend Ops</div>
                            <div class="content">20</div>
                            <div class="subtitle">Truk Angkutan</div>
                            <div class="content">405</div>
                            <div class="subtitle">Truk Tanki</div>
                            <div class="content">405</div>
                            <div class="subtitle">Double Cabin</div>
                            <div class="content">405</div>
                            <div class="subtitle">Alat DU</div>
                            <div class="content">405</div>
                            <div class="subtitle">Ambulans</div>
                            <div class="content">405</div>
                            <div class="subtitle">Alat Watsans</div>
                            <div class="content">405</div>
                            <div class="subtitle">RS Lapangan</div>
                            <div class="content">405</div>
                            <div class="subtitle">Alat PKDD</div>
                            <div class="content">405</div>
                            <div class="subtitle">Gudang Lapangan</div>
                            <div class="content">405</div>
                            <div class="subtitle">Posko Aju</div>
                            <div class="content">405</div>
                            <div class="subtitle">Alat IT/Tel Lapangan</div>
                            <div class="content">405</div>
                        </div>
                        <div class="card-grid">
                            <div class="item-title">Evaluasi Korban Luka-Luka</div>
                            <div class="subtitle">Luka Berat/Ringan</div>
                            <div class="content">20</div>
                            <div class="subtitle">Meninggal</div>
                            <div class="content">405</div>
                        </div>
                    </div>
                </div>
                <!-- Giat PMI Section -->
                <div class="row">
                    <div id="title" class="title">Giat PMI</div>
                    <div class="column">
                        <div class="card-grid">
                            <div class="item-title">Evaluasi Korban Luka-Luka</div>
                            <div class="subtitle">Luka Berat/Ringan</div>
                            <div class="content">20</div>
                            <div class="subtitle">Meninggal</div>
                            <div class="content">405</div>
                        </div>

                        <div class="card-grid" id="giat-pmi">
                            <div class="item-title">Layanan Korban Bencana - Lapsit</div>
                            <div class="subtitle"></div>
                            <div class="subtitle">Tempat/Lokasi</div>
                            <div class="subtitle">KK/Orang</div>
                            <div class="subtitle">Jumlah</div>
                            <div class="content">Distribusi Food Item</div>
                            <div class="content">Surakarta</div>
                            <div class="content">KK/Orang</div>
                            <div class="content">10</div>
                            <div class="content">Distribusi Non-Food Item</div>
                            <div class="content">Surakarta</div>
                            <div class="content">KK/Orang</div>
                            <div class="content">10</div>
                            <div class="content">Layanan Kesehatan</div>
                            <div class="content">Surakarta</div>
                            <div class="content">KK/Orang</div>
                            <div class="content">10</div>
                            <div class="content">Layanan Air Bersih</div>
                            <div class="content">Surakarta</div>
                            <div class="content">KK/Orang</div>
                            <div class="content">10</div>
                            <div class="content">Lain Lain</div>
                            <div class="content">Surakarta</div>
                            <div class="content">KK/Orang</div>
                            <div class="content">10</div>
                        </div>
                    </div>
                </div>
                <!-- Giat Pemerintah Section -->
                <div class="row">
                    <div id="title" class="title">Giat Pemerintah</div>
                    <div class="column">
                        <div class="field">
                            <p>--</p>
                        </div>
                    </div>
                </div>
                <!-- Kebutuhan Section -->
                <div class="row">
                    <div id="title" class="title">Hambatan</div>
                    <div class="column">
                        <div class="field">
                            <p>-</p>
                        </div>
                    </div>
                </div>
                <!-- Personil CP Section -->
                <div class="row">
                    <div id="title" class="title">Personil Yang Bisa Dihubungi</div>
                    <div class="column">
                        <div class="card-grid" id="personil">
                            <div class="subtitle">Nama Lengkap</div>
                            <div class="subtitle">Posisi</div>
                            <div class="subtitle">Kontak</div>
                            <div class="content">Taher</div>
                            <div class="content">Kepala</div>
                            <div class="content">08999</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- <a href="">Print</a> -->
                </div>

            </div>
</body>

</html>
