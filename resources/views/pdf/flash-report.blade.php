<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Required meta tags -->
    @include('layouts.head')
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Flash Report PMI</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: white;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin: 2rem 0;
        }

        .stat {
            text-align: center;
            background-color: white;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 20%;
        }

        #charts {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin: 2rem 0;
        }

        .chart {
            width: 45%;
            margin-bottom: 2rem;
        }

        .map {
            height: 500px;
            width: 100%;
        }

        #map {
            height: 100%;
            width: 100%;
        }

        .footer {
            text-align: center;
            margin: 2rem 0;
        }

        @media (max-width: 600px) {

            .stats,
            #charts {
                flex-direction: column;
                align-items: center;
            }

            .stat,
            .chart,
            .map {
                width: 90%;
            }
        }

        .text-left {
            text-align: left;
            background-color: #A4161A;
            padding: 1rem;
            color: white;
        }

        .infografis {
            background-color: #660708;
            padding: 6px;
            font-size: 20px;
            display: inline-block;
        }

        #jenis-kejadian-head {
            color: #BA181B;
            text-align: left;
            padding-top: 4px;
            text-transform: uppercase;
            font-weight: bold;
        }

        #lokasi-head {
            display: inline-block;
            color: white;
            background-color: #0B090A;
            padding: 7px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .ket-bencana {
            text-align: left;
            flex: 1;
        }

        .logo-pmi {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 120px;
            height: auto;
            margin: 10px 10px;
            padding: 6px;
        }

        .header-buttons {
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-left: 10px;
        }

        .detail-kejadian {
            flex: 1.5;
        }

        .detail-kejadian .row {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .informasi-umum {
            background-color: #660708;
            color: white;
            padding: 1rem;
        }

        .update-block {
            border: 1px solid #E5383B;
            padding: 0.5rem;
            margin-top: 1rem;
        }

        .col {
            padding: 0;
            margin: 0;
        }

        .data-korban {
            background-color: #E5383B;
            color: white;
            padding: 0.75rem;
        }

        .header-korban {
            background-color: #0B090A;
            color: white;
            padding: 0.6rem;
            flex-shrink: 0;
        }

        .header-more-info {
            background-color: #BA181B;
            color: white;
            padding: 0.6rem;
            flex-shrink: 0;
            margin: 0;
            padding-left: 0;
            height: 74.6px;
            align-items: center;
            justify-content: center;
            text-align: center;
            display: flex;
        }

        .header-fasil {
            background-color: #660708;
            color: white;
            padding: 0.6rem;
        }

        .detail-korban {
            padding: 20px;
            background-color: white;
        }

        .detail-korban-2 {
            padding: 16px;
            background-color: #F5F3F4;
        }

        .detail-korban .row,
        .detail-korban-2 .row {
            display: flex;
            justify-content: space-around;
        }

        .detail-korban .col-md-3,
        .detail-korban-2 .col-md-3 {
            /* display: flex; */
            align-items: center;
        }

        .detail-korban .info-item,
        .detail-korban-2 .info-item {
            display: flex;
            align-items: center;
        }

        .detail-korban i,
        .detail-korban-2 i {
            font-size: 40px;
            margin-right: 10px;
        }

        .detail-korban p,
        .detail-korban-2 p {
            font-size: 36px;
            margin: 0 10px 0 0;
        }

        .detail-korban b {
            font-size: 40px;
            color: #A4161A;
        }

        .detail-korban-2 b {
            font-size: 40px;
            color: #0B090A;
        }

        .detail-korban h4,
        .detail-korban-2 h4 {
            font-size: 30px;
        }

        .col-md-3 {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Add some margin for spacing */
        }

        .icon {
            width: 60px;
            /* Adjust size as needed */
            height: 60px;
            /* Adjust size as needed */
            margin-right: 10px;
        }

        h4 {
            margin: 0;
            text-align: center;
        }

        .text-center b {
            font-size: 16px;
        }

        .text-center-2 b {
            font-size: 16px;
            padding: 0.5rem;
            background-color: #A4161A;
            color: white;
        }

        .info-item-2 {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            /* Add some margin for spacing */
        }

        .info-item-2 p {
            font-size: 28px;
            color: #E5383B;
            font-weight: bold;
        }

        .korban-terdampak {
            display: block;
            background-color: white;
        }

        #korban-mengungsi,
        #korban-luka,
        #korban-meninggal,
        #korban-hilang {
            font-weight: bold;
        }

        #rumah-terdampak,
        #sekolah-terdampak {
            font-size: 36px;
            font-weight: bold
        }

        #kk-terdampak,
        #jiwa-terdampak {
            font-weight: bold;
            color: #A4161A;
        }

        .d-flex {
            display: flex;
            align-items: flex-start;
        }

        .detail-personil {
            /* flex-grow: 1; */
            background-color: white;
            padding: 0.8rem;
        }

        .header-tdb {
            background-color: #A4161A;
            padding-right: 0;
            margin: 0;
        }

        .alat-tdb {
            /* padding-right: 1rem; */
        }

        .pengurus,
        .staff-markas,
        .relawan-pmi,
        .sukarelawan-spesialis {
            font-weight: bold;
        }

        .col-md-4 {
            padding: 0 !important;
        }

        .more-info {
            background-color: white;
            padding: 0.75rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .more-info .row {
            display: flex;
            justify-content: space-between;
            /* Jarak antar kolom */
            gap: 1rem;
        }

        .more-info .column {
            flex: 1;
            text-align: left;
        }

        .more-info .row h4 {
            flex: 1;
            text-align: center;
        }

        .more-info .row p {
            flex: 1;
            text-align: center;
            margin-top: 0;
        }
    </style>

</head>

<body>
    <header>
        <div class="d-flex align-items-stretch">
            <div class="text-left">
                <h4 class="infografis">infografis</h4>
                <h3 class="mt-2"><b>LAPORAN SITUASI</b></h3>
            </div>
            <div class="ms-3 ket-bencana flex-fill">
                <h1 id="jenis-kejadian-head"><b>KEJADIAN BENCANA</b></h1>
                <h2 id="lokasi-head" class="mb-2"><b>LOKASI</b></h2>
            </div>
            <div class="logo-pmi d-flex justify-content-center align-items-center me-5">
                <img src="/assets/images/logo-pmi.png" alt="Logo PMI" style="height: 80px;">
            </div>
            <div class="header-buttons ms-2 me-3 align-self-center">
                <button id="exportPNG" class="btn btn-sm btn-dark me-1 mb-2">Export as PNG</button>
                <button id="exportPDF" class="btn btn-sm btn-dark mb-2">Export as PDF</button>
            </div>
        </div>
    </header>

    <section>
        <div class="row">
            <div class="col">
                <div id="map"></div>
            </div>
            <div class="col">
                <div class="informasi-umum">
                    <div>Kejadian: <b id="jenis-kejadian">Jenis Kejadian</b></div>
                    <div>Lokasi: <b id="lokasi">Lokasi Kejadian</b></div>
                    <div>Waktu Kejadian: <b id="waktu-kejadian">Waktu Kejadian</b></div>
                    <div class="update-block"><b>UPDATE</b>: <span id="hari-update">Hari</span> | <span
                            id="jam-update">Jam</span></div>
                </div>
                <div class="data-korban">
                    <h3><b>DATA KORBAN</b></h3>
                </div>
                <div class="header-korban">
                    <h4><b>KORBAN TERDAMPAK</b></h4>
                </div>
                <div class="detail-korban">
                    <div class="row">
                        <div class="col-md-3 flex-column justify-content-center align-items-center">
                            <div class="info-item d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_jiwa.png" alt="">
                                <p id="jiwa-terdampak"><b>67</b></p>
                            </div>
                            <div class="text-center">
                                <h4>JIWA</h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_kk.png" alt="">
                                <p id="kk-terdampak"><b>67</b></p>
                            </div>
                            <div class="text-center">
                                <h4>KK</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="header-korban">
                    <h4><b>DETAIL KORBAN</b></h4>
                </div>
                <div class="korban-terdampak">
                    <div class="row mb-1">
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">
                                <b>Mengungsi</b>
                            </div>
                            <div class="info-item-2 d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_mengungsi.png" alt="">
                                <p id="korban-mengungsi"><b>67</b></p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">
                                <b>Meninggal</b>
                            </div>
                            <div class="info-item-2 d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_meninggal.png" alt="">
                                <p id="korban-meninggal"><b>67</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">
                                <b>Hilang</b>
                            </div>
                            <div class="info-item-2 d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_hilang.png" alt="">
                                <p id="korban-hilang"><b>67</b></p>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center">
                                <b>Luka-luka</b>
                            </div>
                            <div class="info-item-2 d-flex align-items-center">
                                <img class="icon" src="/assets/images/korban_luka.png" alt="">
                                <p id="korban-luka"><b>67</b></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-fasil">
                    <h4><b>FASILITAS TERDAMPAK</b></h4>
                </div>
                <div class="detail-korban-2">
                    <div class="row">
                        <div class="col-md-3 flex-column justify-content-center align-items-center">
                            <div class="info-item d-flex align-items-center">
                                <img class="icon" src="/assets/images/fasil_rumah.png" alt="">
                                <p id="rumah-terdampak"><b>67</b></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-item d-flex align-items-center">
                                <img class="icon" src="/assets/images/fasil_sekolah.png" alt="">
                                <p id="sekolah-terdampak"><b>67</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="header-fasil">
                    <h4><b>Mobilisasi Sumber Daya PMI</b></h4>
                </div>
                <div class="row" style="margin: 0 !important">
                    <div class="col ">
                        <div class="header-korban">
                            <h4><b>Personil PMI</b></h4>
                        </div>
                        <div class="mb-3 mt-1">
                            <canvas id="personilChart"></canvas>
                        </div>
                    </div>
                    <div class="col">
                        <div class="header-korban header-tdb">
                            <h4><b>Alat TDB</b></h4>
                        </div>
                        <div class="mt-1" style="background-color: white">
                            <canvas id="alatTDBChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="header-more-info">
                    <h4><b>MORE INFORMATION!</b></h4>
                </div>
                <div class="more-info flex-fill">
                    <div class="row">
                        <div class="column">
                            <b>Website</b><br>
                            pmisurakarta.or.id
                        </div>
                        <div class="column">
                            <b>Email</b><br>
                            kota_surakarta@pmi.or.id
                        </div>
                    </div>
                    <div class="row">
                        <div class="column">
                            <b>No Telepon</b><br>
                            0271 646 505
                        </div>
                        <div class="column">
                            <b>Alamat</b><br>
                            Jl. Kol. Sutarto No. 58 Jebres, Surakarta, Jawa Tengah 57126
                        </div>
                    </div>
                    <div class="row d-inline mt-3 mb-3">
                        <h4>Untuk melakukan donasi, klik <b>donasi.pmi.pr.id</b></h4>
                        <p>your <b>small donation</b> is a <b>big opportunity</b> for us.</p>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <script>
        const id = <?php echo json_encode($id); ?>;


        function getFormattedDate(dateString) {
            const hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            const [day, month, year] = dateString.split('/');
            const d = new Date(`${year}-${month}-${day}`); // Create a new Date object with the correct format
            const namaHari = hari[d.getDay()];
            const tanggalHari = d.getDate();
            const namaBulan = bulan[d.getMonth()];
            const tahun = d.getFullYear();

            return `${namaHari}, ${tanggalHari} ${namaBulan} ${tahun}`;
        }



        function formatDateTime(isoTimestamp) {
            let dateObject = new Date(isoTimestamp);
            let day = dateObject.getDate();
            let month = dateObject.getMonth() + 1; // Month is zero-based
            let year = dateObject.getFullYear();
            let hours = dateObject.getHours();
            let minutes = dateObject.getMinutes();
            let seconds = dateObject.getSeconds();

            // Ensure two-digit formatting with leading zeros
            let formattedDate = `${day.toString().padStart(2, '0')}/${month.toString().padStart(2, '0')}/${year}`;
            let formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            return { date: formattedDate, time: formattedTime };
        }

        async function fetchData() {
            const response = await fetch(`http://127.0.0.1:8000/flash-report/response/${id}`);
            return await response.json();
        }

        function updateMap(data) {
            if (!data || !data.report || isNaN(parseFloat(data.report.lokasi_latitude)) || isNaN(parseFloat(data.report.lokasi_longitude))) {
                console.error('Invalid or missing data:', data);
                return;
            }

            const latitude = parseFloat(data.report.lokasi_latitude);
            const longitude = parseFloat(data.report.lokasi_longitude);

            console.log('Latitude:', latitude, 'Longitude:', longitude);

            const map = L.map('map').setView([latitude, longitude], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Lokasi Kejadian')
                .openPopup();
        }

        function updateStats(data) {
            const kejadian = data.kejadian;
            const jenisKejadian = kejadian.jenis_kejadian.nama_kejadian;
            const lokasi = kejadian.lokasi;
            const tglKejadian = getFormattedDate(kejadian.tanggal_kejadian);
            const update = formatDateTime(kejadian.updated_at);
            const hariUpdate = getFormattedDate(update.date);
            const jamUpdate = update.time;
            const dataDampak = data.data_dampak;
            const dataMobilisasi = data.data_mobilisasi;

            const jenisKejadianHead = document.getElementById('jenis-kejadian-head');
            const lokasiHead = document.getElementById('lokasi-head');
            const jenisKejadianElement = document.getElementById('jenis-kejadian');
            const lokasiElement = document.getElementById('lokasi');
            const waktuKejadianElement = document.getElementById('waktu-kejadian');
            const hariUpdateElement = document.getElementById('hari-update');
            const jamUpdateElement = document.getElementById('jam-update');

            if (jenisKejadianHead) jenisKejadianHead.innerHTML = jenisKejadian;
            if (lokasiHead) lokasiHead.innerHTML = lokasi;
            if (jenisKejadianElement) jenisKejadianElement.innerHTML = jenisKejadian;
            if (lokasiElement) lokasiElement.innerHTML = lokasi;
            if (waktuKejadianElement) waktuKejadianElement.innerHTML = tglKejadian;
            if (hariUpdateElement) hariUpdateElement.innerHTML = hariUpdate;
            if (jamUpdateElement) jamUpdateElement.innerHTML = jamUpdate;

            let typesToCheck_1 = ["luka_berat", "luka_ringan", "meninggal", "hilang", "mengungsi"];
            let typesToCheck_2 = ["kk", "jiwa"];
            let typesToCheck_3 = ["rusak_berat", "rusak_sedang", "rusak_ringan"];
            let typesToCheck_4 = ["sekolah"];
            typesToCheck_1.forEach(type => {
                let maxCasualty = findMaxCasualtyReport(dataDampak, type);
                if (maxCasualty) {
                    let luka = 0;
                    switch (type) {
                        case "kk":
                            // Action for kk type
                            if (maxCasualty.value) document.getElementById('kk-terdampak').innerHTML = maxCasualty.value;
                            break;
                        case "jiwa":
                            // Action for jiwa type
                            if (maxCasualty.value) document.getElementById('jiwa-terdampak').innerHTML = maxCasualty.value;
                            break;
                        case "luka_berat":
                            // Action for luka_berat type
                            if (maxCasualty.value) luka += maxCasualty.value
                            break;
                        case "luka_ringan":
                            // Action for luka_berat type
                            if (maxCasualty.value) luka += maxCasualty.value
                            break;
                        case "meninggal":
                            // Action for meninggal type
                            if (maxCasualty.value) document.getElementById('korban-meninggal').innerHTML = maxCasualty.value;
                            break;
                        case "hilang":
                            // Action for hilang type
                            if (maxCasualty.value) document.getElementById('korban-hilang').innerHTML = maxCasualty.value;
                            break;
                        case "mengungsi":
                            // Action for mengungsi type
                            if (maxCasualty.value) document.getElementById('korban-mengungsi').innerHTML = maxCasualty.value;
                            break;
                        default:
                            console.log(`Unknown type: ${type}`);
                            break;
                    }
                    if (maxCasualty.value) document.getElementById('korban-luka').innerHTML = luka;
                } else {
                    console.log(`No data available for ${type}.`);
                }
            });

            typesToCheck_2.forEach(type => {
                let maxCasualty = findMaxKorbanTerdampakReport(dataDampak, type);
                if (maxCasualty) {
                    switch (type) {
                        case "kk":
                            // Action for kk type
                            if (maxCasualty.value) document.getElementById('kk-terdampak').innerHTML = maxCasualty.value;
                            break;
                        case "jiwa":
                            // Action for jiwa type
                            if (maxCasualty.value) document.getElementById('jiwa-terdampak').innerHTML = maxCasualty.value;
                            break;
                        default:
                            console.log(`Unknown type: ${type}`);
                            break;
                    }
                } else {
                    console.log(`No data available for ${type}.`);
                }
            });

            typesToCheck_3.forEach(type => {
                let maxCasualty = findMaxKerusakanRumah(dataDampak, type);
                if (maxCasualty) {
                    let rumah = 0;
                    switch (type) {
                        case "rusak_berat":
                            // Action for kk type
                            if (maxCasualty.value) rumah += maxCasualty.value
                            break;
                        case "rusak_sedang":
                            // Action for jiwa type
                            if (maxCasualty.value) rumah += maxCasualty.value
                            break;
                        case "rusak_ringan":
                            // Action for luka_berat type
                            if (maxCasualty.value) rumah += maxCasualty.value
                            break;

                        default:
                            console.log(`Unknown type: ${type}`);
                            break;
                    }
                    if (maxCasualty.value) document.getElementById('rumah-terdampak').innerHTML = rumah;
                } else {
                    console.log(`No data available for ${type}.`);
                }
            });

            typesToCheck_4.forEach(type => {
                let maxCasualty = findMaxKerusakanFasil(dataDampak, type);
                if (maxCasualty) {
                    switch (type) {
                        case "sekolah":
                            // Action for kk type
                            if (maxCasualty.value) document.getElementById('sekolah-terdampak').innerHTML = maxCasualty.value;
                            break;
                        default:
                            console.log(`Unknown type: ${type}`);
                            break;
                    }
                } else {
                    console.log(`No data available for ${type}.`);
                }
            });
        }

        function updateCharts(data) {

            const dataMobilisasi = data.data_mobilisasi

            let typesToCheckPersonil = ["pengurus", "staf_markas_kab_kota", "staf_markas_prov", "staf_markas_pusat", "relawan_pmi_kab_kota", "relawan_pmi_prov", "relawan_pmi_linprov", "sukarelawan_sip"];
            let typesToCheckAlatTDB = ["kend_ops", "truk_angkut", "truk_tanki", "double_cabin", "alat_du", "alat_watsan", "rs_lapangan", "alat_pk"];

            // Initialize processed data
            let processedData = {
                personil: {
                    pengurus: 0,
                    staff_markas: 0,
                    relawan_pmi: 0,
                    sukarelawan_sip: 0
                },
                alat_tdb: {
                    kend_ops: 0,
                    truk_angkut: 0,
                    truk_tanki: 0,
                    double_cabin: 0,
                    alat_du: 0,
                    alat_watsan: 0,
                    rs_lapangan: 0,
                    alat_pk: 0
                }
            };

            // Process the personil data
            typesToCheckPersonil.forEach(type => {
                let maxCasualty = findMaxData(dataMobilisasi, type, "personil");
                if (maxCasualty) {
                    if (type.startsWith("staf_markas")) {
                        processedData.personil.staff_markas += maxCasualty.value;
                    } else if (type.startsWith("relawan_pmi")) {
                        processedData.personil.relawan_pmi += maxCasualty.value;
                    } else {
                        processedData.personil[type] = maxCasualty.value;
                    }
                }
            });

            // Process the alat TDB data
            typesToCheckAlatTDB.forEach(type => {
                let maxCasualty = findMaxData(dataMobilisasi, type, "alat_tdb");
                if (maxCasualty) {
                    processedData.alat_tdb[type] = maxCasualty.value;
                }
            });

            // Update Personil Chart
            const ctxPersonil = document.getElementById('personilChart').getContext('2d');
            const personilChart = new Chart(ctxPersonil, {
                type: 'pie',
                data: {
                    labels: ['Pengurus', 'Staff Markas', 'Relawan PMI', 'Sukarelawan Spesialis'],
                    datasets: [{
                        label: 'Personil',
                        data: [
                            processedData.personil.pengurus,
                            processedData.personil.staff_markas,
                            processedData.personil.relawan_pmi,
                            processedData.personil.sukarelawan_sip
                        ],
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)',
                            'rgba(75, 192, 192, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            // Update Alat TDB Chart
            const ctxAlatTDB = document.getElementById('alatTDBChart').getContext('2d');
            const alatTDBChart = new Chart(ctxAlatTDB, {
                type: 'bar',
                data: {
                    labels: ['Kend. Ops', 'Truk Angkutan', 'Truk Tangki', 'Double Cabin', 'Alat DU', 'Alat Watsan', 'RS Lapangan', 'Alat PK'],
                    datasets: [{
                        label: 'Alat TDB',
                        data: [
                            processedData.alat_tdb.kend_ops,
                            processedData.alat_tdb.truk_angkut,
                            processedData.alat_tdb.truk_tanki,
                            processedData.alat_tdb.double_cabin,
                            processedData.alat_tdb.alat_du,
                            processedData.alat_tdb.alat_watsan,
                            processedData.alat_tdb.rs_lapangan,
                            processedData.alat_tdb.alat_pk
                        ],
                        backgroundColor: 'rgba(211, 47, 47, 0.5)',
                        borderColor: 'rgba(211, 47, 47, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function findMaxCasualtyReport(data, casualtyType) {
            // Initialize variables to store maximum value and corresponding report
            let maxValue = -1;
            let maxReport = null;

            // Iterate through each report in the data
            for (let lapName in data) {
                if (data.hasOwnProperty(lapName)) {
                    let casualtyValue = data[lapName]["korban_jlw"][casualtyType];
                    if (casualtyValue > maxValue) {
                        maxValue = casualtyValue;
                        maxReport = lapName;
                    }
                }
            }

            // Return the report with the highest casualty count of the given type
            return maxReport ? { report: maxReport, value: maxValue } : null;
        }

        function findMaxKorbanTerdampakReport(data, casualtyType) {
            // Initialize variables to store maximum value and corresponding report
            let maxValue = -1;
            let maxReport = null;

            // Iterate through each report in the data
            for (let lapName in data) {
                if (data.hasOwnProperty(lapName)) {
                    let casualtyValue = data[lapName]["korban_terdampak"][casualtyType];
                    if (casualtyValue > maxValue) {
                        maxValue = casualtyValue;
                        maxReport = lapName;
                    }
                }
            }

            // Return the report with the highest casualty count of the given type
            return maxReport ? { report: maxReport, value: maxValue } : null;
        }

        function findMaxKerusakanRumah(data, casualtyType) {
            // Initialize variables to store maximum value and corresponding report
            let maxValue = -1;
            let maxReport = null;

            // Iterate through each report in the data
            for (let lapName in data) {
                if (data.hasOwnProperty(lapName)) {
                    let casualtyValue = data[lapName]["kerusakan_rumah"][casualtyType];
                    if (casualtyValue > maxValue) {
                        maxValue = casualtyValue;
                        maxReport = lapName;
                    }
                }
            }

            // Return the report with the highest casualty count of the given type
            return maxReport ? { report: maxReport, value: maxValue } : null;
        }

        function findMaxKerusakanFasil(data, casualtyType) {
            // Initialize variables to store maximum value and corresponding report
            let maxValue = -1;
            let maxReport = null;

            // Iterate through each report in the data
            for (let lapName in data) {
                if (data.hasOwnProperty(lapName)) {
                    let casualtyValue = data[lapName]["kerusakan_fasilitas"][casualtyType];
                    if (casualtyValue > maxValue) {
                        maxValue = casualtyValue;
                        maxReport = lapName;
                    }
                }
            }

            // Return the report with the highest casualty count of the given type
            return maxReport ? { report: maxReport, value: maxValue } : null;
        }

        function findMaxData(data, casualtyType, dataName) {
            // Initialize variables to store maximum value and corresponding report
            let maxValue = -1;
            let maxReport = null;

            // Iterate through each report in the data
            for (let lapName in data) {
                if (data.hasOwnProperty(lapName)) {
                    let casualtyValue = data[lapName][dataName][casualtyType];
                    if (casualtyValue > maxValue) {
                        maxValue = casualtyValue;
                        maxReport = lapName;
                    }
                }
            }

            // Return the report with the highest casualty count of the given type
            return maxReport ? { report: maxReport, value: maxValue } : null;
        }

        async function init() {
            const data = await fetchData();
            updateMap(data);
            updateStats(data);
            updateCharts(data);
        }

        async function exportPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            const body = document.body;

            const canvas = await html2canvas(body);
            const imgData = canvas.toDataURL('image/png');

            const imgWidth = 210; // A4 size width in mm
            const pageHeight = 295; // A4 size height in mm
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;

            let position = 0;

            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save('flash-report.pdf');
        }

        async function exportPNG() {
            const body = document.body;
            const canvas = await html2canvas(body);
            const imgData = canvas.toDataURL('image/png');

            const link = document.createElement('a');
            link.href = imgData;
            link.download = 'flash-report.png';
            link.click();
        }

        document.getElementById('exportPDF').addEventListener('click', exportPDF);
        document.getElementById('exportPNG').addEventListener('click', exportPNG);

        window.onload = init;
    </script>

    @include('layouts.foot')
</body>

</html>