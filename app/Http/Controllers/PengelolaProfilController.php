<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengelolaProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pengelola_profil.dashboard');
    }
    public function user_management()
    {
        return view('pengelola_profil.user_management');
    }

    public function relawan_management()
    {
        return view('pengelola_profil.relawan_management');
    }

    public function admin_management()
    {
        return view('pengelola_profil.admin_management');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create_relawan()
    {
        return view('pengelola_profil.add-volunteer');
    }

    public function create_admin()
    {
        return view('pengelola_profil.add-admin');
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
