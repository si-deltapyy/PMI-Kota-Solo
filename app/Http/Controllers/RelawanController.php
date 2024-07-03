<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\KejadianBencana;
use App\Models\Report;
use App\Models\AlatTdb;
use App\Models\Assessment;
use App\Models\Dampak;
use App\Models\EvakuasiKorban;
use App\Models\JenisKejadian;
use App\Models\KerusakanFasilSosial;
use App\Models\KerusakanInfrastruktur;
use App\Models\KerusakanRumah;
use App\Models\KorbanTerdampak;
use App\Models\KorbanJlw;
use App\Models\LampiranDokumentasi;
use App\Models\LayananKorban;
use App\Models\Pengungsian;
use App\Models\Personil;
use App\Models\PersonilNarahubung;
use App\Models\PetugasPosko;
use App\Models\Tsr;
use App\Models\GiatPMI;
use App\Models\MobilisasiSd;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // VIEW INDEX RELAWAN
    public function index()
    {
        //
        return view('relawan.dashboard');
    }
    public function index_laporankejadian(Request $request)
    {
        $reports = Report::all(); 

        // Fetch query parameters
        $search = $request->input('search');
        $filterStatus = $request->input('status');

        // Initialize the query
        $query = Report::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('lokasi_longitude', 'like', '%' . $search . '%')
                  ->orWhere('lokasi_latitude', 'like', '%' . $search . '%')
                  ->orWhereHas('jeniskejadian', function ($q) use ($search) {
                    $q->where('nama_kejadian', 'like', '%' . $search . '%');
                    })
                  ->orWhere('tanggal_kejadian', 'like', '%' . $search . '%');
            });
        }

        // Apply status filter
        if ($filterStatus) {
            $query->where('status', $filterStatus);
        }

        // Fetch reports based on the filtered query
        $reports = $query->get();
        return view('relawan.laporankejadian.index', compact('reports'));
    }
    //index lapsit asli
    public function index_lapsit()
    {
        $kejadian = KejadianBencana::all();
        $jenisKejadian = JenisKejadian::all();
        return view('relawan.lapsit.index', compact('kejadian', 'jenisKejadian'));
    }
    //index lapsit cek delete
    public function index_lapsit2()
    {
        $kejadianBencanaList = KejadianBencana::with('jenisKejadian')->get();

        return view('relawan.lapsit.indexdelete', compact('kejadianBencanaList'));
    }
    public function index_assessment()
    {
        $assessments = KejadianBencana::all();
        return view('relawan.assessment.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // CREATE, UPDATE, DELETE LAPORAN KEJADIAN
    public function create_laporankejadian()
    {
        $jeniskejadian = JenisKejadian::all();
        return view('relawan.laporankejadian.create', compact('jeniskejadian'));
    }
    // verify
    public function verify($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Valid']);

        return redirect()->back()->with('success', 'Status laporan diubah menjadi Valid');
    }

    public function unverify($id)
    {
        $report = Report::findOrFail($id);
        $report->update(['status' => 'Invalid']);

        return redirect()->back()->with('success', 'Status laporan diubah menjadi Invalid');
    }
    public function store_laporankejadian(Request $request)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required',
            'tanggal_kejadian' => 'required|date_format:Y-m-d H:i:s',
            'keterangan' => 'required|string',
            'lokasi_longitude' => 'nullable|numeric',
            'lokasi_latitude' => 'nullable|numeric',
            'status' => 'required|in:On Process,Selesai,Belum Diverifikasi',
        ]);

        $laporanKejadian = new Report();
        $laporanKejadian->id_user = auth()->id(); // Assuming authenticated user ID
        $laporanKejadian->id_jeniskejadian = $request->id_jeniskejadian;
        $laporanKejadian->tanggal_kejadian = $request->tanggal_kejadian;
        $laporanKejadian->keterangan = $request->keterangan;
        $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        $laporanKejadian->status = $request->status;
        $laporanKejadian->timestamp_report = Carbon::now();
        $laporanKejadian->save();

        return redirect('/relawan/laporan-kejadian')->with('success', 'Laporan kejadian berhasil ditambahkan.');
        // return redirect()->route('relawan-laporankejadian')->with('success', 'Laporan kejadian berhasil ditambahkan.');
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
        return view('relawan.laporankejadian.view', compact('report'));
    }
    public function edit_laporankejadian($id)
    {
        // Mengambil data report berdasarkan ID
        $report = Report::findOrFail($id); // Menggunakan findOrFail agar melempar 404 jika tidak ditemukan

        $report->locationName = $this->getLocationName($report->lokasi_latitude, $report->lokasi_longitude);
        $report->googleMapsLink = $this->getGoogleMapsLink($report->lokasi_latitude, $report->lokasi_longitude);
        $report->waktuKejadian = $this->formatDateTime($report->timestamp_report);
        $report->updateAt = $this->formatDateTime($report->updated_at);

        return view('relawan.laporankejadian.edit', compact('report'));
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
                return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan kejadian berhasil dihapus');
            }
        } else {
            // Check if the request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Return JSON response indicating error
                return new JsonResponse(['message' => 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus'], 400);
            } else {
                // Redirect for non-AJAX requests
                return redirect('relawan/laporan-kejadian')->with('error', 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus');
            }
        }

        // if ($report->status === 'Belum Diverifikasi') {
        //     $report->delete();
        //     return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan kejadian berhasil dihapus');
        // } else {
        //     return redirect('relawan/laporan-kejadian')->with('error', 'Hanya laporan kejadian dengan status "Belum Diverifikasi" yang dapat dihapus');
        // }
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
        ;

        $assessment->locationName = $this->getLocationName($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->googleMapsLink = $this->getGoogleMapsLink($assessment->report->lokasi_latitude, $assessment->report->lokasi_longitude);
        $assessment->waktuKejadian = $this->formatDateTime($assessment->report->timestamp_report);
        $assessment->updateAt = $this->formatDateTime($assessment->report->updated_at);

        return response()->json($assessment);
        // return view('relawan.assessment.view', compact('assessment'));

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
        ;

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

        return view('relawan.assessment.view', compact('assessment', 'firstKejadian'));

        // return response()->json($assessment);

    }
    public function create_assessment($id)
    {
        $assessment = Assessment::whereHas('report', function($query) use ($id) {
            $query->where('id_report', $id);
        })->first();
        if($assessment){
            return redirect()->route('relawan-laporankejadian')->with('failure', 'Laporan Assessment sudah ada');
        }
        $kejadian = Report::findOrFail($id);
        $jeniskejadian = JenisKejadian::where('id_jeniskejadian', $kejadian->id_jeniskejadian)->first();
        $narahubung = PersonilNarahubung::all();
        $personil = Personil::all()->random()->first();
        $tsr = Tsr::all()->random()->first();
        $alat_tdb = AlatTdb::all()->random()->first();
        return view('relawan.assessment.create', compact('kejadian', 'jeniskejadian', 'assessment', 'narahubung', 'personil', 'tsr', 'alat_tdb'));
    }
    public function store_assessment(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            // Assesment
            'id_relawan' => 'required|exists:users,id',
            'id_report' => 'required|exists:reports,id_report',
            // kejadian_bencana
            'id_jeniskejadian' => 'required|exists:jenis_kejadian,id_jeniskejadian',
            'id_admin' => 'required|exists:users,id',
            'tanggal_kejadian' => 'required|date_format:Y-m-d',
            'lokasi' => 'required|string',
            'update' => 'required|date_format:Y-m-d',
            'dukungan_internasional' => 'required|string',
            'keterangan' => 'required|string',
            'akses_ke_lokasi' => 'required|in:Accessible,Not Accessible',
            'kebutuhan' => 'required|string',
            'giat_pemerintah' => 'required|string',
            'hambatan' => 'required|string',
            // DAMPAK
            //Korban Terdampak
            'kk' => 'required|integer',
            'jiwa' => 'required|integer',
            // Korban JLW
            'luka_berat' => 'required|integer',
            'luka_ringan' => 'required|integer',
            'meninggal' => 'required|integer',
            'hilang' => 'required|integer',
            'mengungsi' => 'required|integer',
            // Kerusakan Rumah
            'rusak_berat' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_ringan' => 'required|integer',
            // Kerusakan Fasilitas Sosial
            'sekolah' => 'required|integer',
            'tempat_ibadah' => 'required|integer',
            'rumah_sakit' => 'required|integer',
            'pasar' => 'required|integer',
            'gedung_pemerintah' => 'required|integer',
            'lain_lain' => 'required|integer',
            // Kerusakan Infrastruktur
            'desc_kerusakan' => 'required|string',
            // GIAT PMI
            // Evakuasi Korban
            'luka_ringanberat' => 'required|string',
            'meninggal' => 'required|string',
            'keterangan_evakuasi' => 'required|string', // Diubah untuk menghindari konflik
            // Layanan Korban
            'distribusi' => 'required|string',
            'dapur_umum' => 'required|string',
            'evakuasi' => 'required|string',
            'layanan_kesehatan' => 'required|string',
            // MOBILISASI SD
            // Personil
            'id_personil' => 'required|exists:personil,id_personil',
            // TSR
            'id_tsr' => 'required|exists:tsr,id_tsr',
            'id_alat_tdb' => 'required|exists:alat_tdb,id_alat_tdb',
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
        // check validatedata have error or not
        if ($validatedData->fails()) {
            // dd($validatedData->errors());
            return redirect()->back()->with('error', 'Data yang diinputkan tidak valid');
        }
        $data = $validatedData->validated();
        $data['status'] = 'On Process';
        $assessment = Assessment::create($data);
        $data['id_assessment'] = $assessment->id_assessment;

        $korbanTerdampak = KorbanTerdampak::create($data);
        $data['id_korban_terdampak'] = $korbanTerdampak->id_korban_terdampak;
        $kerusakanRumah = KerusakanRumah::create($data);
        $data['id_kerusakan_rumah'] = $kerusakanRumah->id_kerusakan_rumah;
        $kerusakanFasilitasSosial = KerusakanFasilSosial::create($data);
        $data['id_kerusakan_fasil_sosial'] = $kerusakanFasilitasSosial->id_kerusakan_fasil_sosial;
        $kerusakanInfrastruktur = KerusakanInfrastruktur::create($data);
        $data['id_kerusakan_infrastruktur'] = $kerusakanInfrastruktur->id_kerusakan_infrastruktur;
        $korbanJlw = KorbanJlw::create($data);
        $data['id_korban_jlw'] = $korbanJlw->id_korban_jlw;
        $dampak = Dampak::create($data);
        $data['id_dampak'] = $dampak->id_dampak;

        $mobilisasiSd = MobilisasiSd::create($data);
        $data['id_mobilisasi_sd'] = $mobilisasiSd->id_mobilisasi_sd;

        $evakuasiKorban = EvakuasiKorban::create($data);
        $data['id_evakuasikorban'] = $evakuasiKorban->id_evakuasikorban;
        $layananKorban = LayananKorban::create($data);
        $data['id_layanankorban'] = $layananKorban->id_layanankorban;
        $giatPmi = GiatPmi::create($data);
        $data['id_giat_pmi'] = $giatPmi->id_giatpmi;

        $kejadianBencana = KejadianBencana::create($data);

        $kejadianBencana->save();
        // Simpan data narahubung
        if (isset($data['narahubung'])) {
            foreach ($data['narahubung'] as $narahubungData) {
                $narahubung = new PersonilNarahubung();
                $narahubung->id_kejadian = $kejadianBencana->id_kejadian;
                $narahubung->nama_lengkap = $narahubungData['nama_lengkap'];
                $narahubung->posisi = $narahubungData['posisi'];
                $narahubung->kontak = $narahubungData['kontak'];
                $narahubung->save();
            }
        }
    
        // Simpan data pengungsian baru
        if (isset($data['pengungsian'])) {
            foreach ($data['pengungsian'] as $pengungsianData) {
                $pengungsian = new Pengungsian();
                $pengungsian->id_dampak = $data['id_dampak'];
                $pengungsian->nama_lokasi = $pengungsianData['nama_lokasi'];
                $pengungsian->laki_laki = $pengungsianData['laki_laki'];
                $pengungsian->perempuan = $pengungsianData['perempuan'];
                $pengungsian->kurang_dari_5 = $pengungsianData['kurang_dari_5'];
                $pengungsian->atr_5_sampai_18 = $pengungsianData['atr_5_sampai_18'];
                $pengungsian->lebih_dari_18 = $pengungsianData['lebih_dari_18'];
                $pengungsian->jumlah = $pengungsianData['jumlah'];
                $pengungsian->kk = $pengungsianData['kk'];
                $pengungsian->jiwa = $pengungsianData['jiwa'];
                $pengungsian->save();
            }
        }

        return redirect()->route('relawan-view-assessment', $assessment->id_assessment)->with('success', 'Data assessment berhasil disimpan');
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


        return view('relawan.assessment.edit', compact('kejadian','jenisKejadian'));

    }

    public function update_assessment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'update' => 'required|date',
            'akses_ke_lokasi' => 'required|in:Accessible,Not Accessible',
            'kebutuhan' => 'required|string',
            'keterangan' => 'required|string',
            'hambatan' => 'required|string',
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
            'luka_ringanberat'=> 'nullable|string',
            'meninggalevakuasi'=> 'nullable|string',
            'keterangan'=> 'nullable|string',
            'distribusi'=> 'nullable|string',
            'dapur_umum'=> 'nullable|string',
            'evakuasi'=> 'nullable|string',
            'layanan_kesehatan'=> 'nullable|string',
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
            'keterangan' => $validatedData['keterangan'],
            'hambatan' => $validatedData['hambatan'],
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
                        'id_kejadian' => $id
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


        return redirect()->route('relawan-assessment', $kejadian->id_kejadian)->with('success', 'Laporan Assessment berhasil diperbarui');
    }

    public function delete_assessment(Request $request, string $id)
    {
        // Ambil data assessment berdasarkan id
        $assessment = Assessment::where('id_assessment', $id)->firstOrFail();

        // Cek status verifikasi dari assessment
        if ($assessment->status == 'On Process') {
            // Hapus data kejadian_bencana yang terkait dengan assessment
            $kejadianBencana = KejadianBencana::where('id_kejadian', $assessment->id_kejadian)->first();
            if ($kejadianBencana) {
                $kejadianBencana->delete();
            }

            // Hapus data assessment
            $assessment->delete();

            
            // Check if the request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Return JSON response indicating success
                return new JsonResponse(['message' => 'Data laporan assessment berhasil dihapus'], 200);
            } else {
                // Redirect for non-AJAX requests
                return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan kejadian assessment dihapus');
            }
            // return redirect('relawan/assessment')->with('success', 'Data berhasil dihapus');
        } else {
            // Check if the request is AJAX
            if ($request->ajax() || $request->wantsJson()) {
                // Return JSON response indicating error
                return new JsonResponse(['message' => 'Hanya laporan assessment dengan status "On Process" yang dapat dihapus'], 400);
            } else {
                // Redirect for non-AJAX requests
                return redirect('relawan/laporan-kejadian')->with('error', 'Hanya laporan assessment dengan status "On Process" yang dapat dihapus');
            }
            // return redirect('relawan/assessment')->with('error', 'Hanya data yang belum diverifikasi yang dapat dihapus');
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

        return view('relawan.lapsit.view', compact('lapsit', 'assessment'));

        // return response()->json($assessment);

    }

    public function create_lapsit($id)
    {
        //
        //$jenisKejadian = DB::table('jenis_kejadian')->get();
        
        $kejadian = KejadianBencana::where('id_assessment',$id)
        ->with([
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
        //$kejadian = KejadianBencana::where('id_assessment', $id)->findOrFail($id);
        $jeniskejadian = JenisKejadian::where('id_jeniskejadian', $kejadian->id_jeniskejadian)->first();
        $assesment = Assessment::where('id_assessment', $id)->first();
        $report = $assesment->id_report;

        return view('relawan.lapsit.create', compact('kejadian', 'jeniskejadian', 'report'));

        /*$assessment = Assessment::with(['jenisKejadian', 'narahubung', 'petugasPosko'])->
        findOrFail($id);
        $dataAssessment = [
            'nama_kejadian' => $assessment->jenisKejadian->nama_kejadian,
            'lokasi' => $assessment->lokasi,
            'tanggal_kejadian' => $assessment->tanggal_kejadian,
            'akses_ke_lokasi' => $assessment->akses_ke_lokasi,
            'nama_narahubung' => $assessment->narahubung->nama_lengkap,
            'kontak_narahubung' => $assessment->narahubung->kontak,
            'posisi_narahubung' => $assessment->narahubung->posisi,
            'nama_petugas_posko' => $assessment->petugasPosko->nama_lengkap,
            'kontak_petugas_posko' => $assessment->petugasPosko->kontak,
        ];
        return view('relawan.lapsit.create', compact('assessment', 'dataAssessment'));*/
    }

    public function store_lapsit(Request $request, $id)
    {
        $validatedData = Validator::make($request->all(), [
            // Assesment
            'id_relawan' => 'required|exists:users,id',
            'id_report' => 'required|exists:reports,id_report',
            // kejadian_bencana
            'id_jeniskejadian' => 'required|exists:jenis_kejadian,id_jeniskejadian',
            'id_admin' => 'required|exists:users,id',
            'tanggal_kejadian' => 'required|date_format:Y-m-d',
            'lokasi' => 'required|string',
            'update' => 'required|date_format:Y-m-d',
            'dukungan_internasional' => 'required|string',
            'keterangan' => 'required|string',
            'akses_ke_lokasi' => 'required|in:Accessible,Not Accessible',
            'kebutuhan' => 'required|string',
            'giat_pemerintah' => 'required|string',
            'hambatan' => 'required|string',
            // DAMPAK
            //Korban Terdampak
            'kk' => 'required|integer',
            'jiwa' => 'required|integer',
            // Korban JLW
            'luka_berat' => 'required|integer',
            'luka_ringan' => 'required|integer',
            'meninggal' => 'required|integer',
            'hilang' => 'required|integer',
            'mengungsi' => 'required|integer',
            // Kerusakan Rumah
            'rusak_berat' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_ringan' => 'required|integer',
            // Kerusakan Fasilitas Sosial
            'sekolah' => 'required|integer',
            'tempat_ibadah' => 'required|integer',
            'rumah_sakit' => 'required|integer',
            'pasar' => 'required|integer',
            'gedung_pemerintah' => 'required|integer',
            'lain_lain' => 'required|integer',
            // Kerusakan Infrastruktur
            'desc_kerusakan' => 'required|string',
            // GIAT PMI
            // Evakuasi Korban
            'luka_ringanberat' => 'required|string',
            'meninggal' => 'required|string',
            'keterangan_evakuasi' => 'required|string', // Diubah untuk menghindari konflik
            // Layanan Korban
            'distribusi' => 'required|string',
            'dapur_umum' => 'required|string',
            'evakuasi' => 'required|string',
            'layanan_kesehatan' => 'required|string',
            // MOBILISASI SD
            // Personil
            'pengurus' => 'required|integer',
            'staf_markas_kabkota' => 'required|integer',
            'staf_markas_prov' => 'required|integer',
            'staf_markas_pusat' => 'required|integer',
            'relawan_pmi_kabkota' => 'required|integer',
            'relawan_pmi_prov' => 'required|integer',
            'relawan_pmi_linprov' => 'required|integer',
            'sukarelawan_sip' => 'required|integer',
            // TSR
            'medis' => 'required|integer',
            'paramedis' => 'required|integer',
            'relief' => 'required|integer',
            'logistik' => 'required|integer',
            'watsan' => 'required|integer',
            'it_telekom' => 'required|integer',
            'sheltering' => 'required|integer',
            // Alat TDB
            'kend_ops' => 'required|integer',
            'truk_angkut' => 'required|integer',
            'truk_tanki' => 'required|integer',
            'double_cabin' => 'required|integer',
            'alat_du' => 'required|integer',
            'ambulans' => 'required|integer',
            'alat_watsan' => 'required|integer',
            'rs_lapangan' => 'required|integer',
            'alat_pkdd' => 'required|integer',
            'gudang_lapangan' => 'required|integer',
            'posko_aju' => 'required|integer',
            'alat_it_lapangan' => 'required|integer',
            
            // Validasi untuk data narahubung
            'narahubung' => 'sometimes|array',
            'narahubung.*.id_narahubung' => 'sometimes|exists:personil_narahubung,id_narahubung',
            'narahubung.*.nama_lengkap' => 'required|string',
            'narahubung.*.posisi' => 'required|string',
            'narahubung.*.kontak' => 'required|string',
            // Validasi untuk data petugas posko
            'petugasPosko' => 'sometimes|array',
            'petugasPosko.*.id_petugas_posko' => 'sometimes|exists:petugas_posko,id_petugas_posko',
            'petugasPosko.*.nama_lengkap' => 'required|string',
            'petugasPosko.*.kontak' => 'required|string',
            // Validasi untuk data dokumentasi
            'dokumentasi' => 'sometimes|array',
            'dokumentasi.*.id_dokumentasi' => 'sometimes|exists:lampiran_dokumentasi,id_dokumentasi',
            'dokumentasi.*.file_dokumentasi' => 'required|image:jpeg,jpg,png|max:2048',
            'dokumentasi.*.delete' => 'sometimes|boolean',
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
        // check validatedata have error or not
        if ($validatedData->fails()) {
            return redirect()->back()->with('error', 'Data yang diinputkan tidak valid');
        }

        $data = $validatedData->validated();
        $data['status'] = 'Aktif';
        // $assessment = Assessment::create($data);
        $data['id_assessment'] = $id;

        $korbanTerdampak = KorbanTerdampak::create($data);
        $data['id_korban_terdampak'] = $korbanTerdampak->id_korban_terdampak;
        $kerusakanRumah = KerusakanRumah::create($data);
        $data['id_kerusakan_rumah'] = $kerusakanRumah->id_kerusakan_rumah;
        $kerusakanFasilitasSosial = KerusakanFasilSosial::create($data);
        $data['id_kerusakan_fasil_sosial'] = $kerusakanFasilitasSosial->id_kerusakan_fasil_sosial;
        $kerusakanInfrastruktur = KerusakanInfrastruktur::create($data);
        $data['id_kerusakan_infrastruktur'] = $kerusakanInfrastruktur->id_kerusakan_infrastruktur;
        $korbanJlw = KorbanJlw::create($data);
        $data['id_korban_jlw'] = $korbanJlw->id_korban_jlw;
        $dampak = Dampak::create($data);
        $data['id_dampak'] = $dampak->id_dampak;

        $personil = Personil::create($data);
        $data['id_personil'] = $personil->id_personil;
        $tsr = Tsr::create($data);
        $data['id_tsr'] = $tsr->id_tsr;
        $alatTdb = AlatTdb::create($data);
        $data['id_alat_tdb'] = $alatTdb->id_alat_tdb;
        $mobilisasiSd = MobilisasiSd::create($data);
        $data['id_mobilisasi_sd'] = $mobilisasiSd->id_mobilisasi_sd;

        $evakuasiKorban = EvakuasiKorban::create($data);
        $data['id_evakuasikorban'] = $evakuasiKorban->id_evakuasikorban;
        $layananKorban = LayananKorban::create($data);
        $data['id_layanankorban'] = $layananKorban->id_layanankorban;
        $giatPmi = GiatPmi::create($data);
        $data['id_giat_pmi'] = $giatPmi->id_giatpmi;

        $kejadianBencana = KejadianBencana::create($data);
        $kejadianBencana->save();
        // Proses upload file dokumentasi
        /*if ($request->hasFile('dokumentasi')) {
            foreach ($request->file('dokumentasi') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/dokumentasi', $fileName, 'public');

                // Simpan informasi file ke database
                $dokumentasi = new LampiranDokumentasi();
                $dokumentasi->id_kejadian = $kejadianBencana->id_kejadian;
                $dokumentasi->file_dokumentasi = $filePath;
                $dokumentasi->save();
            }
        }*/
        if (isset($data['dokumentasi'])) {
            foreach ($request->file('dokumentasi') as $file) {
                $fileName = time() . '_' . $file['file_dokumentasi']->getClientOriginalName();
                $filePath = 'storage/dokumentasi/' . $fileName;
                $file['file_dokumentasi']->storeAs('public/dokumentasi/', $fileName);
                // Simpan informasi file ke database
                $dokumentasi = new LampiranDokumentasi();
                $dokumentasi->id_kejadian = $kejadianBencana->id_kejadian;
                $dokumentasi->file_dokumentasi = $filePath;
                $dokumentasi->save();
            }
        }

        // Simpan data narahubung
        if (isset($data['narahubung'])) {
            foreach ($data['narahubung'] as $narahubungData) {
                $narahubung = new PersonilNarahubung();
                $narahubung->id_kejadian = $kejadianBencana->id_kejadian;
                $narahubung->nama_lengkap = $narahubungData['nama_lengkap'];
                $narahubung->posisi = $narahubungData['posisi'];
                $narahubung->kontak = $narahubungData['kontak'];
                $narahubung->save();
            }
        }

        // Simpan data petugas posko
        if (isset($data['petugasPosko'])) {
            foreach ($data['petugasPosko'] as $petugasData) {
                $petugasPosko = new PetugasPosko();
                $petugasPosko->id_kejadian = $kejadianBencana->id_kejadian;
                $petugasPosko->nama_lengkap = $petugasData['nama_lengkap'];
                $petugasPosko->kontak = $petugasData['kontak'];
                $petugasPosko->save();
            }
        }
    
        // Simpan data pengungsian baru
        if (isset($data['pengungsian'])) {
            foreach ($data['pengungsian'] as $pengungsianData) {
                $pengungsian = new Pengungsian();
                $pengungsian->id_dampak = $data['id_dampak'];
                $pengungsian->nama_lokasi = $pengungsianData['nama_lokasi'];
                $pengungsian->laki_laki = $pengungsianData['laki_laki'];
                $pengungsian->perempuan = $pengungsianData['perempuan'];
                $pengungsian->kurang_dari_5 = $pengungsianData['kurang_dari_5'];
                $pengungsian->atr_5_sampai_18 = $pengungsianData['atr_5_sampai_18'];
                $pengungsian->lebih_dari_18 = $pengungsianData['lebih_dari_18'];
                $pengungsian->jumlah = $pengungsianData['jumlah'];
                $pengungsian->kk = $pengungsianData['kk'];
                $pengungsian->jiwa = $pengungsianData['jiwa'];
                $pengungsian->save();
            }
        }
        
        return redirect()->route('relawan-lapsit', $kejadianBencana->id_kejadian)->with('success', 'Data berhasil ditambahkan');
    }

    public function edit_lapsit($id)
    {
        // Mengambil data kejadian bencana berdasarkan id_assessment
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

        return view('relawan.lapsit.edit', compact('kejadian', 'jenisKejadian'));
    }

    public function update_lapsit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'update' => 'required|date',
            'akses_ke_lokasi' => 'required|in:Accessible,Not Accessible',
            'kebutuhan' => 'required|string',
            'hambatan' => 'required|string',
            'giat_pemerintah' => 'required|string',
            'dukungan_internasional' => 'required|in:Ya,Tidak',
            'keterangan' => 'required|string',
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
            'luka_ringanberat'=> 'nullable|string',
            'meninggalevakuasi'=> 'nullable|string',
            'evakuasi_keterangan'=> 'nullable|string',
            'distribusi'=> 'nullable|string',
            'dapur_umum'=> 'nullable|string',
            'evakuasi'=> 'nullable|string',
            'layanan_kesehatan'=> 'nullable|string',
            // Validasi untuk data mobilisasi sd
            'kend_ops'=> 'nullable|string',
            'truk_angkut'=> 'nullable|string',
            'truk_tanki'=> 'nullable|string',
            'double_cabin'=> 'nullable|string',
            'alat_du'=> 'nullable|string',
            'ambulans'=> 'nullable|string',
            'alat_watsan'=> 'nullable|string',
            'rs_lapangan'=> 'nullable|string',
            'alat_pkdd'=> 'nullable|string',
            'gudang_lapangan'=> 'nullable|string',
            'posko_aju'=> 'nullable|string',
            'alat_it_lapangan'=> 'nullable|string',
            'medis'=> 'nullable|string',
            'paramedis'=> 'nullable|string',
            'relief'=> 'nullable|string',
            'logistik'=> 'nullable|string',
            'watsan'=> 'nullable|string',
            'it_telekom'=> 'nullable|string',
            'sheltering'=> 'nullable|string',
            'pengurus'=> 'nullable|string',
            'staf_markas_kabkota'=> 'nullable|integer',
            'staf_markas_prov'=> 'nullable|integer',
            'staf_markas_pusat'=> 'nullable|integer',
            'relawan_pmi_kabkota'=> 'nullable|integer',
            'relawan_pmi_prov'=> 'nullable|integer',
            'relawan_pmi_linprov'=> 'nullable|integer',
            'sukarelawan_sip'=> 'nullable|integer',
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
            // Validasi untuk data dokumentasi
            'dokumentasi' => 'sometimes|array',
            'dokumentasi.*.id_dokumentasi' => 'sometimes|exists:lampiran_dokumentasi,id_dokumentasi',
            'dokumentasi.*.file_dokumentasi' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'dokumentasi.*.delete' => 'sometimes|boolean',
            // Validasi untuk data petugas posko
            'petugasPosko' => 'sometimes|array',

            'petugasPosko.*.id_petugas_posko' => 'sometimes|exists:petugas_posko,id_petugas_posko',

            'petugasPosko.*.nama_lengkap' => 'required|string',
            'petugasPosko.*.kontak' => 'required|string',

        ]);

        $kejadian = KejadianBencana::where('id_kejadian', $id)->firstOrFail();

        // Update kejadian bencana
        $kejadian->update([
            'update' => $validatedData['update'],
            'akses_ke_lokasi' => $validatedData['akses_ke_lokasi'],
            'kebutuhan' => $validatedData['kebutuhan'],
            'hambatan' => $validatedData['hambatan'],
            'giat_pemerintah' => $validatedData['giat_pemerintah'],
            'dukungan_internasional' => $validatedData['dukungan_internasional'],
            'keterangan' => $validatedData['keterangan'],

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
        $evakuasiKorban->keterangan = $validatedData['evakuasi_keterangan'];
        $evakuasiKorban->save();

        // Update layanan korban
        $layananKorban = $giatPmi->layananKorban;
        $layananKorban->distribusi = $validatedData['distribusi'];
        $layananKorban->dapur_umum = $validatedData['dapur_umum'];
        $layananKorban->evakuasi = $validatedData['evakuasi'];
        $layananKorban->layanan_kesehatan = $validatedData['layanan_kesehatan'];
        $layananKorban->save();

        // Update atau create mobilisasi sd
        $mobilisasiSd = $kejadian->mobilisasiSd;
        $mobilisasiSd->save();
        $kejadian->update(['id_mobilisasi_sd' => $mobilisasiSd->id_mobilisasi_sd]);


        // Update alat tdb
        $alatTdb = $mobilisasiSd->alatTdb;
        $alatTdb->kend_ops = $validatedData['kend_ops'];
        $alatTdb->truk_angkut = $validatedData['truk_angkut'];
        $alatTdb->truk_tanki = $validatedData['truk_tanki'];
        $alatTdb->double_cabin = $validatedData['double_cabin'];
        $alatTdb->alat_du = $validatedData['alat_du'];
        $alatTdb->ambulans = $validatedData['ambulans'];
        $alatTdb->alat_watsan = $validatedData['alat_watsan'];
        $alatTdb->rs_lapangan = $validatedData['rs_lapangan'];
        $alatTdb->alat_pkdd = $validatedData['alat_pkdd'];
        $alatTdb->gudang_lapangan = $validatedData['gudang_lapangan'];
        $alatTdb->posko_aju = $validatedData['posko_aju'];
        $alatTdb->alat_it_lapangan = $validatedData['alat_it_lapangan'];
        $alatTdb->save();

        // Update tsr
        $tsr = $mobilisasiSd->tsr;
        $tsr->medis = $validatedData['medis'];
        $tsr->paramedis = $validatedData['paramedis'];
        $tsr->relief = $validatedData['relief'];
        $tsr->logistik = $validatedData['logistik'];
        $tsr->watsan = $validatedData['watsan'];
        $tsr->it_telekom = $validatedData['it_telekom'];
        $tsr->sheltering = $validatedData['sheltering'];
        $tsr->save();

        // Update personil
        $personil = $mobilisasiSd->personil;
        $personil->pengurus = $validatedData['pengurus'];
        $personil->staf_markas_kabkota = $validatedData['staf_markas_kabkota'];
        $personil->staf_markas_prov = $validatedData['staf_markas_prov'];
        $personil->staf_markas_pusat = $validatedData['staf_markas_pusat'];
        $personil->relawan_pmi_kabkota = $validatedData['relawan_pmi_kabkota'];
        $personil->relawan_pmi_prov = $validatedData['relawan_pmi_prov'];
        $personil->relawan_pmi_linprov = $validatedData['relawan_pmi_linprov'];
        $personil->sukarelawan_sip = $validatedData['sukarelawan_sip'];
        $personil->save();

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
                        'id_kejadian' => $id
                    ]);
                }
            }
        }

        // Proses data petugas posko
        if (isset($validatedData['petugasPosko'])) {
            // Mendapatkan semua id_narahubung yang ada di request
            $requestedIds = collect($validatedData['petugasPosko'])->pluck('id_petugas_posko')->filter()->toArray();

            // Menghapus narahubung yang tidak ada di request (yang dihapus oleh user)
            $kejadian->petugasPosko()->whereNotIn('id_petugas_posko', $requestedIds)->delete();

            foreach ($validatedData['petugasPosko'] as $petugasPoskoData) {
                if (isset($petugasPoskoData['id_petugas_posko'])) {
                    // Update narahubung yang sudah ada
                    $kejadian->petugasPosko()->where('id_petugas_posko', $petugasPoskoData['id_petugas_posko'])
                        ->update([
                            'nama_lengkap' => $petugasPoskoData['nama_lengkap'],
                            'kontak' => $petugasPoskoData['kontak'],
                        ]);
                } else {
                    // Tambah narahubung baru
                    $kejadian->petugasPosko()->create([
                        'nama_lengkap' => $petugasPoskoData['nama_lengkap'],
                        'kontak' => $petugasPoskoData['kontak'],
                        'id_kejadian' => $id
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

        // Proses data dokumentasi
    if ($request->has('dokumentasi')) {
        foreach ($request->dokumentasi as $index => $dokumentasiData) {
            if (isset($dokumentasiData['id_dokumentasi'])) {
                $dokumentasi = $kejadian->dokumentasi()->find($dokumentasiData['id_dokumentasi']);
                if ($dokumentasi) {
                    if (isset($dokumentasiData['delete']) && $dokumentasiData['delete'] == '1') {
                        // Hapus file
                        if ($dokumentasi->file_dokumentasi) {
                            Storage::delete('public/dokumentasi/' . $dokumentasi->file_dokumentasi);
                        }
                        $dokumentasi->delete();
                    } elseif (isset($dokumentasiData['file_dokumentasi'])) {
                        // Update file
                        if ($dokumentasi->file_dokumentasi) {
                            Storage::delete('public/dokumentasi/' . $dokumentasi->file_dokumentasi);
                        }
                        $file = $dokumentasiData['file_dokumentasi'];
                        $fileName = time() . '_' . $file->getClientOriginalName();
                        $file->storeAs('public/dokumentasi', $fileName, 'public');
                        $dokumentasi->update(['file_dokumentasi' => $fileName]);
                    }
                }
            } elseif (isset($dokumentasiData['file_dokumentasi'])) {
                // Tambah dokumentasi baru
                $file = $dokumentasiData['file_dokumentasi'];
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/dokumentasi', $fileName, 'public');
                $kejadian->dokumentasi()->create([
                    'file_dokumentasi' => $fileName,
                    'id_kejadian' => $id
                ]);
            }
        }
    }
        return redirect()->route('relawan-lapsit', $kejadian->id_kejadian)->with('success', 'Laporan Situasi berhasil diperbarui');

    }

    public function delete_lapsit(Request $request, string $id)
    {
        // Mengambil data kejadian bencana berdasarkan id
        $kejadianBencana = KejadianBencana::where('id_kejadian', $id)->firstOrFail();

        // Menghapus data yang terkait di tabel lain
        $kejadianBencana->narahubung()->delete();
        $kejadianBencana->petugasPosko()->delete();
        $kejadianBencana->dokumentasi()->delete();

        // Menghapus data kejadian bencana itu sendiri
        $kejadianBencana->delete();

        // Redirect atau kembalikan response
        // Check if the request is AJAX
        if ($request->ajax() || $request->wantsJson()) {
            // Return JSON response indicating success
            return new JsonResponse(['message' => 'Data laporan situasi berhasil dihapus'], 200);
        } else {
            // Redirect for non-AJAX requests
            return redirect('relawan/laporan-kejadian')->with('success', 'Data laporan situasi berhasil dihapus');
        }
        // return redirect('relawan/lapsit')->with('success', 'Data Laporan Situasi berhasil dihapus.');
    }

    public function detail_lapsit()
    {
        //
        return view('relawan.lapsit.detail');
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

