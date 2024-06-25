<?php

namespace App\Http\Controllers;

use App\Charts\ExsumChart;
use App\Models\Report;
use App\Models\User;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\KejadianBencana;
use App\Models\Assessment;
use App\Models\Dampak;
use App\Models\JenisKejadian;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function index_admin(ExsumChart $chart)
    {
        $dampak = Dampak::all()->count();
        $kejadian = Report::all();
        return view('admin.dashboard',
        [
            'chart' => $chart->build(), 
            'dampak' => $dampak,
            'kejadian' => $kejadian
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */

    public function index_exsum()
    {
        return view('admin.executive_summary');
    }
    // public function assessment_unverif()
    // {
    //     return view('admin.assessment.unverified.index');
    // }
    // public function assessment_verif()
    // {
    //     return view('admin.assessment.verified.index');
    // }

    // VERIF UNVERIF LAPORAN ASSESSMENT
    public function assessment_unverif()
    {
        $reports = Report::with('jenisKejadian')->get(); 

        return view('admin.assessment.unverified.index',compact('reports'));
    }
    public function assessment_verif()
    {
        return view('admin.assessment.verified.index');
    }

    // get modal kejadian bencana 

        public function getDetail($id)
    {
        // $kejadian = KejadianBencana::find($id);
        // return response()->json($kejadian);

        $kejadian = KejadianBencana::find($id);
    Log::info('Kejadian fetched:', $kejadian->toArray());
    return response()->json($kejadian);
    }
    public function index_laporankejadian()
    {
        $reports = Report::all(); 
        return view('admin.laporankejadian.index', compact('reports'));
    }

        /**
     * Show the form for creating a new resource.
     */
    // CREATE, UPDATE, DELETE LAPORAN KEJADIAN
    public function create_laporankejadian()
    {
        $jeniskejadian = JenisKejadian::all();
        return view('admin.laporankejadian.create', compact('jeniskejadian'));
    }
    public function store_laporankejadian(Request $request)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required',
            'tanggal_kejadian' => 'required|date',
            'timestamp_report' => 'required|date',
            'keterangan' => 'required|string',
            'lokasi_longitude' => 'nullable|numeric',
            'lokasi_latitude' => 'nullable|numeric',
            'status' => 'required|in:On Process,Valid,Invalid',
        ]);

        $tanggalKejadian = \Carbon\Carbon::parse($request->tanggal_kejadian)->format('Y-m-d H:i:s');
        $timestampReport = \Carbon\Carbon::parse($request->timestamp_report)->format('Y-m-d H:i:s');

        $laporanKejadian = new Report();
        $laporanKejadian->id_relawan = auth()->user()->id;
        $laporanKejadian->id_jeniskejadian = $request->id_jeniskejadian;
        $laporanKejadian->tanggal_kejadian = $tanggalKejadian;
        $laporanKejadian->timestamp_report = $timestampReport;
        $laporanKejadian->keterangan = $request->keterangan;
        // $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        // $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        $laporanKejadian->locationName = $this->getLocationName($request->lokasi_latitude, $request->lokasi_longitude);
        $laporanKejadian->googleMapsLink = $this->getGoogleMapsLink($request->lokasi_latitude, $request->lokasi_longitude);
        $laporanKejadian->save();

        return redirect()->route('admin-laporankejadian')->with('success', 'Laporan kejadian berhasil ditambahkan.');
    }

    public function view_laporankejadian($id)
    {
        // Mengambil data report berdasarkan ID
        $report = Report::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

        $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        $report->waktuKejadian = $this->formatDateTime($report->timestamp_report);
        $report->updateAt = $this->formatDateTime($report->updated_at);

        // Mengirimkan data ke view relawan.laporankejadian.index
        return view('admin.laporan-kejadian.view', compact('report'));
    }
    public function edit_laporankejadian($id)
    {
        // Mengambil data report berdasarkan ID
        $report = Report::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

        $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        $report->waktuKejadian = $this->formatDateTime($report->timestamp_report);
        $report->updateAt = $this->formatDateTime($report->updated_at);

        return view('admin.laporan-kejadian.edit', compact('report'));
    }

    /**
     * @Route("/relawan/laporan-kejadian/delete/{id}", name="delete_kejadian", methods={"DELETE"})
     */
    public function delete_laporankejadian(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        if ($report->status === 'Belum Diverifikasi') {
            $report->delete();

            // Check if the request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Return JSON response indicating success
                return new JsonResponse(['message' => 'Data laporan kejadian berhasil dihapus'], 200);
            } else {
                // Redirect for non-AJAX requests
                return redirect('admin/laporan-kejadian')->with('success', 'Data laporan kejadian berhasil dihapus');
            }
        } else {
            // Check if the request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Return JSON response indicating error
                return new JsonResponse(['message' => 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus'], 400);
            } else {
                // Redirect for non-AJAX requests
                return redirect('admin/laporan-kejadian')->with('error', 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus');
            }
        }

        // if ($report->status === 'Belum Diverifikasi') {
        //     $report->delete();
        //     return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan kejadian berhasil dihapus');
        // } else {
        //     return redirect('relawan/laporan-kejadian')->with('error', 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus');
        // }
    }

    public function laporan_kejadian_unverif()
    {
        return view('admin.laporan-kejadian.unverified.index');
    }
    public function laporan_kejadian_verif()
    {
        return view('admin.laporan-kejadian.verified.index');
    }

    public function laporan_kejadian_view(Request $request)
    {
        $id = $request->id;

        $report = Report::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

        $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        $report->waktuKejadian = $this->formatDateTime($report->timestamp_report);
        $report->updateAt = $this->formatDateTime($report->updated_at);

        return view('admin.laporan-kejadian.view', compact('report'));
    }
    public function laporan_kejadian_verif_view(Request $request)
    {
        $id = $request->id;

        $report = Report::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

        $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        $report->waktuKejadian = $this->formatDateTime($report->timestamp_report);
        $report->updateAt = $this->formatDateTime($report->updated_at);

        return view('admin.laporan-kejadian.unverified.verif', compact('report'));
    }

    public function lapsit()
    {
        $user = User::all();
        notify()->preset('success', ['message' => 'Berhasil Mengirim Pesan Whatsapp']);
        return view('admin.lapsit.index', compact('user'));
    }

    public function Sharelapsit($id)
    {
        $user = User::find($id);
        return view('admin.lapsit.share', compact('user'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function formatDateTime($isoTimestamp)
    {
        // Create a DateTime object from ISO 8601 timestamp
        $dateObject = new DateTime($isoTimestamp);

        // Extract date components
        $day = $dateObject->format('d'); // Day of the month (01 to 31)
        $month = $dateObject->format('m'); // Month (01 to 12)
        $year = $dateObject->format('Y'); // Year (e.g., 2024)

        // Extract time components
        $hours = $dateObject->format('H'); // Hours (00 to 23)
        $minutes = $dateObject->format('i'); // Minutes (00 to 59)
        $seconds = $dateObject->format('s'); // Seconds (00 to 59)

        // Ensure two-digit formatting with leading zeros
        $formattedDate = sprintf('%02d/%02d/%04d', $day, $month, $year);
        $formattedTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

        return ['date' => $formattedDate, 'time' => $formattedTime];
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
