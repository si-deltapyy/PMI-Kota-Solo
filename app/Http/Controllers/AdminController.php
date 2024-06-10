<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

    public function index_exsum()
    {
        return view('admin.executive_summary');
    }
    public function assessment_unverif()
    {
        return view('admin.assessment.unverified.index');
    }
    public function assessment_verif()
    {
        return view('admin.assessment.verified.index');
    }

    public function lapsit()
    {
        $user = User::all();
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
}
