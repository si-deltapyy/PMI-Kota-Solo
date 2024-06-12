<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Http\Controllers\Auth;

class RelawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('relawan.dashboard');
    }
    public function index_laporankejadian()
    {
        $reports = Report::all(); 
        return view('relawan.laporankejadian.index', compact('reports'));
    }
    public function index_lapsit()
    {
        //
        return view('relawan.lapsit.index');
    }
    public function index_assessment()
    {
        //
        return view('relawan.assessment.index');
    }
    /**
     * Show the form for creating a new resource.
     */

    public function create_laporankejadian()
    {
        //
        return view('relawan.laporankejadian.create');
    }
    public function edit_laporankejadian()
    {
        //
        return view('relawan.laporankejadian.edit');
    }

    public function create_assessment()
    {
        //
        return view('relawan.assessment.create'); 
    }
    public function edit_assessment()
    {
        //
        return view('relawan.assessment.edit');
    }

    public function create_lapsit()
    {
        //
        return view('relawan.lapsit.create');
    }

    public function edit_lapsit()
    {
        //
        return view('relawan.lapsit.edit');
    }

    public function detail_lapsit()
    {
        //
        return view('relawan.lapsit.detail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store_laporankejadian(Request $request)
    {
        // Validasi data yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_bencana' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'keterangan' => 'required|string',
            'lokasi_longitude' => 'nullable|numeric',
            'lokasi_latitude' => 'nullable|numeric',
            'status' => 'required|in:On_Proses,Selesai,Dalam_Penanganan',
        ]);

        // Simpan data ke dalam database
        $laporanKejadian = new Report();
        $laporanKejadian->id_user = 2; 
        $laporanKejadian->nama_bencana = $request->nama_bencana;
        $laporanKejadian->tanggal_kejadian = $request->tanggal_kejadian;
        $laporanKejadian->keterangan = $request->keterangan;
        $laporanKejadian->lokasi_longitude = $request->lokasi_longitude;
        $laporanKejadian->lokasi_latitude = $request->lokasi_latitude;
        $laporanKejadian->status = $request->status;
        $laporanKejadian->save();

        return redirect()->route('relawan-laporankejadian')->with('success', 'Laporan kejadian berhasil ditambahkan.');
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
}
