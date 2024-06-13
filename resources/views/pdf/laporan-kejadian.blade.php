<!-- resources/views/reports/pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
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
    <h1>Report Details</h1>
    <p><strong>Report ID:</strong> {{ $report->id_report }}</p>
    <p><strong>User:</strong> {{ $report->user->name }}</p>
    <p><strong>Disaster Name:</strong> {{ $report->nama_bencana }}</p>
    <p><strong>Date of Incident:</strong> {{ $report->tanggal_kejadian }}</p>
    <p><strong>Description:</strong> {{ $report->keterangan }}</p>
    <p><strong>Status:</strong> {{ $report->status }}</p>
    <p><strong>Location (Longitude, Latitude):</strong> {{ $report->lokasi_longitude }}, {{ $report->lokasi_latitude }}</p>
    <p><strong>Timestamp:</strong> {{ $report->timestamp_report }}</p>

    <h2>Assessments</h2>
    <table>
        <thead>
            <tr>
                <th>Assessment ID</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report->assessments as $assessment)
                <tr>
                    <td>{{ $assessment->id }}</td>
                    <td>{{ $assessment->details }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
