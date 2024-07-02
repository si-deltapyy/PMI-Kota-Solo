<?php

namespace App\Http\Controllers;

use App\Models\Dampak;
use App\Models\LayananKorban;
use App\Models\Report;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf; // Alias PDF Facade
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Import Http Facade
use Spatie\Permission\Models\Role;
use App\Charts\ExsumChart;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\JsonResponse;
use App\Models\KejadianBencana;
use App\Models\AlatTdb;
use App\Models\Assessment;
use App\Models\EvakuasiKorban;
use App\Models\JenisKejadian;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanInfrastruktur;
use App\Models\KerusakanRumah;
use App\Models\KorbanTerdampak;
use App\Models\KorbanJlw;
use App\Models\LampiranDokumentasi;
use App\Models\Pengungsian;
use App\Models\Personil;
use App\Models\PersonilNarahubung;
use App\Models\PetugasPosko;
use App\Models\Tsr;
use App\Models\GiatPMI;
use App\Models\MobilisasiSd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class PDFController extends Controller
{

    public function cekdata($id)
    {
        $kejadian = KejadianBencana::where('id_assessment', $id)->with([
            'giatPmi.evakuasiKorban',
            'giatPmi.layananKorban',
            'dampak.korbanTerdampak',
            'dampak.korbanJlw',
            'dampak.kerusakanRumah',
            'dampak.kerusakanFasilitasSosial',
            'dampak.kerusakanInfrastruktur',
            'pengungsian',
            'narahubung',
            'petugasPosko',
            'relawan',
            'jenisKejadian',
            'mobilisasi',
            'mobilisasi.tsr',
            'mobilisasi.alatTdb',
            'mobilisasi.personil',
            'assessment',
            'assessment.report',
        ])->findOrFail($id);
       

    if($kejadian){
        return ["data" => $kejadian, "message" => "berhasil"];
    }
    return ["message" => "error"];
    }

    // public function test()
    // {
    //     notify()->success('Hi Admin , welcome to codelapan');
    //     return view('pdf.flash-report');
    // }

    public function checkExportPDF()
    {
        // notify()->success('Hi Admin , welcome to codelapan');
        // return view('pdf.flash-report');

        // Load the PDF view with the data
        // bisa ganti nama file
        $pdf = PDF::loadView('pdf.flash-report');
        $pdf->setPaper('A4', 'landscape');

        // Stream the PDF for download
        return $pdf->stream('laporan-kejadian.pdf');

        
    }

    public function checkViewPDF()
    {
        // bisa ganti nama file blade
        return view('pdf.flash-report');

        // Load the PDF view with the data
        // bisa ganti nama file
        // $pdf = PDF::loadView('pdf.flash-report');
        // $pdf->setPaper('A4', 'landscape');

        // Stream the PDF for download
        // return $pdf->stream('laporan-kejadian.pdf');
    }

    public function downloadPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.usersdetails', array('users' => $users))
            ->setPaper('a4', 'portrait');

        return $pdf->download('users-details.pdf');
    }

    public function downloadPDFeksum()
    {
        $id=1;
        $datenow = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-M-d H:i:s');
        $tanggal = Carbon::now()->setTimezone('Asia/Jakarta')->format('d M Y');
        $jam = Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s');
        $dampak = Dampak::all()->count();
        $kejadian = Report::join('jenis_kejadian', 'reports.id_jeniskejadian', '=','jenis_kejadian.id_jeniskejadian')->get();

        $layanan = LayananKorban::join('assessment', 'layanan_korban.id_assessment', '=', 'assessment.id_assessment' )
        ->join('reports', 'assessment.id_report', '=', 'reports.id_report')
        ->join('jenis_kejadian', 'reports.id_jeniskejadian', '=','jenis_kejadian.id_jeniskejadian')
        ->select('jenis_kejadian.nama_kejadian as nmKejadian', 'reports.tanggal_kejadian as dateKejadian', 
        'layanan_korban.distribusi as layDis', 'layanan_korban.layanan_kesehatan as layKes', 'assessment.status as stat')->get();

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

        $pdf = PDF::loadView('admin.eksum.file', array(
            'dampak' => $dampak,
            'kejadian' => $kejadian,
            'layanan' => $layanan,
            'jumlah' => $jumlah,
            'waktu' => $datenow,
            'tanggal' => $tanggal,
            'id' => $id,
            'jam' => $jam
            ))
            ->setPaper('a4', 'portrait');

        return $pdf->download($datenow . ' || exsum-file.pdf');
    }

    public function exportLaporanKejadian($id)
    {
        // Find the report by its ID
        $report = Report::with('user')->findOrFail($id);
        $report->nama_kejadian = $report->jenisKejadian->nama_kejadian;

        // Fetch location details (assuming these methods are defined and functional)
        $locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);

        // Pass data to the PDF view
        $data = [
            'report' => $report,
            'locationName' => $locationName,
            'googleMapsLink' => $googleMapsLink,
        ];

        // Load the PDF view with the data
        $pdf = PDF::loadView('pdf.laporan-kejadian', $data);

        // Stream the PDF for download
        return $pdf->stream('laporan-kejadian.pdf');
    }

    public function exportLaporanAssessment($id)
    {
        $datenow = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-M-d H:i:s');
        $tanggal_now = Carbon::now()->setTimezone('Asia/Jakarta')->format('d M Y');
        $jam = Carbon::now()->setTimezone('Asia/Jakarta')->format('H:i:s');

        $kejadian = KejadianBencana::where('id_assessment', $id)->with([
            'giatPmi.evakuasiKorban',
            'giatPmi.layananKorban',
            'dampak.korbanTerdampak',
            'dampak.korbanJlw',
            'dampak.kerusakanRumah',
            'dampak.kerusakanFasilitasSosial',
            'dampak.kerusakanInfrastruktur',
            'pengungsian',
            'narahubung',
            'petugasPosko',
            'relawan',
            'jenisKejadian',
            'mobilisasi',
            'mobilisasi.tsr',
            'mobilisasi.alatTdb',
            'mobilisasi.personil',
            'assessment',
            'assessment.report',
        ])->findOrFail($id);

        $tanggal = Carbon::parse($kejadian->tanggal_kejadian)->locale('id')->isoFormat('D MMMM YYYY');
        // Load the PDF view with the data
        $pdf = PDF::loadView('pdf.assessment', array(
            'kejadian' => $kejadian,
            'waktu' => $datenow,
            'tanggal_now' => $tanggal_now,
            'tanggal' => $tanggal,
            'id' => $id,
            'jam' => $jam
            ))
            ->setPaper('a4', 'portrait');

        return $pdf->download($datenow . ' || assessment-file.pdf');
    }

    /*public function previewAssessmentPdf($id)
    {
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
            'petugasPosko',
            'relawan',
        ])->findOrFail($id);
        $jenisKejadian = JenisKejadian::all();
        $user = User::all();

        return view('pdf.assessment', compact('kejadian','jenisKejadian', 'user'));
    }*/

    public function viewLaporanKejadian($id)
    {
        $report = Report::with('user')->findOrFail($id);

        // Fetch location details
        $locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);

        // Pass data to the PDF view
        $data = [
            'report' => $report,
            'locationName' => $locationName,
            'googleMapsLink' => $googleMapsLink,
        ];

        // return view('pdf.laporan-kejadian', $data);

        $pdf = PDF::loadView('pdf.lapsit', $data);

        return $pdf->stream('laporan-kejadian.pdf');
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

    // pdf assessment
    // public function exportLaporanAssessment($id)
    // {
    //     $data = $this->prepareData($id);
    //     $pdf = PDF::loadView('pdf.assessment', $data);
    //     $pdf->setPaper('A4', 'portrait');
    //     return $pdf->stream('laporan-assessment.pdf');
    // }

    public function viewLaporanAssessment($id)
    {
        $data = $this->prepareData($id);
        return view('pdf.assessment', $data);
    }

    public function checkViewPDF_assessment()
    {
        $data = $this->prepareData(1); // Menggunakan ID dummy
        return view('pdf.assessment', $data);
    }

    public function checkExportPDF_assessment()
    {
        $data = $this->prepareData(1); // Menggunakan ID dummy
        $pdf = PDF::loadView('pdf.assessment', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan-assessment-preview.pdf');
    }

    private function prepareData($id)
    {
        $kejadian = KejadianBencana::where('id_assessment', $id)->with([
            'giatPmi.evakuasiKorban',
            'giatPmi.layananKorban',
            'dampak.korbanTerdampak',
            'dampak.korbanJlw',
            'dampak.kerusakanRumah',
            'dampak.kerusakanFasilitasSosial',
            'dampak.kerusakanInfrastruktur',
            'dampak.pengungsian',
            'narahubung'
        ])->firstOrFail();

        $jenisKejadian = JenisKejadian::all();

        return [
            'kejadian' => $kejadian,
            'jenisKejadian' => $jenisKejadian,
            'umum' => [
                'jenis_kejadian' => $kejadian->jenis_kejadian,
                'tempat_kejadian' => $kejadian->tempat_kejadian,
                'tanggal' => $kejadian->tanggal,
                'lokasi' => $kejadian->lokasi,
                'petugas_assessment' => $kejadian->petugas_assessment,
            ],
            'informasi_umum' => [
                'meninggal' => $kejadian->dampak->korbanJlw->meninggal ?? 0,
                'luka_berat' => $kejadian->dampak->korbanJlw->luka_berat ?? 0,
                'luka_ringan' => $kejadian->dampak->korbanJlw->luka_ringan ?? 0,
                'hilang' => $kejadian->dampak->korbanJlw->hilang ?? 0,
                'mengungsi' => $kejadian->dampak->korbanJlw->mengungsi ?? 0,
                'lokasi_pengungsian' => $kejadian->dampak->pengungsian->pluck('nama_lokasi')->implode(', '),
                'jumlah_pengungsi' => $kejadian->dampak->pengungsian->sum('jumlah'),
            ],
            'dampak_sarana' => [
                'rusak_berat' => $kejadian->dampak->kerusakanRumah->rusak_berat ?? 0,
                'rusak_sedang' => $kejadian->dampak->kerusakanRumah->rusak_sedang ?? 0,
                'rusak_ringan' => $kejadian->dampak->kerusakanRumah->rusak_ringan ?? 0,
                'akses_ke_lokasi' => $kejadian->akses_ke_lokasi,
                'fasilitas_umum' => [
                    'rs_fasilitas_kesehatan' => $kejadian->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0,
                    'sekolah' => $kejadian->dampak->kerusakanFasilitasSosial->sekolah ?? 0,
                    'tempat_ibadah' => $kejadian->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0,
                ],
            ],
            'situasi_keamanan' => $kejadian->situasi_keamanan ?? 'Lokasi aman dan terkendali',
            'tindakan_dilakukan' => $kejadian->giatPmi ? [
                'evakuasi' => $kejadian->giatPmi->layananKorban->evakuasi ?? '-',
                'layanan_kesehatan' => $kejadian->giatPmi->layananKorban->layanan_kesehatan ?? '-',
                'distribusi' => $kejadian->giatPmi->layananKorban->distribusi ?? '-',
                'dapur_umum' => $kejadian->giatPmi->layananKorban->dapur_umum ?? '-',
            ] : [],
            'kebutuhan_mendesak' => $kejadian->kebutuhan ?? '-',
            'kontak_person' => $kejadian->narahubung->map(function ($item) {
                return [
                    'nama' => $item->nama_lengkap,
                    'posisi' => $item->posisi,
                    'kontak' => $item->kontak,
                ];
            }),
            'petugas_assessment' => $kejadian->petugas_assessment ?? '-',
        ];
    }

    // pdf lapsit
    public function exportLaporanSituasi($id)
    {
        $data = $this->prepareDataLapsit($id);
        $pdf = PDF::loadView('pdf.lapsit2', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan-situasi.pdf');
    }

    public function viewLaporanSituasi($id)
    {
        $data = $this->prepareDataLapsit($id);
        return view('pdf.lapsit2', $data);
    }

    public function checkViewPDF_lapsit()
    {
        $data = $this->prepareDataLapsit(1); // Menggunakan ID dummy
        return view('pdf.lapsit2', $data);
    }

    public function checkExportPDF_lapsit()
    {
        $data = $this->prepareDataLapsit(1); // Menggunakan ID dummy
        $pdf = PDF::loadView('pdf.lapsit2', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('laporan-situasi-preview.pdf');
    }

    // controller baruu blm fix
    private function prepareDataLapsit($id)
{
    $kejadian = KejadianBencana::where('id_kejadian', $id)->with([
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
                ],
            ];
        }
    }

    return [
        'kejadian' => $kejadian,
        'jenisKejadian' => $jenisKejadian,
        'umum' => [
            'jenis_kejadian' => $kejadian->jenis_kejadian,
            'tempat_kejadian' => $kejadian->tempat_kejadian,
            'tanggal_kejadian' => $kejadian->tanggal_kejadian,
            'lokasi' => $kejadian->lokasi,
            'hambatan' => $kejadian->hambatan,
            'kebutuhan' => $kejadian->kebutuhan,
            'update' => $kejadian->update,
            'dukungan_internasional' => $kejadian->dukungan_internasional,
            'keterangan' => $kejadian->keterangan,
            'giat_pemerintah' => $kejadian->giat_pemerintah,
        ],
        'dampak' => $dataDampak,
        'situasi_keamanan' => $kejadian->situasi_keamanan ?? 'Lokasi aman dan terkendali',
        'tindakan_dilakukan' => $kejadian->giatPmi ? [
            'evakuasi' => $kejadian->giatPmi->layananKorban->evakuasi ?? '-',
            'layanan_kesehatan' => $kejadian->giatPmi->layananKorban->layanan_kesehatan ?? '-',
            'distribusi' => $kejadian->giatPmi->layananKorban->distribusi ?? '-',
            'dapur_umum' => $kejadian->giatPmi->layananKorban->dapur_umum ?? '-',
        ] : [],
        'kebutuhan_mendesak' => $kejadian->kebutuhan ?? '-',
        'kontak_person' => $kejadian->narahubung->map(function ($item) {
            return [
                'nama' => $item->nama_lengkap,
                'posisi' => $item->posisi,
                'kontak' => $item->kontak,
            ];
        }),
        'petugasPosko' => $kejadian->petugasPosko->map(function ($item) {
            return [
                'nama' => $item->nama_lengkap,
                'kontak' => $item->kontak,
            ];
        }),
        'pengungsian' => $kejadian->dampak->pengungsian->map(function ($item) {
            return [
                'nama_lokasi' => $item->nama_lokasi,
                'kk' => $item->kk,
                'jiwa' => $item->jiwa,
                'laki_laki' => $item->laki_laki,
                'perempuan' => $item->perempuan,
                'kurang_dari_5' => $item->kurang_dari_5,
                'atr_5_sampai_18' => $item->atr_5_sampai_18,
                'lebih_dari_18' => $item->lebih_dari_18,
                'jumlah' => $item->jumlah,
            ];
        }),
    ];
}

//controller lama
    private function prepareDataLapsitold($id)
    {
        $kejadian = KejadianBencana::where('id_kejadian', $id)->with([
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
            'dampak.pengungsian', // Menambahkan relasi pengungsian
            'narahubung',
            'dokumentasi',
            'petugasPosko'
        ])->firstOrFail();

        $jenisKejadian = JenisKejadian::all();

        return [
            'kejadian' => $kejadian,
            'jenisKejadian' => $jenisKejadian,
            'umum' => [
                'jenis_kejadian' => $kejadian->jenis_kejadian,
                'tempat_kejadian' => $kejadian->tempat_kejadian,
                'tanggal_kejadian' => $kejadian->tanggal_kejadian,
                'lokasi' => $kejadian->lokasi,
                'hambatan' => $kejadian->hambatan,
                'kebutuhan' => $kejadian->kebutuhan,
                'update' => $kejadian->update,
                'dukungan_internasional' => $kejadian->dukungan_internasional,
                'keterangan' => $kejadian->keterangan,
                'giat_pemerintah' => $kejadian->giat_pemerintah,
            ],
            'informasi_umum' => [
                'kk' => $kejadian->dampak->korbanTerdampak->kk ?? 0,
                'jiwa' => $kejadian->dampak->korbanTerdampak->jiwa ?? 0,
                'meninggal' => $kejadian->dampak->korbanJlw->meninggal ?? 0,
                'luka_berat' => $kejadian->dampak->korbanJlw->luka_berat ?? 0,
                'luka_ringan' => $kejadian->dampak->korbanJlw->luka_ringan ?? 0,
                'hilang' => $kejadian->dampak->korbanJlw->hilang ?? 0,
                'mengungsi' => $kejadian->dampak->korbanJlw->mengungsi ?? 0,
            ],
            'dampak_sarana' => [
                'rusak_berat' => $kejadian->dampak->kerusakanRumah->rusak_berat ?? 0,
                'rusak_sedang' => $kejadian->dampak->kerusakanRumah->rusak_sedang ?? 0,
                'rusak_ringan' => $kejadian->dampak->kerusakanRumah->rusak_ringan ?? 0,
                'akses_ke_lokasi' => $kejadian->akses_ke_lokasi,
                'fasilitas_umum' => [
                    'sekolah' => $kejadian->dampak->kerusakanFasilitasSosial->sekolah ?? 0,
                    'tempat_ibadah' => $kejadian->dampak->kerusakanFasilitasSosial->tempat_ibadah ?? 0,
                    'rumah_sakit' => $kejadian->dampak->kerusakanFasilitasSosial->rumah_sakit ?? 0,
                    'pasar' => $kejadian->dampak->kerusakanFasilitasSosial->pasar ?? 0,
                    'gedung_pemerintah' => $kejadian->dampak->kerusakanFasilitasSosial->gedung_pemerintah ?? 0,
                    'lain_lain' => $kejadian->dampak->kerusakanFasilitasSosial->lain_lain ?? 0,

                ],
            ],
            'situasi_keamanan' => $kejadian->situasi_keamanan ?? 'Lokasi aman dan terkendali',
            'tindakan_dilakukan' => $kejadian->giatPmi ? [
                'evakuasi' => $kejadian->giatPmi->layananKorban->evakuasi ?? '-',
                'layanan_kesehatan' => $kejadian->giatPmi->layananKorban->layanan_kesehatan ?? '-',
                'distribusi' => $kejadian->giatPmi->layananKorban->distribusi ?? '-',
                'dapur_umum' => $kejadian->giatPmi->layananKorban->dapur_umum ?? '-',
            ] : [],
            'kebutuhan_mendesak' => $kejadian->kebutuhan ?? '-',
            'kontak_person' => $kejadian->narahubung->map(function ($item) {
                return [
                    'nama' => $item->nama_lengkap,
                    'posisi' => $item->posisi,
                    'kontak' => $item->kontak,
                ];
            }),
            'petugasPosko' => $kejadian->petugasPosko->map(function ($item) {
                return [
                    'nama' => $item->nama_lengkap,
                    'kontak' => $item->kontak,
                ];
            }),
            'pengungsian' => $kejadian->dampak->pengungsian->map(function ($item) {
                return [
                    'nama_lokasi' => $item->nama_lokasi,
                    'kk' => $item->kk,
                    'jiwa' => $item->jiwa,
                    'laki_laki' => $item->laki_laki,
                    'perempuan' => $item->perempuan,
                    'kurang_dari_5' => $item->kurang_dari_5,
                    'atr_5_sampai_18' => $item->atr_5_sampai_18,
                    'lebih_dari_18' => $item->lebih_dari_18,
                    'jumlah' => $item->jumlah,

                ];
            }),
            'petugas_assessment' => $kejadian->petugas_assessment ?? '-',
        ];
    }

}
