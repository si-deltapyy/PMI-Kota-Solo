<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Charts</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body>
  <div id="map" style="height: 400px;"></div>
  <div id="charts">
    <canvas id="chart1" width="400" height="200"></canvas>
    <canvas id="chart2" width="400" height="200"></canvas>
  </div>
  <button id="export-pdf">Export as PDF</button>
  <button id="export-png">Export as PNG</button>

  <script>
    async function fetchData() {
      const response = await fetch('/relawan/lapsit/response/2');
      return await response.json();
    }

    function createCharts(data) {
      // Define the latitude and longitude
      const latitude = data.assessment.report.lokasi_latitude; // Replace with your actual latitude
      const longitude = data.assessment.report.lokasi_longitude; // Replace with your actual longitude

      // Initialize the map
      const map = L.map('map').setView([latitude, longitude], 13);

      // Add a tile layer (OpenStreetMap)
      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      // Add a marker at the given coordinates
      L.marker([latitude, longitude]).addTo(map)
        .bindPopup('This is the location')
        .openPopup();

      // Extract data for the charts
      const labels = data.dampak.korban_terdampak ? ['KK', 'Jiwa'] : [];
      const korbanTerdampakData = data.dampak.korban_terdampak ? [data.dampak.korban_terdampak.kk, data.dampak.korban_terdampak.jiwa] : [];

      const ctx1 = document.getElementById('chart1').getContext('2d');
      new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: labels,
          datasets: [{
            label: 'Korban Terdampak',
            data: korbanTerdampakData,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
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

      // Data for the second chart
      const labels2 = ['Luka Berat', 'Luka Ringan', 'Meninggal', 'Hilang', 'Mengungsi'];
      const korbanJlwData = [
        data.dampak.korban_jlw.luka_berat,
        data.dampak.korban_jlw.luka_ringan,
        data.dampak.korban_jlw.meninggal,
        data.dampak.korban_jlw.hilang,
        data.dampak.korban_jlw.mengungsi
      ];

      const ctx2 = document.getElementById('chart2').getContext('2d');
      new Chart(ctx2, {
        type: 'line',
        data: {
          labels: labels2,
          datasets: [{
            label: 'Korban JLW',
            data: korbanJlwData,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
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
      createCharts(data);
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

    document.getElementById('export-pdf').addEventListener('click', exportPDF);
    document.getElementById('export-png').addEventListener('click', exportPNG);

    window.onload = init;
  </script>
</body>

</html>
