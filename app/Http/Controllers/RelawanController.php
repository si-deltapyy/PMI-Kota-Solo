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
    public function index_laporankejadian()
    {
        //
        return view('relawan.laporankejadian.index');
    }
    //index lapsit asli
    public function index_lapsit()
    {
        return view('relawan.lapsit.index');
    }
    //index lapsit cek delete
    public function index_lapsit2()
    {
        $kejadianBencanaList = KejadianBencana::with('jenisKejadian')->get();

        return view('relawan.lapsit.indexdelete', compact('kejadianBencanaList'));
    }
    public function index_assessment()
    {
        //
        return view('relawan.assessment.index');
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
    public function create_assessment()
    {
        //
        return view('relawan.assessment.create'); //
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
        'dampak.pengungsian', // Menambahkan relasi pengungsian
        'narahubung'
    ])->firstOrFail();
    $jenisKejadian = JenisKejadian::all();

    return view('relawan.assessment.edit', compact('kejadian', 'jenisKejadian'));
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
        'meninggal' => 'nullable|integer',
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
        'meninggal'=> 'nullable|string',
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
    $korbanJlw->meninggal = $validatedData['meninggal'];
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
    $evakuasiKorban->meninggal = $validatedData['meninggal'];
    $evakuasiKorban->keterangan = $validatedData['keterangan'];
    $evakuasiKorban->save();

    // Update layanan korban
    $layananKorban = $giatPmi->layananKorban;
    $layananKorban->distribusi = $validatedData['luka_ringanberat'];
    $layananKorban->dapur_umum = $validatedData['meninggal'];
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


    return redirect()->route('relawan-assessment', $kejadian->id_kejadian)->with('success', 'Assessment dan data dampak berhasil diperbarui');
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

            return redirect('relawan/assesment')->with('success', 'Data berhasil dihapus');
        } else {
            return redirect('relawan/assesment')->with('error', 'Hanya data yang belum diverifikasi yang dapat dihapus');
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

    public function create_lapsit()
    {
        //
        //$jenisKejadian = DB::table('jenis_kejadian')->get();

        $lapsit = DB::table('kejadian_bencana')->join('dampak', 'kejadian_bencana.id_kejadian', '=', 'dampak.id_kejadian')->join('assessment', 'kejadian_bencana.id_assessment', '=', 'assessment.id_assessment')->
            join('mobilisasi_sd', 'kejadian_bencana.id_mobilisasi_sd', '=', 'mobilisasi_sd.idmobilisasi_sd')->join('giat_pmi', 'kejadian_bencana.id_giat_pmi', '=', 'giat_pmi.id_giat_pmi')->
            join('lampiran_dokumentasi', 'kejadian_bencana.id_dokumentasi', '=', 'lampiran_dokumentasi.id_dokumentasi')->join('personil_narahubung', 'kejadian_bencana.id_narahubung', '=', 'personil_narahubung.id_narahubung')->
            join('petugas_posko', 'kejadian_bencana.id_petugas_posko', '=', 'petugas_posko.id_petugas_posko')->join('user', 'kejadian_bencana.id_admin', '=', 'user.id_user')->
            join('user', 'kejadian_bencana.id_relawan', '=', 'user.id_user')->join('mobilisasi_sd', 'personil.id_personil', '=', 'mobilisasi_sd.id_personil')->join('mobilisasi_sd', 'alat_tdb.id_alat_tdb', '=', 'mobilisasi_sd.id_mobilisasi_sd')->
            join('mobilisasi_sd', 'tsr.id_tsr', '=', 'mobilisasi_sd.id_tsr')->join('giat_pmi', 'evakuasi_korban.id_evakuasikorban', '=', 'giat_pmi.id_evakuasikorban')->join('giat_pmi', 'layanan_korban.id_layanankorban', '=', 'giat_pmi.id_layanankorban')->
            join('assessment', 'layanan_korban.id_assessment', '=', 'assessment.id_assessment')->join('dampak', 'korban_terdampak.id_korban_terdampak', '=', 'dampak.id_korban_terdampak')->join('dampak', 'kerusakan_rumah.id_kerusakan_rumah', '=', 'dampak.id_kerusakan_rumah')->
            join('dampak', 'kerusakan_fasil_sosial.id_kerusakan_fasil_sosial', '=', 'dampak.id_kerusakan_fasil_sosial')->join('dampak', 'kerusakan_infrastruktur.id_kerusakan_infrastruktur', '=', 'dampak.id_kerusakan_infrastruktur')->
            join('dampak', 'pengungsian.id_pengungsian', '=', 'dampak.id_pengungsian')->join('dampak', 'korban_jlw.id_korban_jlw', '=', 'dampak.id_korban_jlw')->first();

        $jenisKejadian = JenisKejadian::all();
        $kejadianBencana = KejadianBencana::all();

        return view('relawan.lapsit.create', compact('jenisKejadian', 'kejadianBencana'));
    }

    public function store_lapsit(Request $request)
    {
        $validatedData = $request->validate([
            //'id_jeniskejadian' => 'required|exists:jenis_kejadian,id_jeniskejadian',
            'nama_kejadian' => 'required|string|max:255|exists:jenis_kejadian,nama_kejadian',
            'lokasi' => 'required|string|max:255|exists:kejadian_bencana,lokasi',
            'tanggal_kejadian' => 'required|date|exists:kejadian_bencana,tanggal_kejadian',
            'update' => 'required|date|exists:kejadian_bencana,update',
            'dukungan_internasional' => 'required|in:Ya, Tidak|exists:kejadian_bencana,dukungan_internasional',
            'gambaran_situasi' => 'nullable|exists:kejadian_bencana,keterangan',
            'akses_ke_lokasi' => 'required|in:Accessible, Not Accessible|exists:kejadian_bencana,akses_ke_lokasi',
            /*'id_assessment' => 'nullable|exists:assessment,id_assessment',
            'id_mobilisasi_sd' => 'nullable|exists:mobilisasi_sd,id_mobilisasi_sd',
            'id_giat_pmi' => 'nullable|exists:giat_pmi,id_giat_pmi',
            'id_dokumentasi' => 'nullable|exists:lampiran_dokumentasi,id_dokumentasi',
            'id_narahubung' => 'nullable|exists:personil_narahubung,id_narahubung',
            'id_petugas_posko' => 'nullable|exists:petugas_posko,id_petugas_posko',*/
            'file_dokumentasi' => 'nullable|image:jpeg,jpg,png|max:2048|exists:lampiran_dokumentasi,file_dokumentasi',
            'kk' => 'nullable|integer|exists:korban_terdampak,kk',
            'jiwa' => 'nullable|integer|exists:korban_terdampak,jiwa',
            'luka_berat' => 'nullable|integer|exists:korban_jlw,luka_berat',
            'luka_ringan' => 'nullable|integer|exists:korban_jlw,luka_ringan',
            'meninggal' => 'nullable|integer|exists:korban_jlw,meninggal',
            'hilang' => 'nullable|integer|exists:korban_jlw,hilang',
            'mengungsi' => 'nullable|integer|exists:korban_jlw,mengungsi',
            'rusak_ringan' => 'nullable|integer|exists:kerusakan_rumah,rusak_ringan',
            'rusak_sedang' => 'nullable|integer|exists:kerusakan_rumah,rusak_sedang',
            'rusak_berat' => 'nullable|integer|exists:kerusakan_rumah,rusak_berat',
            'sekolah' => 'nullable|integer|exists:kerusakan_fasil_sosial,sekolah',
            'tempat_ibadah' => 'nullable|integer|exists:kerusakan_fasil_sosial,tempat_ibadah',
            'rumah_sakit' => 'nullable|integer|exists:kerusakan_fasil_sosial,rumah_sakit',
            'pasar' => 'nullable|integer|exists:kerusakan_fasil_sosial,pasar',
            'gedung_pemerintah' => 'nullable|integer|exists:kerusakan_fasil_sosial,gedung_pemerintah',
            'lain_lain' => 'nullable|integer|exists:kerusakan_fasil_sosial,lain_lain',
            'desc_kerusakan' => 'nullable|string|max:255|exists:kerusakan_infrastruktur,desc_kerusakan',
            'nama_lokasi' => 'nullable|string|max:255|exists:pengungsian,nama_lokasi',
            'jumlah_kk' => 'nullable|integer|exists:pengungsian,kk',
            'jumlah_orang' => 'nullable|integer|exists:pengungsian,jiwa',
            'laki_laki' => 'nullable|integer|exists:pengungsian,laki_laki',
            'perempuan' => 'nullable|integer|exists:pengungsian,perempuan',
            'kurang_dari_5' => 'nullable|integer|exists:pengungsian,kurang_dari_5',
            'antara_5_18' => 'nullable|integer|exists:pengungsian,atr_5_sampai_8',
            'lebih_dari_18' => 'nullable|integer|exists:pengungsian,lebih_dari_18',
            'jumlah' => 'nullable|integer|exists:pengungsian,jumlah',
            'pengurus' => 'nullable|integer|exists:personil,pengurus',
            'staff_markas_kabkota' => 'nullable|integer|eexists:personil,staff_markas_kabkota',
            'staff_markas_prov' => 'nullable|integer|exists:personil,staff_markas_prov',
            'staff_markas_pusat' => 'nullable|integer|exists:personil,staff_markas_pusat',
            'relawan_pmi_kabkot' => 'nullable|integer|exists:personil,relawan_pmi_kabkot',
            'relawan_pmi_prov' => 'nullable|integer|exists:personil,relawan_pmi_prov',
            'relawan_pmi_linprov' => 'nullable|integer|exists:personil,relawan_pmi_linprov',
            'sukarelawan_sp' => 'nullable|integer|exists:personil,sukarelawan_sp',
            'medis' => 'nullable|integer|exists:tsr,medis',
            'paramedis' => 'nullable|integer|exists:tsr,paramedis',
            'relief' => 'nullable|integer|exists:tsr,relief',
            'logistik' => 'nullable|integer|exists:tsr,logistik',
            'watsan' => 'nullable|integer|exists:tsr,watsan',
            'it_telekom' => 'nullable|integer|exists:tsr,it_telekom',
            'sheltering' => 'nullable|integer|exists:tsr,sheltering',
            'kend_ops' => 'nullable|integer|exists:alat_tdb,kend_ops',
            'truk_angkut' => 'nullable|integer|exists:alat_tdb,truk_angkut',
            'truk_tanki' => 'nullable|integer|exists:alat_tdb,truk_tanki',
            'double_cabin' => 'nullable|integer|exists:alat_tdb,double_cabin',
            'alat_du' => 'nullable|integer|exists:alat_tdb,alat_du',
            'ambulans' => 'nullable|integer|exists:alat_tdb,ambulans',
            'alat_watsan' => 'nullable|integer|exists:alat_tdb,alat_watsan',
            'rs_lapangan' => 'nullable|integer|exists:alat_tdb,rs_lapangan',
            'alat_pkdd' => 'nullable|integer|exists:alat_tdb,alat_pkdd',
            'gudang_lapangan' => 'nullable|integer|exists:alat_tdb,gudang_lapangan',
            'posko_aju' => 'nullable|integer|exists:alat_tdb,posko_aju',
            'alat_it_lapangan' => 'nullable|integer|exists:alat_tdb,alat_it_lapangan',
            'luka_ringanberat' => 'nullable|integer|exists:evakuasi_korban,luka_ringanberat',
            'korban_meninggal' => 'nullable|integer|exists:evakuasi_korban,meninggal',
            'keterangan' => 'nullable|string|max:255|exists:evakuasi_korban,keterangan',
            'assessment' => 'nullable|in:On Process, Aktif, Selesai|exists:assessment,status',
            'distribusi' => 'nullable|string|max:255|exists:layanan_korban,distribusi',
            'evakuasi' => 'nullable|string|max:255|exists:layanan_korban,evakuasi',
            'layanan_kesehatan' => 'nullable|string|max:255|exists:layanan_korban,layanan_kesehatan',
            'dapur_umum' => 'nullable|string|max:255|exists:layanan_korban,dapur_umum',
            'giat_pemerintah' => 'nullable|string|max:255|exists:kejadian_bencana,giat_pemerintah',
            'hambatan' => 'nullable|string|max:255|exists:kejadian_bencana,hambatan',
            'kebutuhan' => 'nullable|string|max:255|exists:kejadian_bencana,kebutuhan',
            'nama_lengkap' => 'nullable|string|max:255|exists:personil_narahubung,nama_lengkap',
            'posisi' => 'nullable|string|max:255|exists:personil_narahubung,posisi',
            'kontak' => 'nullable|string|max:255|exists:personil_narahubung,kontak',
            'nama_lengkap_posko' => 'nullable|string|max:255|exists:petugas_posko,nama_lengkap',
            'kontak_posko' => 'nullable|string|max:255|exists:petugas_posko,kontak',
            //'status' => 'nullable',
        ]);

        //$user = DB::table('user')->->where('id_user', $idUser)->first();;



        $assessment = Assessment::create([
            'status' => $request->assessment,
        ]);

        /*$lampiranDokumentasi = $request->file('file_dokumentasi');
        $filePath = $fileDokumentasi->store('documentation', 'public');*/

        if ($request->hasFile('file_dokumentasi')) {
            $file = $request->file('file_dokumentasi');
            $filePath = $file->store('dokumentasi', 'public');
            $lampiranDokumentasi = LampiranDokumentasi::create([
                'file_dokumentasi' => $filePath,
            ]);
        } else {
            $lampiranDokumentasi = LampiranDokumentasi::create([
                'file_dokumentasi' => null,
            ]);
        }

        $jenisKejadian = JenisKejadian::create([
            'nama_kejadian' => $request->nama_kejadian,
        ]);

        //$jenisKejadian = JenisKejadian::table('jenis_kejadian')->get();

        $personil = Personil::create([
            'pengurus' => $request->pengurus,
            'staff_markas_kabkot' => $request->staff_markas_kabkot,
            'staff_markas_prov' => $request->staff_markas_prov,
            'staff_markas_pusat' => $request->staff_markas_pusat,
            'relawan_pmi_kabkot' => $request->relawan_pmi_kabkot,
            'relawan_pmi_prov' => $request->relawan_pmi_prov,
            'relawan_pmi_linprov' => $request->relawan_pmi_linprov,
            'sukarelwan_sp' => $request->sukarelwan_sp,
        ]);

        $tsr = Tsr::create([
            'medis' => $request->medis,
            'paramedis' => $request->paramedis,
            'relief' => $request->relief,
            'logistik' => $request->logistik,
            'watsan' => $request->watsan,
            'it_telekom' => $request->it_telekom,
            'sheltering' => $request->sheltering,
        ]);

        $alatTdb = AlatTdb::create([
            'kend_ops' => $request->kend_ops,
            'truk_angkut' => $request->truk_angkut,
            'truk_tanki' => $request->truk_tanki,
            'double_cabin' => $request->double_cabin,
            'alat_du' => $request->alat_du,
            'ambulans' => $request->ambulans,
            'alat_watsan' => $request->alat_watsan,
            'rs_lapangan' => $request->rs_lapangan,
            'alat_pkdd' => $request->alat_pkdd,
            'gudang_lapangan' => $request->gudang_lapangan,
            'posko_aju' => $request->posko_aju,
            'alat_it_lapangan' => $request->alat_it_lapangan,
        ]);

        $mobilisasiSd = MobilisasiSd::create([
            //'id_mobilisasi_sd' => $request->id_mobilisasi_sd,
            'id_personil' => $personil->id_personil,
            'id_tsr' => $tsr->id_tsr,
            'id_alat_tdb' => $alatTdb->id_alat_tdb,
        ]);

        $evakuasiKorban = EvakuasiKorban::create([
            'luka_ringanberat' => $request->luka_ringanberat,
            'meninggal' => $request->korban_meninggal,
            'keterangan' => $request->keterangan,
        ]);

        $layananKorban = LayananKorban::create([
            'id_assessment' => $assessment->id_assessment,
            'distribusi' => $request->distribusi,
            'dapur_umum' => $request->dapur_umum,
            'evakuasi' => $request->evakuasi,
            'layanan_kesehatan' => $request->layanan_kesehatan,
        ]);

        $giatPmi = GiatPMI::create([
            //'id_giat_pmi' => $request->id_giat_pmi,
            'id_evakuasikorban' => $evakuasiKorban->id_evakuasikorban,
            'id_layanankorban' => $layananKorban->id_layanankorban,
        ]);

        $personilNarahubung = PersonilNarahubung::create([
            'nama_lengkap' => $request->nama_lengkap,
            'posisi' => $request->posisi,
            'kontak' => $request->kontak,
        ]);

        $petugasPosko = PetugasPosko::create([
            'nama_lengkap' => $request->nama_lengkap_posko,
            'kontak' => $request->kontak_posko,
        ]);

        $lampiranDokumentasi = LampiranDokumentasi::create([
            'file_dokumentasi' => $filePath,
        ]);

        $kejadianBencana = KejadianBencana::create([
            'id_jeniskejadian' => $jenisKejadian->id_jeniskejadian,
            'lokasi' => $request->lokasi,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'update' => $request->update,
            'dukungan_internasional' => $request->dukungan_internasional,
            'akses_ke_lokasi' => $request->akses_ke_lokasi,
            'id_assessment' => $assessment->id_assessment,
            'id_mobilisasi_sd' => $mobilisasiSd->id_mobilisasi_sd,
            'id_giat_pmi' => $giatPmi->id_giat_pmi,
            'id_dokumentasi' => $lampiranDokumentasi->id_dokumentasi,
            'id_narahubung' => $personilNarahubung->id_narahubung,
            'id_petugas_posko' => $petugasPosko->id_petugas_posko,
        ]);

        $korbanTerdampak = KorbanTerdampak::create([
            'kk' => $request->kk,
            'jiwa' => $request->jiwa,
        ]);

        $korbanJiwa = KorbanJlw::create([
            'luka_berat' => $request->luka_berat,
            'luka_ringan' => $request->luka_ringan,
            'meninggal' => $request->meninggal,
            'hilang' => $request->hilang,
            'mengungsi' => $request->mengungsi,
        ]);

        $kerusakanRumah = KerusakanRumah::create([
            'rusak_berat' => $request->rusak_berat,
            'rusak_sedang' => $request->rusak_sedang,
            'rusak_ringan' => $request->rusak_ringan,
        ]);

        $kerusakanFasos = KerusakanFasilSosial::create([
            'sekolah' => $request->sekolah,
            'tempat_ibadah' => $request->tempat_ibadah,
            'rumah_sakit' => $request->rumah_sakit,
            'pasar' => $request->pasar,
            'gedung_pemerintah' => $request->gedung_pemerintah,
            'lain_lain' => $request->lain_lain,
        ]);

        $kerusakanInfrastruktur = KerusakanInfrastruktur::create([
            'desc_infrastruktur' => $request->desc_infrastruktur,
        ]);

        $pengungsian = Pengungsian::create([
            'nama_lokasi' => $request->nama_lokasi,
            'kk' => $request->jumlah_kk,
            'jiwa' => $request->jumlah_orang,
            'laki_laki' => $request->laki_laki,
            'perempuan' => $request->perempuan,
            'kurang_dari_5' => $request->kurang_dari_5,
            'atr_5_18' => $request->antara_5_18,
            'lebih_dari_18' => $request->lebih_dari_188,
            'jumlah' => $request->jumlah,
        ]);

        $dampak = Dampak::create([
            'id_korban_terdampak' => $korbanTerdampak->id_korban_terdampak,
            'id_kerusakan_rumah' => $kerusakanRumah->id_kerusakan_rumah,
            'id_kerusakan_fasil_sosial' => $kerusakanFasos->id_kerusakan_fasil_sosial,
            'id_kerusakan_infrastruktur' => $kerusakanInfrastruktur->id_kerusakan_infrastruktur,
            'id_pengungsian' => $pengungsian->id_pengungsian,
            'id_kejadian' => $kejadianBencana->id_kejadian,
            'id_korban_jlw' => $korbanJiwa->id_korban_jlw,
        ]);

        return redirect('relawan.lapsit.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit_lapsit($id)
    {
        $kejadianBencana = KejadianBencana::findOrFail($id);
        $jenisKejadians = JenisKejadian::all();

        return view('relawan.lapsit.edit', compact('kejadianBencana', 'jenisKejadians'));
    }

    public function update_lapsit(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_jeniskejadian' => 'required|exists:jenis_kejadian,id',
            'tanggal_kejadian' => 'required|date',
            'lokasi' => 'required',
            'update' => 'nullable',
            'dukungan_internasional' => 'nullable',
            'keterangan' => 'nullable',
            'akses_ke_lokasi' => 'nullable',
            'kebutuhan' => 'nullable',
            'giat_pemerintah' => 'nullable',
            'hambatan' => 'nullable',
            'id_assessment' => 'nullable|exists:assessment,id',
            'id_mobilisasi_sd' => 'nullable|exists:mobilisasi_sd,id',
            'id_giat_pmi' => 'nullable|exists:giat_pmi,id',
            'id_dokumentasi' => 'nullable|exists:lampiran_dokumentasi,id',
            'id_narahubung' => 'nullable|exists:personil_narahubung,id',
            'id_petugas_posko' => 'nullable|exists:petugas_posko,id',
            'status' => 'nullable',
        ]);

        $kejadianBencana = KejadianBencana::findOrFail($id);
        $jenisKejadians = JenisKejadian::all();
        $kejadianBencana->update($validatedData);

        return redirect()->route('relawan.lapsit.index')->with('success', 'Laporan situasi berhasil diperbarui.');
    }
    public function delete_lapsit(string $id)
    {
        // Mengambil data kejadian bencana berdasarkan id
        $kejadianBencana = KejadianBencana::findOrFail($id);

        // Menghapus data yang terkait di tabel lain
        $kejadianBencana->narahubung()->delete();
        $kejadianBencana->petugasPosko()->delete();
        $kejadianBencana->dokumentasi()->delete();

        // Menghapus data kejadian bencana itu sendiri
        $kejadianBencana->delete();

        // Redirect atau kembalikan response
        return redirect('relawan/lapsit')->with('success', 'Data Laporan Situasi berhasil dihapus.');
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

