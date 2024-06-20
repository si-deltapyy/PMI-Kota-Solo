<?php
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Import Http Facade

class SelectStatusController extends Controller
{
    public function admin_laporan_kejadian_unverified(Request $request)
    {

        $reports = Report::where('status', "Belum Diverifikasi")->get();

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $reports->each(function ($report) {
            $report->id = $report->id_report;
            $report->nama_kejadian = $report->jenisKejadian->nama_kejadian;
            // Fetch location details
            $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
            $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        });

        return response()->json($reports);
    }

    public function admin_laporan_kejadian_verified(Request $request)
    {

        $reports = Report::whereNot('status', "Belum Diverifikasi")->get();

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $reports->each(function ($report) {
            $report->id = $report->id_report;
            $report->nama_kejadian = $report->jenisKejadian->nama_kejadian;
            // Fetch location details
            $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
            $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        });

        return response()->json($reports);
    }

    public function admin_laporan_kejadian(Request $request)
    {
        $status = $request->query('status');
        $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $reports = Report::with('jenisKejadian') // Nama fungsi relasi dalam model Report
                ->where('status', $status)
                ->get();
        } else {
            $reports = Report::with('jenisKejadian')
                ->get();
        }

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $reports->each(function ($report) {
            $report->id = $report->id_report;
            $report->nama_kejadian = $report->jenisKejadian->nama_kejadian;
            // Fetch location details
            $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
            $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        });

        return response()->json($reports);
    }

    public function relawan_laporan_kejadian(Request $request)
    {
        $status = $request->query('status');
        $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $reports = Report::with('jenisKejadian') // Nama fungsi relasi dalam model Report
                ->where('status', $status)
                ->where('id_relawan', $id_user)
                ->get();
        } else {
            $reports = Report::with('jenisKejadian')
                ->where('id_relawan', $id_user)
                ->get();
        }

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $reports->each(function ($report) {
            $report->id = $report->id_report;
            $report->nama_kejadian = $report->jenisKejadian->nama_kejadian;
            // Fetch location details
            $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
            $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        });

        return response()->json($reports);
    }

    public function getLocationName($latitude, $longitude)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'latlng' => $latitude . ',' . $longitude,
            'key' => config('services.google_maps.api_key'),
        ]);

        $data = $response->json();

        if (isset($data['results'][0]['formatted_address'])) {
            return $data['results'][0]['formatted_address'];
        } else {
            return 'Location not found';
        }
    }

    public function getGoogleMapsLink($latitude, $longitude)
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . $latitude . ',' . $longitude;
    }
}
