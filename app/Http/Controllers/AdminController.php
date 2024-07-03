<?php

namespace App\Http\Controllers;

use App\Charts\ExsumChart;
use App\Models\AlatTdb;
use App\Models\Assessment;
use App\Models\Dampak;
use App\Models\EvakuasiKorban;
use App\Models\GiatPMI;
use App\Models\JenisKejadian;
use App\Models\KejadianBencana;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanInfrastruktur;
use App\Models\KerusakanRumah;
use App\Models\KorbanJlw;
use App\Models\KorbanTerdampak;
use App\Models\LampiranDokumentasi;
use App\Models\LayananKorban;
use App\Models\MobilisasiSd;
use App\Models\Pengungsian;
use App\Models\Personil;
use App\Models\PersonilNarahubung;
use App\Models\PetugasPosko;
use App\Models\Report;
use App\Models\Tsr;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function index_admin()
    {
        return view('admin.dashboard');
    }
    /**
     * Show the form for creating a new resource.
     */

    public function index_exsum(ExsumChart $chart)
    {
        $user = User::role('relawan')->get();
        $dampak = Dampak::all()->count();
        $kejadian = Report::join('jenis_kejadian', 'reports.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')
            ->select('reports.status', 'jenis_kejadian.nama_kejadian')->get();

        $layanan = LayananKorban::join('assessment', 'layanan_korban.id_assessment', '=', 'assessment.id_assessment')
            ->join('reports', 'assessment.id_report', '=', 'reports.id_report')
            ->join('jenis_kejadian', 'reports.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')
            ->select(
                'jenis_kejadian.nama_kejadian as nmKejadian',
                'reports.tanggal_kejadian as dateKejadian',
                'layanan_korban.distribusi as layDis',
                'layanan_korban.layanan_kesehatan as layKes',
                'assessment.status as stat'
            )->get();

        $mobilisasi = MobilisasiSd::where('id_personil', 1)->with([
            'tsr',
            'alatTdb',
            'personil',
        ])->get();

        $kkSum = KorbanTerdampak::sum('kk');
        $jiwaSum = KorbanTerdampak::sum('jiwa');
        $lRingan = KorbanJlw::sum('luka_ringan');
        $Meninggal = KorbanJlw::sum('meninggal');
        $Mengungsi = KorbanJlw::sum('mengungsi');
        $Hilang = KorbanJlw::sum('hilang');

        $jumlah = [
            'kk' => $kkSum,
            'jiwa' => $jiwaSum,
            'ringan' => $lRingan,
            'mati' => $Meninggal,
            'pengungsi' => $Mengungsi,
            'hilang' => $Hilang

        ];

        $tdb = [
            'o' => AlatTdb::sum('kend_ops'),
            'ta' => AlatTdb::sum('truk_angkut'),
            'tt' => AlatTdb::sum('truk_tanki'),
            'dd' => AlatTdb::sum('double_cabin'),
            'ad' => AlatTdb::sum('alat_du'),
            'rl' => AlatTdb::sum('rs_lapangan'),
            'aw' => AlatTdb::sum('alat_watsan'),
            'ap' => AlatTdb::sum('alat_pkdd')
        ];

        return view(
            'admin.executive_summary',
            [
                'chart' => $chart->build(),
                'bar' => $chart->bar(),
                'personil' => $chart->personil(),
                'dampak' => $dampak,
                'kejadian' => $kejadian,
                'layanan' => $layanan,
                'jumlah' => $jumlah,
                'user' => $user,
                'mobilisasi' => $mobilisasi,
                'tdb' => $tdb
            ]
        );
    }

    public function assessment_unverif()
    {
        return view('admin.assessment.unverified.index');
    }
    public function assessment_verif()
    {
        return view('admin.assessment.verified.index');
    }
    public function index_laporankejadian()
    {
        $reports = Report::all();
        return view('admin.laporan-kejadian.index', compact('reports'));
    }

    public function index_assessment()
    {
        $assessments = Assessment::all();
        return view('admin.assessment.index', compact('assessments'));
    }

    public function index_lapsit()
    {
        $kejadian = KejadianBencana::join('jenis_kejadian', 'kejadian_bencana.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')
            ->select('*', 'kejadian_bencana.updated_at as terbaru', 'jenis_kejadian.nama_kejadian as nmKejadian')
            ->get();
        return view('admin.lapsit.index', compact('kejadian'));
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
        ]);

        $tanggalKejadian = \Carbon\Carbon::parse($request->tanggal_kejadian)->format('Y-m-d H:i:s');
        $timestampReport = \Carbon\Carbon::parse($request->timestamp_report)->format('Y-m-d H:i:s');

        $randomRelawanUser = User::role('relawan')->inRandomOrder()->first();

        $laporanKejadian = new Report();
        $laporanKejadian->id_relawan = $randomRelawanUser->id;
        $laporanKejadian->id_jeniskejadian = $request->id_jeniskejadian;
        $laporanKejadian->tanggal_kejadian = $tanggalKejadian;
        $laporanKejadian->timestamp_report = $timestampReport;
        $laporanKejadian->keterangan = $request->keterangan;
        $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        $laporanKejadian->status = "On Process";
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

    public function update_laporankejadian(Request $request, $id)
    {



        $tanggalKejadian = \Carbon\Carbon::parse($request->tanggal_kejadian)->format('Y-m-d H:i:s');
        $timestampReport = \Carbon\Carbon::parse($request->timestamp_report)->format('Y-m-d H:i:s');

        $laporanKejadian = Report::where('id_report', $id)->firstOrFail();

        $laporanKejadian->tanggal_kejadian = $tanggalKejadian;
        $laporanKejadian->timestamp_report = $timestampReport;
        $laporanKejadian->keterangan = $request->keterangan;
        $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        // $laporanKejadian->status = $request->status;
        $laporanKejadian->save();

        return redirect()->route('admin-laporankejadian')->with('success', 'Laporan kejadian berhasil diupdate.');
        ;
    }

    /**
     * @Route("/relawan/laporan-kejadian/delete/{id}", name="delete_kejadian", methods={"DELETE"})
     */
    public function delete_laporankejadian(Request $request, string $id)
    {
        $report = Report::findOrFail($id);

        if ($report->status === 'On Process') {
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


    // CREATE, UPDATE, DELETE LAPORAN ASSESSMENT

    public function response_assessment($id)
    {
        $assessment = Assessment::where('id_assessment', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd.personil',
                'kejadianBencana.mobilisasiSd.tsr',
                'kejadianBencana.mobilisasiSd.alatTdb',
                'kejadianBencana.giatPmi.evakuasiKorban',
                'kejadianBencana.giatPmi.layananKorban',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak.korbanTerdampak',
                'kejadianBencana.dampak.korbanJlw',
                'kejadianBencana.dampak.kerusakanRumah',
                'kejadianBencana.dampak.kerusakanFasilitasSosial',
                'kejadianBencana.dampak.kerusakanInfrastruktur',
                'kejadianBencana.dampak.pengungsian'
            ])
            ->first();

        $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->waktuKejadian = $this->formatDateTime($assessment->report->timestamp_report);
        $assessment->updateAt = $this->formatDateTime($assessment->report->updated_at);

        return response()->json($assessment);
        // return view('admin.assessment.view', compact('assessment'));
    }

    public function view_assessment($id)
    {
        $assessment = Assessment::where('id_assessment', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd.personil',
                'kejadianBencana.mobilisasiSd.tsr',
                'kejadianBencana.mobilisasiSd.alatTdb',
                'kejadianBencana.giatPmi.evakuasiKorban',
                'kejadianBencana.giatPmi.layananKorban',
                'kejadianBencana.dampak.korbanTerdampak',
                'kejadianBencana.dampak.korbanJlw',
                'kejadianBencana.dampak.kerusakanRumah',
                'kejadianBencana.dampak.kerusakanFasilitasSosial',
                'kejadianBencana.dampak.kerusakanInfrastruktur',
            ])
            ->first();

        $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->waktuKejadian = $this->formatDateTime($assessment->report->timestamp_report);
        $assessment->updateAt = $this->formatDateTime($assessment->report->updated_at);

        // Handle only the first kejadianBencana
        $firstKejadian = $assessment->kejadianBencana->first();

        if ($firstKejadian) {
            // You can access the nested properties here
            $firstKejadian->korbanTerdampak = $firstKejadian->dampak->korbanTerdampak;
            $firstKejadian->korbanJlw = $firstKejadian->dampak->korbanJlw;
            $firstKejadian->kerusakanRumah = $firstKejadian->dampak->kerusakanRumah;
            $firstKejadian->kerusakanFasilitasSosial = $firstKejadian->dampak->kerusakanFasilitasSosial;
            $firstKejadian->kerusakanInfrastruktur = $firstKejadian->dampak->kerusakanInfrastruktur;
            $firstKejadian->pengungsian = $firstKejadian->dampak->pengungsian;
            $firstKejadian->evakuasiKorban = $firstKejadian->giatPmi->evakuasiKorban;
            $firstKejadian->layananKorban = $firstKejadian->giatPmi->layananKorban;
            $firstKejadian->personil = $firstKejadian->mobilisasiSd->personil;
            $firstKejadian->tsr = $firstKejadian->mobilisasiSd->tsr;
            $firstKejadian->alatTdb = $firstKejadian->mobilisasiSd->alatTdb;

            $narahubung = PersonilNarahubung::where('id_kejadian', $firstKejadian->id_kejadian)->get();
            $petugas_posko = PetugasPosko::where('id_kejadian', $firstKejadian->id_kejadian)->get();
            $dokumentasi = LampiranDokumentasi::where('id_kejadian', $firstKejadian->id_kejadian)->get();
            $id_dampak = $firstKejadian->dampak->id_dampak;
            $pengungsian = Pengungsian::where('id_dampak', $id_dampak)->get();

            $firstKejadian->narahubung = $narahubung;
            $firstKejadian->petugas_posko = $petugas_posko;
            $firstKejadian->dokumentasi = $dokumentasi;
            $firstKejadian->pengungsian = $pengungsian;
        }

        return view('admin.assessment.view', compact('assessment', 'firstKejadian'));

        // return response()->json($assessment);
    }

    public function verif_assessment($id)
    {
        $assessment = Assessment::where('id_assessment', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd.personil',
                'kejadianBencana.mobilisasiSd.tsr',
                'kejadianBencana.mobilisasiSd.alatTdb',
                'kejadianBencana.giatPmi.evakuasiKorban',
                'kejadianBencana.giatPmi.layananKorban',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak.korbanTerdampak',
                'kejadianBencana.dampak.korbanJlw',
                'kejadianBencana.dampak.kerusakanRumah',
                'kejadianBencana.dampak.kerusakanFasilitasSosial',
                'kejadianBencana.dampak.kerusakanInfrastruktur',
                'kejadianBencana.dampak.pengungsian'
            ])
            ->first();

        $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->waktuKejadian = $this->formatDateTime($assessment->report->timestamp_report);
        $assessment->updateAt = $this->formatDateTime($assessment->report->updated_at);

        // Handle only the first kejadianBencana
        $firstKejadian = $assessment->kejadianBencana->first();

        if ($firstKejadian) {
            // You can access the nested properties here
            $firstKejadian->korbanTerdampak = $firstKejadian->dampak->korbanTerdampak;
            $firstKejadian->korbanJlw = $firstKejadian->dampak->korbanJlw;
            $firstKejadian->kerusakanRumah = $firstKejadian->dampak->kerusakanRumah;
            $firstKejadian->kerusakanFasilitasSosial = $firstKejadian->dampak->kerusakanFasilitasSosial;
            $firstKejadian->kerusakanInfrastruktur = $firstKejadian->dampak->kerusakanInfrastruktur;
            $firstKejadian->pengungsian = $firstKejadian->dampak->pengungsian;
            $firstKejadian->evakuasiKorban = $firstKejadian->giatPmi->evakuasiKorban;
            $firstKejadian->layananKorban = $firstKejadian->giatPmi->layananKorban;
            $firstKejadian->personil = $firstKejadian->mobilisasiSd->personil;
            $firstKejadian->tsr = $firstKejadian->mobilisasiSd->tsr;
            $firstKejadian->alatTdb = $firstKejadian->mobilisasiSd->alatTdb;
        }

        return view('admin.assessment.verif', compact('assessment', 'firstKejadian'));

        // return response()->json($assessment);
    }

    public function selesai_assessment($id)
    {
        $assessment = Assessment::where('id_assessment', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd.personil',
                'kejadianBencana.mobilisasiSd.tsr',
                'kejadianBencana.mobilisasiSd.alatTdb',
                'kejadianBencana.giatPmi.evakuasiKorban',
                'kejadianBencana.giatPmi.layananKorban',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak.korbanTerdampak',
                'kejadianBencana.dampak.korbanJlw',
                'kejadianBencana.dampak.kerusakanRumah',
                'kejadianBencana.dampak.kerusakanFasilitasSosial',
                'kejadianBencana.dampak.kerusakanInfrastruktur',
                'kejadianBencana.dampak.pengungsian'
            ])
            ->first();

        $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->waktuKejadian = $this->formatDateTime($assessment->report->timestamp_report);
        $assessment->updateAt = $this->formatDateTime($assessment->report->updated_at);

        // Handle only the first kejadianBencana
        $firstKejadian = $assessment->kejadianBencana->first();

        if ($firstKejadian) {
            // You can access the nested properties here
            $firstKejadian->korbanTerdampak = $firstKejadian->dampak->korbanTerdampak;
            $firstKejadian->korbanJlw = $firstKejadian->dampak->korbanJlw;
            $firstKejadian->kerusakanRumah = $firstKejadian->dampak->kerusakanRumah;
            $firstKejadian->kerusakanFasilitasSosial = $firstKejadian->dampak->kerusakanFasilitasSosial;
            $firstKejadian->kerusakanInfrastruktur = $firstKejadian->dampak->kerusakanInfrastruktur;
            $firstKejadian->pengungsian = $firstKejadian->dampak->pengungsian;
            $firstKejadian->evakuasiKorban = $firstKejadian->giatPmi->evakuasiKorban;
            $firstKejadian->layananKorban = $firstKejadian->giatPmi->layananKorban;
            $firstKejadian->personil = $firstKejadian->mobilisasiSd->personil;
            $firstKejadian->tsr = $firstKejadian->mobilisasiSd->tsr;
            $firstKejadian->alatTdb = $firstKejadian->mobilisasiSd->alatTdb;
        }

        return view('admin.assessment.selesai', compact('assessment', 'firstKejadian'));

        // return response()->json($assessment);
    }

    public function verify_assessment(Request $request, $id)
    {

        $assessment = Assessment::where('id_assessment', $id)->firstOrFail();

        $assessment->status = "Aktif";
        $assessment->save();

        return redirect()->route('admin-assessment')->with('success', 'Laporan assessment berhasil diverifikasi.');
        ;

    }

    public function done_assessment(Request $request, $id)
    {

        $assessment = Assessment::where('id_assessment', $id)->firstOrFail();

        $assessment->status = "Selesai";
        $assessment->save();

        return redirect()->route('admin-assessment')->with('success', 'Laporan assessment berhasil diselesaikan.');
        ;

    }

    public function create_assessment($id)
    {
        $report = Report::findOrFail($id);
        $jeniskejadian = JenisKejadian::all();
        return view('admin.assessment.create', compact('report', 'jeniskejadian'));
    }

    public function store_assessment(Request $request)
    {
        dd($request->all());
        // Validasi data yang diterima dari permintaan
        // (Rest of the code remains unchanged)

        return view('admin.assessment.edit', compact('kejadian'));
    }

    public function edit_assessment($id)
    {
        // Mengambil data kejadian bencana berdasarkan id_assessment
        $kejadian = KejadianBencana::where('id_assessment', $id)->with([
            'giatPmi.evakuasiKorban',
            'giatPmi.layananKorban',
            'dampak.korbanTerdampak',
            'dampak.korbanJlw',
            'dampak.kerusakanRumah',
            'dampak.kerusakanFasilitasSosial',
            'dampak.kerusakanInfrastruktur',
            'dampak.pengungsian',
            'narahubung',
            'petugasPosko'
        ])->firstOrFail();
        $jenisKejadian = JenisKejadian::all();

        return view('admin.assessment.edit', compact('kejadian', 'jenisKejadian'));
    }

    public function update_assessment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'update' => 'required|date',
            'akses_ke_lokasi' => 'required|in:Accessible,Not Accessible',
            'kebutuhan' => 'required|string',
            // Validasi untuk data dampak
            'kk' => 'nullable|integer',
            'jiwa' => 'nullable|integer',
            'luka_berat' => 'nullable|integer',
            'luka_ringan' => 'nullable|integer',
            'meninggaljlw' => 'nullable|integer',
            'hilang' => 'nullable|integer',
            'mengungsi' => 'nullable|integer',
            'rusak_berat' => 'nullable|integer',
            'rusak_sedang' => 'nullable|integer',
            'rusak_ringan' => 'nullable|integer',
            'sekolah' => 'nullable|string',
            'tempat_ibadah' => 'nullable|string',
            'rumah_sakit' => 'nullable|string',
            'pasar' => 'nullable|string',
            'gedung_pemerintah' => 'nullable|string',
            'lain_lain' => 'nullable|string',
            'desc_kerusakan' => 'nullable|string',
            // Validasi untuk data giat pmi
            'luka_ringanberat' => 'nullable|string',
            'meninggalevakuasi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'distribusi' => 'nullable|string',
            'dapur_umum' => 'nullable|string',
            'evakuasi' => 'nullable|string',
            'layanan_kesehatan' => 'nullable|string',
            // Validasi untuk data narahubung
            'narahubung' => 'sometimes|array',
            'narahubung.*.id_narahubung' => 'sometimes|exists:personil_narahubung,id_narahubung',
            'narahubung.*.nama_lengkap' => 'required|string',
            'narahubung.*.posisi' => 'required|string',
            'narahubung.*.kontak' => 'required|string',
            // Validasi untuk data pengungsian
            'pengungsian' => 'sometimes|array',
            'pengungsian.*.id_pengungsian' => 'sometimes|exists:pengungsian,id_pengungsian',
            'pengungsian.*.nama_lokasi' => 'required|string',
            'pengungsian.*.laki_laki' => 'required|integer',
            'pengungsian.*.perempuan' => 'required|integer',
            'pengungsian.*.kurang_dari_5' => 'required|integer',
            'pengungsian.*.atr_5_sampai_18' => 'required|integer',
            'pengungsian.*.lebih_dari_18' => 'required|integer',
            'pengungsian.*.jumlah' => 'required|integer',
            'pengungsian.*.kk' => 'required|integer',
            'pengungsian.*.jiwa' => 'required|integer',
        ]);

        $kejadian = KejadianBencana::where('id_assessment', $id)->firstOrFail();

        // Update kejadian bencana
        $kejadian->update([
            'update' => $validatedData['update'],
            'akses_ke_lokasi' => $validatedData['akses_ke_lokasi'],
            'kebutuhan' => $validatedData['kebutuhan'],
        ]);

        // Update atau create dampak
        $dampak = $kejadian->dampak;
        $dampak->save();
        $kejadian->update(['id_dampak' => $dampak->id_dampak]);

        // Update korban terdampak
        $korbanTerdampak = $dampak->korbanTerdampak;
        $korbanTerdampak->kk = $validatedData['kk'];
        $korbanTerdampak->jiwa = $validatedData['jiwa'];
        $korbanTerdampak->save();

        // if ($korbanTerdampak->id) {
        //     $dampak->update(['id_korban_terdampak' => $korbanTerdampak->id]);
        // } else {
        //     // Handle the case where KorbanTerdampak couldn't be saved
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Korban Terdampak');
        // }

        // Update korban jiwa/luka/mengungsi
        $korbanJlw = $dampak->korbanJlw;
        $korbanJlw->luka_berat = $validatedData['luka_berat'];
        $korbanJlw->luka_ringan = $validatedData['luka_ringan'];
        $korbanJlw->meninggal = $validatedData['meninggaljlw'];
        $korbanJlw->hilang = $validatedData['hilang'];
        $korbanJlw->mengungsi = $validatedData['mengungsi'];
        $korbanJlw->save();

        // if ($korbanJlw->id) {
        //     $dampak->update(['id_korban_jlw' => $korbanJlw->id]);
        // } else {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Korban JLW');
        // }

        // Update kerusakan rumah
        $kerusakanRumah = $dampak->kerusakanRumah;
        $kerusakanRumah->rusak_berat = $validatedData['rusak_berat'];
        $kerusakanRumah->rusak_sedang = $validatedData['rusak_sedang'];
        $kerusakanRumah->rusak_ringan = $validatedData['rusak_ringan'];
        $kerusakanRumah->save();

        // if ($kerusakanRumah->id) {
        //     $dampak->update(['id_kerusakan_rumah' => $kerusakanRumah->id]);
        // } else {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Kerusakan Rumah');
        // }

        // Update kerusakan rumah
        $kerusakanFasilitasSosial = $dampak->kerusakanFasilitasSosial;
        $kerusakanFasilitasSosial->sekolah = $validatedData['sekolah'];
        $kerusakanFasilitasSosial->tempat_ibadah = $validatedData['tempat_ibadah'];
        $kerusakanFasilitasSosial->rumah_sakit = $validatedData['rumah_sakit'];
        $kerusakanFasilitasSosial->pasar = $validatedData['pasar'];
        $kerusakanFasilitasSosial->gedung_pemerintah = $validatedData['gedung_pemerintah'];
        $kerusakanFasilitasSosial->lain_lain = $validatedData['lain_lain'];
        $kerusakanFasilitasSosial->save();

        // if ($kerusakanRumah->id) {
        //     $dampak->update(['id_kerusakan_rumah' => $kerusakanRumah->id]);
        // } else {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Kerusakan Rumah');
        // }

        // Update kerusakan fasilitas sosial
        $kerusakanFasilitasSosial = $dampak->kerusakanFasilitasSosial;
        $kerusakanFasilitasSosial->sekolah = $validatedData['sekolah'];
        $kerusakanFasilitasSosial->tempat_ibadah = $validatedData['tempat_ibadah'];
        $kerusakanFasilitasSosial->rumah_sakit = $validatedData['rumah_sakit'];
        $kerusakanFasilitasSosial->pasar = $validatedData['pasar'];
        $kerusakanFasilitasSosial->gedung_pemerintah = $validatedData['gedung_pemerintah'];
        $kerusakanFasilitasSosial->lain_lain = $validatedData['lain_lain'];
        $kerusakanFasilitasSosial->save();

        // if ($kerusakanFasilitasSosial->id) {
        //     $dampak->update(['id_kerusakan_fasil_sosial' => $kerusakanFasilitasSosial->id]);
        // } else {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Kerusakan Rumah');
        // }

        // Update kerusakan infrastruktur
        $kerusakanInfrastruktur = $dampak->kerusakanInfrastruktur;
        $kerusakanInfrastruktur->desc_kerusakan = $validatedData['desc_kerusakan'];
        $kerusakanInfrastruktur->save();

        // if ($kerusakanInfrastruktur->id) {
        //     $dampak->update(['id_kerusakan_infrastruktur' => $kerusakanInfrastruktur->id]);
        // } else {
        //     return redirect()->back()->with('error', 'Gagal menyimpan data Kerusakan Rumah');
        // }

        // Update atau create giat pmi
        $giatPmi = $kejadian->giatPmi;
        $giatPmi->save();
        $kejadian->update(['id_giat_pmi' => $giatPmi->id_giatpmi]);


        // Update evakuasi korban
        $evakuasiKorban = $giatPmi->evakuasiKorban;
        $evakuasiKorban->luka_ringanberat = $validatedData['luka_ringanberat'];
        $evakuasiKorban->meninggal = $validatedData['meninggalevakuasi'];
        $evakuasiKorban->keterangan = $validatedData['keterangan'];
        $evakuasiKorban->save();

        // Update layanan korban
        $layananKorban = $giatPmi->layananKorban;
        $layananKorban->distribusi = $validatedData['distribusi'];
        $layananKorban->dapur_umum = $validatedData['dapur_umum'];
        $layananKorban->evakuasi = $validatedData['evakuasi'];
        $layananKorban->layanan_kesehatan = $validatedData['layanan_kesehatan'];
        $layananKorban->save();

        // Proses data narahubung
        if (isset($validatedData['narahubung'])) {
            // Mendapatkan semua id_narahubung yang ada di request
            $requestedIds = collect($validatedData['narahubung'])->pluck('id_narahubung')->filter()->toArray();

            // Menghapus narahubung yang tidak ada di request (yang dihapus oleh user)
            $kejadian->narahubung()->whereNotIn('id_narahubung', $requestedIds)->delete();

            foreach ($validatedData['narahubung'] as $narahubungData) {
                if (isset($narahubungData['id_narahubung'])) {
                    // Update narahubung yang sudah ada
                    $kejadian->narahubung()->where('id_narahubung', $narahubungData['id_narahubung'])
                        ->update([
                            'nama_lengkap' => $narahubungData['nama_lengkap'],
                            'posisi' => $narahubungData['posisi'],
                            'kontak' => $narahubungData['kontak'],
                        ]);
                } else {
                    // Tambah narahubung baru
                    $kejadian->narahubung()->create([
                        'nama_lengkap' => $narahubungData['nama_lengkap'],
                        'posisi' => $narahubungData['posisi'],
                        'kontak' => $narahubungData['kontak'],
                    ]);
                }
            }
        }

        // Proses data pengungsian
        if (isset($validatedData['pengungsian'])) {
            // Mendapatkan semua id_pengungsian yang ada di request
            $requestedIds = collect($validatedData['pengungsian'])->pluck('id_pengungsian')->filter()->toArray();

            // Menghapus pengungsian yang tidak ada di request (yang dihapus oleh user)
            $dampak->pengungsian()->whereNotIn('id_pengungsian', $requestedIds)->delete();

            foreach ($validatedData['pengungsian'] as $pengungsianData) {
                if (isset($pengungsianData['id_pengungsian'])) {
                    // Update pengungsian yang sudah ada
                    $dampak->pengungsian()->where('id_pengungsian', $pengungsianData['id_pengungsian'])
                        ->update($pengungsianData);
                } else {
                    // Tambah pengungsian baru
                    $dampak->pengungsian()->create($pengungsianData);
                }
            }
        }


        return redirect()->route('admin-assessment', $kejadian->id_kejadian)->with('success', 'Laporan Assessment berhasil diperbarui');
    }

    public function delete_assessment(string $id)
    {
        // Ambil data assessment berdasarkan id
        $assessment = Assessment::findOrFail($id);

        // Cek status verifikasi dari assessment
        if ($assessment->hasil_verifikasi == 'Belum Diverifikasi') {
            // Hapus data kejadian_bencana yang terkait dengan assessment
            $kejadianBencana = KejadianBencana::where('id_kejadian', $assessment->id_kejadian)->first();
            if ($kejadianBencana) {
                $kejadianBencana->delete();
            }

            // Hapus data assessment
            $assessment->delete();

            return redirect('admin/assesment')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect('admin/assesment')->with('error', 'Hanya data yang belum diverifikasi yang dapat dihapus');
        }
    }

    // CREATE, UPDATE, DELETE LAPORAN SITUASI
    public function response_lapsit($id)
    {
        $lapsit = KejadianBencana::where('id_kejadian', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'jenisKejadian',
                'assessment.report',
                'admin',
                'relawan',
                'mobilisasiSd.personil',
                'mobilisasiSd.tsr',
                'mobilisasiSd.alatTdb',
                'giatPmi.evakuasiKorban',
                'giatPmi.layananKorban',
                'dokumentasi',
                'narahubung',
                'petugasPosko',
                'dampak.korbanTerdampak',
                'dampak.korbanJlw',
                'dampak.kerusakanRumah',
                'dampak.kerusakanFasilitasSosial',
                'dampak.kerusakanInfrastruktur',
                'dampak.pengungsian'
            ])
            ->first();
        ;

        $lapsit->locationName = $this->getLocationName($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
        $lapsit->googleMapsLink = $this->getGoogleMapsLink($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
        $lapsit->waktuKejadian = $this->formatDateTime($lapsit->assessment->report->timestamp_report);
        $lapsit->updateAt = $this->formatDateTime($lapsit->assessment->report->updated_at);

        return response()->json($lapsit);
        // return view('relawan.assessment.view', compact('assessment'));

    }

    public function view_lapsit($id)
    {
        $lapsit = KejadianBencana::where('id_kejadian', $id) // Nama fungsi relasi dalam model Report
            ->with([
                'jenisKejadian',
                'assessment.report',
                'admin',
                'relawan',
                'mobilisasiSd.personil',
                'mobilisasiSd.tsr',
                'mobilisasiSd.alatTdb',
                'giatPmi.evakuasiKorban',
                'giatPmi.layananKorban',
                'dampak.korbanTerdampak',
                'dampak.korbanJlw',
                'dampak.kerusakanRumah',
                'dampak.kerusakanFasilitasSosial',
                'dampak.kerusakanInfrastruktur',
            ])
            ->first();
        ;

        $lapsit->locationName = $this->getLocationName($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
        $lapsit->googleMapsLink = $this->getGoogleMapsLink($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
        $lapsit->waktuKejadian = $this->formatDateTime($lapsit->assessment->report->timestamp_report);
        $lapsit->updateAt = $this->formatDateTime($lapsit->assessment->report->updated_at);

        $lapsit->korbanTerdampak = $lapsit->dampak->korbanTerdampak;
        $lapsit->korbanJlw = $lapsit->dampak->korbanJlw;
        $lapsit->kerusakanRumah = $lapsit->dampak->kerusakanRumah;
        $lapsit->kerusakanFasilitasSosial = $lapsit->dampak->kerusakanFasilitasSosial;
        $lapsit->kerusakanInfrastruktur = $lapsit->dampak->kerusakanInfrastruktur;
        $lapsit->pengungsian = $lapsit->dampak->pengungsian;
        $lapsit->evakuasiKorban = $lapsit->giatPmi->evakuasiKorban;
        $lapsit->layananKorban = $lapsit->giatPmi->layananKorban;
        $lapsit->personil = $lapsit->mobilisasiSd->personil;
        $lapsit->tsr = $lapsit->mobilisasiSd->tsr;
        $lapsit->alatTdb = $lapsit->mobilisasiSd->alatTdb;

        $assessment = $lapsit->assessment;

        $narahubung = PersonilNarahubung::where('id_kejadian', $id)->get();
        $petugas_posko = PetugasPosko::where('id_kejadian', $id)->get();
        $dokumentasi = LampiranDokumentasi::where('id_kejadian', $id)->get();
        $id_dampak = $lapsit->dampak->id_dampak;
        $pengungsian = Pengungsian::where('id_dampak', $id_dampak)->get();

        $lapsit->narahubung = $narahubung;
        $lapsit->petugas_posko = $petugas_posko;
        $lapsit->dokumentasi = $dokumentasi;
        $lapsit->pengungsian = $pengungsian;

        return view('admin.lapsit.view', compact('lapsit', 'assessment'));

        // return response()->json($assessment);

    }

    public function lapsit()
    {
        $user = User::all();
        $kejadian = KejadianBencana::join('jenis_kejadian', 'kejadian_bencana.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')
            ->select('*', 'kejadian_bencana.updated_at as up')->get();
        notify()->preset('success', ['message' => 'Berhasil Mengirim Pesan Whatsapp']);
        return view('admin.lapsit.index', compact('user', 'kejadian'));
    }

    public function Sharelapsit($id)
    {
        $kejadian = KejadianBencana::join('jenis_kejadian', 'kejadian_bencana.id_jeniskejadian', '=', 'jenis_kejadian.id_jeniskejadian')
            ->where('id_kejadian', $id)
            ->select('*', 'kejadian_bencana.updated_at as terbaru', 'jenis_kejadian.nama_kejadian as nmKejadian')
            ->first();

        $datenow = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-M-d H:i');

        $as = 2;
        // dd($kejadian);
        return view('admin.lapsit.share', compact('kejadian', 'as', 'datenow'));
    }

    public function generateFlashReport($id)
    {

        return view('pdf.flash-report', compact('id'));
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
        $url = 'https://nominatim.openstreetmap.org/reverse';
        $params = [
            'format' => 'json',
            'lat' => $latitude,
            'lon' => $longitude,
            'addressdetails' => 1,
        ];

        $response = Http::get($url, $params);

        // Check HTTP status
        if ($response->successful()) {
            // Debug: Print the full URL and response
            // dd($url . '?' . http_build_query($params), $response->body());

            $data = $response->json();

            // Check if 'address' key exists
            if (isset($data['address'])) {
                // Check for city, town, or village
                if (isset($data['address']['village'])) {
                    return $data['address']['village'];
                } elseif (isset($data['address']['city'])) {
                    return $data['address']['city'];
                } elseif (isset($data['address']['town'])) {
                    return $data['address']['town'];
                } 
            }

            return 'Location not found';
        } else {
            // Print out error message for unsuccessful request
            // dd('Error: ' . $response->status());

            return 'Location not found';
        }
    }

    // public function getLocationName($latitude, $longitude)
    // {
    //     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    //         'latlng' => $latitude . ',' . $longitude,
    //         'key' => config('services.google_maps.api_key'),
    //     ]);

    //     $data = $response->json();

    //     dd($data);

    //     if (!empty($data['results'])) {
    //         foreach ($data['results'][0]['address_components'] as $component) {
    //             if (in_array('locality', $component['types'])) {
    //                 return $component['long_name']; // City name
    //             } elseif (in_array('administrative_area_level_1', $component['types'])) {
    //                 $administrative_area_level_1 = $component['long_name'];
    //             } elseif (in_array('administrative_area_level_2', $component['types'])) {
    //                 $administrative_area_level_2 = $component['long_name'];
    //             }
    //         }
    //         // If locality is not found, return the next best thing
    //         if (isset($administrative_area_level_2)) {
    //             return $administrative_area_level_2;
    //         } elseif (isset($administrative_area_level_1)) {
    //             return $administrative_area_level_1;
    //         }
    //     }

    //     return 'City not found';
    // }

    public function getGoogleMapsLink($latitude, $longitude)
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . $latitude . ',' . $longitude;
    }
}
