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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #d32f2f;
            color: white;
            padding: 1rem;
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

        .chart,
        .map {
            width: 45%;
            margin-bottom: 2rem;
        }

        #map {
            height: 300px;
            width: 100%;
            /* Adjusted width for map */
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

        /* Adjusted button alignment */
        .header-buttons {
            margin-left: auto;
        }
    </style>

</head>

<body>
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Infografis PMI Kota Surakarta</h1>
            <div class="header-buttons">
                <button id="exportPNG" class="btn btn-sm btn-secondary me-1 mb-2">Export as PNG</button>
                <button id="exportPDF" class="btn btn-sm btn-secondary mb-2">Export as PDF</button>
            </div>
        </div>
    </header>
    <section class="stats">
        <div class="stat">
            <h2>1505</h2>
            <p>KK Terdampak</p>
        </div>
        <div class="stat">
            <h2>5654</h2>
            <p>Jiwa Terdampak</p>
        </div>
        <div class="stat">
            <h2>Banjir</h2>
            <p>Kejadian Bencana</p>
        </div>
        <div class="stat">
            <h2>17 Februari 2024</h2>
            <p>Tanggal Kejadian</p>
        </div>
    </section>
    <section id="charts">
        <div class="chart">
            <h3>Status Korban Terdampak</h3>
            <canvas id="korbanChart"></canvas>
        </div>
        <div class="chart">
            <h3>Fasilitas Terdampak</h3>
            <canvas id="fasilitasChart"></canvas>
        </div>
        <div class="chart">
            <h3>Personil</h3>
            <canvas id="personilChart"></canvas>
        </div>
        <div class="chart">
            <h3>Alat TDB</h3>
            <canvas id="alatTDBChart"></canvas>
        </div>
        <div class="map">
            <h3>Lokasi Kejadian</h3>
            <div id="map"></div>
        </div>

    </section>

    <script>
        const id = <?php echo json_encode($id); ?>;

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

        }

        function updateCharts(data) {
            const ctxKorban = document.getElementById('korbanChart').getContext('2d');
            const korbanChart = new Chart(ctxKorban, {
                type: 'bar',
                data: {
                    labels: ['Luka Berat', 'Luka Ringan', 'Meninggal', 'Hilang', 'Mengungsi'],
                    datasets: [{
                        label: 'Status Korban',
                        data: [0, 0, 0, 0, 5654],
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

            const ctxFasilitas = document.getElementById('fasilitasChart').getContext('2d');
            const fasilitasChart = new Chart(ctxFasilitas, {
                type: 'bar',
                data: {
                    labels: ['Sekolah', 'Tempat Ibadah', 'Rumah Sakit', 'Pasar', 'Gedung Pemerintah', 'Lain-lain'],
                    datasets: [{
                        label: 'Fasilitas Terdampak',
                        data: [2, 0, 0, 1, 1, 0],
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

            const ctxPersonil = document.getElementById('personilChart').getContext('2d');
            const personilChart = new Chart(ctxPersonil, {
                type: 'pie',
                data: {
                    labels: ['Pengurus', 'Staff Markas', 'Relawan PMI', 'Sukarelawan Spesialis'],
                    datasets: [{
                        label: 'Personil',
                        data: [0, 18, 27, 0],
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.5)',
                            'rgba(54, 162, 235, 0.5)',
                            'rgba(255, 99, 132, 0.5)'
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            const ctxalatTDB = document.getElementById('alatTDBChart').getContext('2d');
            const alatTDBChart = new Chart(ctxalatTDB, {
                type: 'bar',
                data: {
                    labels: ['Kend. Ops', 'Truk Angkutan', 'Truk Tangki', 'Double Cabin', 'Alat DU', 'Ambulans', 'Alat Watsan', 'RS Lapangan', 'Alat PKDD', 'Gudang Lapangan', 'Posko Aju', ' ALat IT/ Tel Lapangan'],
                    datasets: [{
                        label: 'Alat TDB',
                        data: [4, 0, 0, 1, 3, 2, 0, 0, 0, 0, 0, 0],
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

            // Calculate the dimensions
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

            pdf.save('charts.pdf');
        }

        async function exportPNG() {
            const body = document.body;
            const canvas = await html2canvas(body);
            const imgData = canvas.toDataURL('image/png');

            // Create a link element
            const link = document.createElement('a');
            link.href = imgData;
            link.download = 'charts.png';

            // Programmatically trigger the download
            link.click();
        }

        document.getElementById('exportPDF').addEventListener('click', exportPDF);
        document.getElementById('exportPNG').addEventListener('click', exportPNG);

        window.onload = init;

    </script>

    @include('layouts.foot')
</body>

</html>