<?php
namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\JenisKejadian;
use App\Models\KejadianBencana;
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

    public function relawan_assessment(Request $request)
    {
        $status = $request->query('status');
        $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $assessment = Assessment::where('id_relawan', $id_user) // Nama fungsi relasi dalam model Report
                ->where('status', $status)
                ->with([
                    'report.jenisKejadian',
                    'kejadianBencana.jenisKejadian',
                    'kejadianBencana.admin',
                    'kejadianBencana.relawan',
                    'kejadianBencana.mobilisasiSd',
                    'kejadianBencana.giatPmi',
                    'kejadianBencana.dokumentasi',
                    'kejadianBencana.narahubung',
                    'kejadianBencana.petugasPosko',
                    'kejadianBencana.dampak'
                ])
                ->get();
        } else {
            $assessment = Assessment::where('id_relawan', $id_user) // Nama fungsi relasi dalam model Report
                ->with([
                    'report.jenisKejadian',
                    'kejadianBencana',
                    'kejadianBencana.jenisKejadian',
                    'kejadianBencana.admin',
                    'kejadianBencana.relawan',
                    'kejadianBencana.mobilisasiSd',
                    'kejadianBencana.giatPmi',
                    'kejadianBencana.dokumentasi',
                    'kejadianBencana.narahubung',
                    'kejadianBencana.petugasPosko',
                    'kejadianBencana.dampak'
                ])
                ->get();
        }



        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $assessment->each(function ($assessment) {
            $assessment->id = $assessment->id_assessment;
            $assessment->nama_kejadian = $assessment->report->jenisKejadian->nama_kejadian;
            $assessment->timestamp_report = $assessment->report->timestamp_report;
            // Fetch location details
            // $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
            $firstKejadianBencana = $assessment->kejadianBencana->first();
            $assessment->lokasi = $firstKejadianBencana->lokasi;
            $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        });

        return response()->json($assessment);
    }

    public function admin_assessment(Request $request)
    {

        $status = $request->query('status');

        if ($status) {
            $assessment = Assessment::where('status', $status)
                ->with([
                    'report.jenisKejadian',
                    'kejadianBencana.jenisKejadian',
                    'kejadianBencana.admin',
                    'kejadianBencana.relawan',
                    'kejadianBencana.mobilisasiSd',
                    'kejadianBencana.giatPmi',
                    'kejadianBencana.dokumentasi',
                    'kejadianBencana.narahubung',
                    'kejadianBencana.petugasPosko',
                    'kejadianBencana.dampak'
                ])
                ->get();

        } else {
            $assessment = Assessment::with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd',
                'kejadianBencana.giatPmi',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak'
            ])
                ->get();

        }

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $assessment->each(function ($assessment) {
            $assessment->id = $assessment->report->id_report;
            $assessment->nama_kejadian = $assessment->report->jenisKejadian->nama_kejadian;
            $assessment->timestamp_report = $assessment->report->timestamp_report;
            // Fetch location details
            // $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
            $firstKejadianBencana = $assessment->kejadianBencana->first();
            $assessment->lokasi = $firstKejadianBencana->lokasi;
            $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        });

        return response()->json($assessment);
    }

    public function admin_assessment_unverif(Request $request)
    {

        $assessment = Assessment::where('status', 'On Process')
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd',
                'kejadianBencana.giatPmi',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak'
            ])
            ->get();

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $assessment->each(function ($assessment) {
            $assessment->id = $assessment->report->id_report;
            $assessment->nama_kejadian = $assessment->report->jenisKejadian->nama_kejadian;
            $assessment->timestamp_report = $assessment->report->timestamp_report;
            // Fetch location details
            $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
            $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        });

        return response()->json($assessment);
    }

    public function admin_assessment_verif(Request $request)
    {

        $assessment = Assessment::whereNot('status', 'On Process')
            ->with([
                'report.jenisKejadian',
                'kejadianBencana.jenisKejadian',
                'kejadianBencana.admin',
                'kejadianBencana.relawan',
                'kejadianBencana.mobilisasiSd',
                'kejadianBencana.giatPmi',
                'kejadianBencana.dokumentasi',
                'kejadianBencana.narahubung',
                'kejadianBencana.petugasPosko',
                'kejadianBencana.dampak'
            ])
            ->get();

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $assessment->each(function ($assessment) {
            $assessment->id = $assessment->report->id_report;
            $assessment->nama_kejadian = $assessment->report->jenisKejadian->nama_kejadian;
            $assessment->timestamp_report = $assessment->report->timestamp_report;
            // Fetch location details
            $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
            $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        });

        return response()->json($assessment);
    }

    public function relawan_lapsit(Request $request)
    {
        $status = $request->query('status');
        $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $lapsit = KejadianBencana::where('assessment.status', $status)
                ->where('id_relawan', $id_user)
                ->with([
                    'jenisKejadian',
                    'assessment.report',
                    'relawan',
                    'admin',
                    'mobilisasiSd',
                    'giatPmi',
                    'dokumentasi',
                    'narahubung',
                    'petugasPosko',
                    'dampak'
                ])
                ->get();
        } else {
            $lapsit = KejadianBencana::where('id_relawan', $id_user) // Nama fungsi relasi dalam model Report
                ->with([
                    'jenisKejadian',
                    'assessment.report',
                    'relawan',
                    'admin',
                    'mobilisasiSd',
                    'giatPmi',
                    'dokumentasi',
                    'narahubung',
                    'petugasPosko',
                    'dampak'
                ])
                ->get();
        }

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $lapsit->each(function ($lapsit) {
            $lapsit->id = $lapsit->id_kejadian;
            $lapsit->status = $lapsit->assessment->status;
            $lapsit->nama_kejadian = $lapsit->jenisKejadian->nama_kejadian;
            $lapsit->timestamp_report = $lapsit->assessment->report->timestamp_report;
            // Fetch location details
            // $lapsit->locationName = $this->getLocationName($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
            $lapsit->googleMapsLink = $this->getGoogleMapsLink($lapsit->assessment->report->lokasi_latitude, $lapsit->assessment->report->lokasi_longitude);
        });

        return response()->json($lapsit);
    }

    public function admin_lapsit(Request $request)
    {
        $status = $request->query('status');
        // $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $lapsit = KejadianBencana::whereHas('assessment', function ($query) use ($status) {
                $query->where('status', $status);
            })
                ->with([
                    'jenisKejadian',
                    'assessment.report',
                    'relawan',
                    'admin',
                    'mobilisasiSd',
                    'giatPmi',
                    'dokumentasi',
                    'narahubung',
                    'petugasPosko',
                    'dampak'
                ])
                ->get();
        } else {
            $lapsit = KejadianBencana::with([
                'jenisKejadian',
                'assessment.report',
                'relawan',
                'admin',
                'mobilisasiSd',
                'giatPmi',
                'dokumentasi',
                'narahubung',
                'petugasPosko',
                'dampak'
            ])
                ->get();
        }

        // Iterate through each report and add 'nama_kejadian' from the related jenisKejadian
        $lapsit->each(function ($lapsit) {
            $assessment = $lapsit->assessment;
            $lapsit->id = $lapsit->assessment->report->id_report;
            $lapsit->status = $lapsit->assessment->status;
            $lapsit->nama_kejadian = $lapsit->jenisKejadian->nama_kejadian;
            $lapsit->timestamp_report = $assessment->report->timestamp_report;
            // Fetch location details
            // $lapsit->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
            $lapsit->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        });

        return response()->json($lapsit);
    }

    public function allDataLapsit($id)
    {
        $kejadian = KejadianBencana::where('id_kejadian', $id)->with([
            'jenisKejadian',
            'assessment',
            'giatPmi.evakuasiKorban',
            'giatPmi.layananKorban',
            'dampak.korbanTerdampak',
            'dampak.korbanJlw',
            'dampak.kerusakanRumah',
            'dampak.kerusakanFasilitasSosial',
            'dampak.kerusakanInfrastruktur',
            'mobilisasiSd.personil',
            'mobilisasiSd.tsr',
            'mobilisasiSd.alatTdb',
            'dampak.pengungsian',
            'narahubung',
            'dokumentasi',
            'petugasPosko'
        ])->firstOrFail();

        $id_report = $kejadian->assessment->id_report;
        $report = Report::where('id_report', $id_report)->first();

        $jenisKejadian = JenisKejadian::all();

        // Ambil semua kejadian bencana dengan id_assessment yang sama
        $semuaKejadian = KejadianBencana::where('id_assessment', $kejadian->id_assessment)
            ->orderBy('created_at')
            ->get();

        $dataDampak = [
            'lapsit_awal' => [
                'korban_terdampak' => ['kk' => 0, 'jiwa' => 0],
                'korban_jlw' => ['luka_berat' => 0, 'luka_ringan' => 0, 'meninggal' => 0, 'hilang' => 0, 'mengungsi' => 0],
                'kerusakan_rumah' => ['rusak_berat' => 0, 'rusak_sedang' => 0, 'rusak_ringan' => 0],
                'kerusakan_fasilitas' => ['sekolah' => 0, 'tempat_ibadah' => 0, 'rumah_sakit' => 0, 'pasar' => 0],
            ],
            'lapsit_1' => [
                'korban_terdampak' => ['kk' => 0, 'jiwa' => 0],
                'korban_jlw' => ['luka_berat' => 0, 'luka_ringan' => 0, 'meninggal' => 0, 'hilang' => 0, 'mengungsi' => 0],
                'kerusakan_rumah' => ['rusak_berat' => 0, 'rusak_sedang' => 0, 'rusak_ringan' => 0],
                'kerusakan_fasilitas' => ['sekolah' => 0, 'tempat_ibadah' => 0, 'rumah_sakit' => 0, 'pasar' => 0],
            ],
            'lapsit_2' => [
                'korban_terdampak' => ['kk' => 0, 'jiwa' => 0],
                'korban_jlw' => ['luka_berat' => 0, 'luka_ringan' => 0, 'meninggal' => 0, 'hilang' => 0, 'mengungsi' => 0],
                'kerusakan_rumah' => ['rusak_berat' => 0, 'rusak_sedang' => 0, 'rusak_ringan' => 0],
                'kerusakan_fasilitas' => ['sekolah' => 0, 'tempat_ibadah' => 0, 'rumah_sakit' => 0, 'pasar' => 0],
            ],
            'lapsit_3' => [
                'korban_terdampak' => ['kk' => 0, 'jiwa' => 0],
                'korban_jlw' => ['luka_berat' => 0, 'luka_ringan' => 0, 'meninggal' => 0, 'hilang' => 0, 'mengungsi' => 0],
                'kerusakan_rumah' => ['rusak_berat' => 0, 'rusak_sedang' => 0, 'rusak_ringan' => 0],
                'kerusakan_fasilitas' => ['sekolah' => 0, 'tempat_ibadah' => 0, 'rumah_sakit' => 0, 'pasar' => 0],
            ],
            'lapsit_4' => [
                'korban_terdampak' => ['kk' => 0, 'jiwa' => 0],
                'korban_jlw' => ['luka_berat' => 0, 'luka_ringan' => 0, 'meninggal' => 0, 'hilang' => 0, 'mengungsi' => 0],
                'kerusakan_rumah' => ['rusak_berat' => 0, 'rusak_sedang' => 0, 'rusak_ringan' => 0],
                'kerusakan_fasilitas' => ['sekolah' => 0, 'tempat_ibadah' => 0, 'rumah_sakit' => 0, 'pasar' => 0],
            ],
        ];

        foreach ($semuaKejadian as $index => $kej) {
            $key = $index == 0 ? 'lapsit_awal' : 'lapsit_' . $index;
            if (isset($dataDampak[$key])) {
                $dataDampak[$key] = [
                    'korban_terdampak' => [
                        'kk' => $kej->dampak->korbanTerdampak->kk ?? 0,
                        'jiwa' => $kej->dampak->korbanTerdampak->jiwa ?? 0,
                    ],
                    'korban_jlw' => [
                        'luka_berat' => $kej->dampak->korbanJlw->luka_berat ?? 0,
                        'luka_ringan' => $kej->dampak->korbanJlw->luka_ringan ?? 0,
                        'meninggal' => $kej->dampak->korbanJlw->meninggal ?? 0,
                        'hilang' => $kej->dampak->korbanJlw->hilang ?? 0,
                        'mengungsi' => $kej->dampak->korbanJlw->mengungsi ?? 0,
                    ],
                    'kerusakan_rumah' => [
                        'rusak_berat' => $kej->dampak->kerusakanRumah->rusak_berat ?? 0,
                        'rusak_sedang' => $kej->dampak->kerusakanRumah->rusak_sedang ?? 0,
                        'rusak_ringan' => $kej->dampak->kerusakanRumah->rusak_ringan ?? 0,
                    ],
                    'kerusakan_fasilitas' => [
                        'sekolah' => $kej->dampak->kerusakanFasilitasSosial->sekolah ?? 0,
                        'tempat_ibadah' => $kej->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0,
                        'rumah_sakit' => $kej->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0,
                        'pasar' => $kej->dampak->kerusakanFasilitasSosial->pasar ?? 0,
                        'gedung_pemerintah' => $kej->dampak->kerusakanFasilitasSosial->gedung_pemerintah ?? 0,
                        'lain_lain' => $kej->dampak->kerusakanFasilitasSosial->lain_lain ?? 0,
                    ],
                ];
            }
        }

        $dataMobilisasi = [
            'lapsit_awal' => [
                'personil' => [
                    'pengurus' => 0,
                    'staf_markas_kabkota' => 0,
                    'staf_markas_prov' => 0,
                    'staf_markas_pusat' => 0,
                    'relawan_pmi_kabkota' => 0,
                    'relawan_pmi_prov' => 0,
                    'relawan_pmi_linprov' => 0,
                    'sukarelawan_sip' => 0
                ],
                'tsr' => [
                    'medis' => 0,
                    'paramedis' => 0,
                    'relief' => 0,
                    'logistik' => 0,
                    'watsan' => 0,
                    'it_telekom' => 0,
                    'sheltering' => 0
                ],
                'alat_tdb' => [
                    'kend_ops' => 0,
                    'truk_angkut' => 0,
                    'truk_tanki' => 0,
                    'double_cabin' => 0,
                    'alat_du' => 0,
                    'ambulans' => 0,
                    'alat_watsan' => 0,
                    'rs_lapangan' => 0,
                    'alat_pk' => 0
                ]
            ],
            'lapsit_1' => [
                'personil' => [
                    'pengurus' => 0,
                    'staf_markas_kabkota' => 0,
                    'staf_markas_prov' => 0,
                    'staf_markas_pusat' => 0,
                    'relawan_pmi_kabkota' => 0,
                    'relawan_pmi_prov' => 0,
                    'relawan_pmi_linprov' => 0,
                    'sukarelawan_sip' => 0
                ],
                'tsr' => [
                    'medis' => 0,
                    'paramedis' => 0,
                    'relief' => 0,
                    'logistik' => 0,
                    'watsan' => 0,
                    'it_telekom' => 0,
                    'sheltering' => 0
                ],
                'alat_tdb' => [
                    'kend_ops' => 0,
                    'truk_angkut' => 0,
                    'truk_tanki' => 0,
                    'double_cabin' => 0,
                    'alat_du' => 0,
                    'ambulans' => 0,
                    'alat_watsan' => 0,
                    'rs_lapangan' => 0,
                    'alat_pk' => 0
                ]
            ],
            'lapsit_2' => [
                'personil' => [
                    'pengurus' => 0,
                    'staf_markas_kabkota' => 0,
                    'staf_markas_prov' => 0,
                    'staf_markas_pusat' => 0,
                    'relawan_pmi_kabkota' => 0,
                    'relawan_pmi_prov' => 0,
                    'relawan_pmi_linprov' => 0,
                    'sukarelawan_sip' => 0
                ],
                'tsr' => [
                    'medis' => 0,
                    'paramedis' => 0,
                    'relief' => 0,
                    'logistik' => 0,
                    'watsan' => 0,
                    'it_telekom' => 0,
                    'sheltering' => 0
                ],
                'alat_tdb' => [
                    'kend_ops' => 0,
                    'truk_angkut' => 0,
                    'truk_tanki' => 0,
                    'double_cabin' => 0,
                    'alat_du' => 0,
                    'ambulans' => 0,
                    'alat_watsan' => 0,
                    'rs_lapangan' => 0,
                    'alat_pk' => 0
                ]
            ],
            'lapsit_3' => [
                'personil' => [
                    'pengurus' => 0,
                    'staf_markas_kabkota' => 0,
                    'staf_markas_prov' => 0,
                    'staf_markas_pusat' => 0,
                    'relawan_pmi_kabkota' => 0,
                    'relawan_pmi_prov' => 0,
                    'relawan_pmi_linprov' => 0,
                    'sukarelawan_sip' => 0
                ],
                'tsr' => [
                    'medis' => 0,
                    'paramedis' => 0,
                    'relief' => 0,
                    'logistik' => 0,
                    'watsan' => 0,
                    'it_telekom' => 0,
                    'sheltering' => 0
                ],
                'alat_tdb' => [
                    'kend_ops' => 0,
                    'truk_angkut' => 0,
                    'truk_tanki' => 0,
                    'double_cabin' => 0,
                    'alat_du' => 0,
                    'ambulans' => 0,
                    'alat_watsan' => 0,
                    'rs_lapangan' => 0,
                    'alat_pk' => 0
                ]
            ],
            'lapsit_4' => [
                'personil' => [
                    'pengurus' => 0,
                    'staf_markas_kabkota' => 0,
                    'staf_markas_prov' => 0,
                    'staf_markas_pusat' => 0,
                    'relawan_pmi_kabkota' => 0,
                    'relawan_pmi_prov' => 0,
                    'relawan_pmi_linprov' => 0,
                    'sukarelawan_sip' => 0
                ],
                'tsr' => [
                    'medis' => 0,
                    'paramedis' => 0,
                    'relief' => 0,
                    'logistik' => 0,
                    'watsan' => 0,
                    'it_telekom' => 0,
                    'sheltering' => 0
                ],
                'alat_tdb' => [
                    'kend_ops' => 0,
                    'truk_angkut' => 0,
                    'truk_tanki' => 0,
                    'double_cabin' => 0,
                    'alat_du' => 0,
                    'ambulans' => 0,
                    'alat_watsan' => 0,
                    'rs_lapangan' => 0,
                    'alat_pk' => 0
                ]
            ]
        ];

        foreach ($semuaKejadian as $index => $kej) {
            $key = $index == 0 ? 'lapsit_awal' : 'lapsit_' . $index;
            if (isset($dataMobilisasi[$key])) {
                $dataMobilisasi[$key] = [
                    'personil' => [
                        'pengurus' => $kej->mobilisasiSd->personil->pengurus ?? 0,
                        'staf_markas_kabkota' => $kej->mobilisasiSd->personil->staf_markas_kabkota ?? 0,
                        'staf_markas_prov' => $kej->mobilisasiSd->personil->staf_markas_prov ?? 0,
                        'staf_markas_pusat' => $kej->mobilisasiSd->personil->staf_markas_pusat ?? 0,
                        'relawan_pmi_kabkota' => $kej->mobilisasiSd->personil->relawan_pmi_kabkota ?? 0,
                        'relawan_pmi_prov' => $kej->mobilisasiSd->personil->relawan_pmi_prov ?? 0,
                        'relawan_pmi_linprov' => $kej->mobilisasiSd->personil->relawan_pmi_linprov ?? 0,
                        'sukarelawan_sip' => $kej->mobilisasiSd->personil->sukarelawan_sip ?? 0
                    ],
                    'tsr' => [
                        'medis' => $kej->mobilisasiSd->tsr->medis ?? 0,
                        'paramedis' => $kej->mobilisasiSd->tsr->paramedis ?? 0,
                        'relief' => $kej->mobilisasiSd->tsr->relief ?? 0,
                        'logistik' => $kej->mobilisasiSd->tsr->logistik ?? 0,
                        'watsan' => $kej->mobilisasiSd->tsr->watsan ?? 0,
                        'it_telekom' => $kej->mobilisasiSd->tsr->it_telekom ?? 0,
                        'sheltering' => $kej->mobilisasiSd->tsr->sheltering ?? 0
                    ],
                    'alat_tdb' => [
                        'kend_ops' => $kej->mobilisasiSd->alatTdb->kend_ops ?? 0,
                        'truk_angkut' => $kej->mobilisasiSd->alatTdb->truk_angkut ?? 0,
                        'truk_tanki' => $kej->mobilisasiSd->alatTdb->truk_tanki ?? 0,
                        'double_cabin' => $kej->mobilisasiSd->alatTdb->double_cabin ?? 0,
                        'alat_du' => $kej->mobilisasiSd->alatTdb->alat_du ?? 0,
                        'ambulans' => $kej->mobilisasiSd->alatTdb->ambulans ?? 0,
                        'alat_watsan' => $kej->mobilisasiSd->alatTdb->alat_watsan ?? 0,
                        'rs_lapangan' => $kej->mobilisasiSd->alatTdb->rs_lapangan ?? 0,
                        'alat_pk' => $kej->mobilisasiSd->alatTdb->alat_pk ?? 0
                    ]
                ];
            }
        }

        return response()->json([
            'kejadian' => $kejadian,
            'report' => $report,
            'jenis_kejadian' => $jenisKejadian,
            'data_dampak' => $dataDampak,
            'data_mobilisasi' => $dataMobilisasi,
        ]);
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

    public function getGoogleMapsLink($latitude, $longitude)
    {
        return 'https://www.google.com/maps/search/?api=1&query=' . $latitude . ',' . $longitude;
    }
}
