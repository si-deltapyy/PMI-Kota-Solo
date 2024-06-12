<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KejadianBencana;
use App\Models\Report;

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
    public function index_lapsit()
    {
        $kejadianBencanas = KejadianBencana::with('jenisKejadian', 'admin', 'relawan')->get();
        return view('relawan.lapsit.index', compact('kejadianBencanas'));
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
        //
        return view('relawan.laporankejadian.create');
    }
    public function edit_laporankejadian()
    {
        //
        return view('relawan.laporankejadian.edit');
    }

    public function delete_laporankejadian(string $id)
    {
        Report::findOrFail($id)->delete();

        return redirect('relawan.laporankejadian.index')->with('success', 'Data berhasil dihapus');
    }

    // CREATE, UPDATE, DELETE LAPORAN ASSESSMENT
    public function create_assessment()
    {
        //
        return view('relawan.assessment.create'); //
    }
    public function edit_assessment($id)
    {
        $kejadianBencana = KejadianBencana::findOrFail($id);

        // Dapatkan data terkait yang dibutuhkan untuk dikirim ke view
        $jenisKejadian = $kejadianBencana->jenisKejadian;
        $assessment = $kejadianBencana->assessment;
        $mobilisasiSd = $kejadianBencana->mobilisasiSd;
        $giatPmi = $kejadianBencana->giatPmi;
        $dokumentasi = $kejadianBencana->dokumentasi;
        $narahubung = $kejadianBencana->narahubung;
        $petugasPosko = $kejadianBencana->petugasPosko;

        return view('relawan.assessment.edit', compact('kejadianBencana', 'jenisKejadian', 'assessment', 'mobilisasiSd', 'giatPmi', 'dokumentasi', 'narahubung', 'petugasPosko'));
    }
    public function delete_assessment(string $id)
    {
        KejadianBencana::findOrFail($id)->delete();

        return redirect('relawan.assessment.index')->with('success', 'Data berhasil dihapus');
    }

    // CREATE, UPDATE, DELETE LAPORAN SITUASI
    public function create_lapsit()
    {
        //
        return view('relawan.lapsit.create');
    }

    public function edit_lapsit($id)
    {
        $kejadianBencana = KejadianBencana::findOrFail($id);

        // Dapatkan data terkait yang dibutuhkan untuk dikirim ke view
        $jenisKejadian = $kejadianBencana->jenisKejadian;
        $assessment = $kejadianBencana->assessment;
        $mobilisasiSd = $kejadianBencana->mobilisasiSd;
        $giatPmi = $kejadianBencana->giatPmi;
        $dokumentasi = $kejadianBencana->dokumentasi;
        $narahubung = $kejadianBencana->narahubung;
        $petugasPosko = $kejadianBencana->petugasPosko;

        return view('relawan.lapsit.edit', compact('kejadianBencana', 'jenisKejadian', 'assessment', 'mobilisasiSd', 'giatPmi', 'dokumentasi', 'narahubung', 'petugasPosko'));
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
}
