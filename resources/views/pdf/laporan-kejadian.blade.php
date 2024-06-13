<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packing Slip</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap');

        :root {
            --font-color: black;
            --highlight-color: #60D0E4;
            --header-bg-color: #B8E6F1;
            --footer-bg-color: #BFC0C3;
            --table-img-bg-color: #BFC0C3;
        }

        @page {
            size: A4;
            margin: 0cm 0;

            @top-left {
                content: element(header);
            }

            @bottom-left {
                content: element(footer);
            }
        }

        body {
            margin: 0;
            padding: 1cm 1.2cm;
            color: var(--font-color);
            font-family: 'Montserrat', sans-serif;
            font-size: 10pt;
            position: relative;
            min-height: 100vh;
            padding-bottom: 1.5cm; /* Ensure space for footer */
            box-sizing: border-box;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        hr {
            margin: 1cm 0;
            height: 0;
            border: 0;
            border-top: 1mm solid var(--highlight-color);
        }

        header {
            height: 2.5cm;
            padding: 0 2cm;
            position: running(header);
            background-color: var(--header-bg-color);
            color: var(--font-color);
        }

        header .headerSection {
            display: flex;
            justify-content: space-between;
        }

        header .headerSection:first-child {
            padding-top: .5cm;
        }

        header .headerSection:last-child {
            padding-bottom: .5cm;
        }

        header .headerSection div:last-child {
            width: 35%;
        }

        header .headerSection:last-child div:last-child {
            width: auto;
        }

        header .logoAndName {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header .logoAndName img {
            width: 1.5cm;
            height: 1.5cm;
            margin-right: .5cm;
        }

        header .headerSection .shippingDetails {
            padding-top: 1cm;
        }

        header .headerSection .billTo,
        header .headerSection .shipTo {
            display: flex;
            justify-content: space-between;
        }

        header .headerSection .billTo h3,
        header .headerSection .shipTo h3 {
            margin: 0 .75cm 0 0;
            color: var(--highlight-color);
        }

        header .headerSection div p {
            margin-top: 2px;
        }

        header h1,
        header h2,
        header h3,
        header p {
            margin: 0;
        }

        header h2,
        header h3 {
            text-transform: uppercase;
        }

        header hr {
            margin: 1cm 0 .5cm 0;
        }

        main table {
            width: 100%;
            border-collapse: collapse;
        }

        main table thead th {
            height: 1cm;
            color: var(--highlight-color);
        }

        main table tbody td {
            padding: 6mm 0;
            color: var(--font-color);
        }

        main table tbody td img {
            width: 1.2cm;
            height: 1.2cm;
            fill: var(--table-img-bg-color);
            float: left;
            margin-right: .5cm;
        }

        main table th {
            text-align: left;
            color: var(--font-color);
        }

        .notes {
            margin-top: 2cm;
        }

        aside {
            -prince-float: bottom;
            padding: 0 2cm 2cm 2cm;
        }

        .notes p,
        aside p {
            margin: 0;
            width: 50%;
        }

        footer {
            height: 1.5cm;
            line-height: 0.5cm;
            margin: 0 0 0 2.5cm;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: var(--footer-bg-color);
            color: var(--font-color);
            font-size: 8pt;
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        footer a {
            color: var(--font-color);
        }

        footer a:first-child {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <header>
        <div class="headerSection">
            <div class="logoAndName">
                <h1>Palang Merah Indonesia (PMI)</h1>
            </div>
            <div>
                <h2>SURAKARTA</h2>
                <p>
                    <b>Pelapor</b> {{ $report->user->name }}
                </p>
                <p>
                    <b>Tanggal</b> {{ $report->timestamp_report }}
                </p>
            </div>
        </div>
        <hr />
        <main>
            <h1>Laporan Kejadian</h1>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <b>Nama Kejadian</b>
                        </td>
                        <td>
                            {{ $report->nama_bencana }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Tanggal Kejadian</b>
                        </td>
                        <td>
                            {{ $report->tanggal_kejadian }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Lokasi</b>
                        </td>
                        <td>
                            <a href="{{ $googleMapsLink }}">{{ $locationName }}</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Status</b>
                        </td>
                        <td>
                            {{ $report->status }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Deskripsi</b>
                        </td>
                        <td>
                            {{ $report->keterangan }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>
    </header>

    <footer>
        <a href="https://pmisurakarta.or.id/">
            pmisurakarta.or.id
        </a>
        <a href="mailto:kota_surakarta@pmi.or.id">
            kota_surakarta@pmi.or.id
        </a>
        <span>
            0271 646 505
        </span>
        <span>
            Jl. Kol. Sutarto No. 58 Jebres, Surakarta, Jawa Tengah 57126
        </span>
    </footer>
</body>

</html>
