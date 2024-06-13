<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class pdfController extends Controller
{
    
    
    public function viewPDF($id)
    {
        // $users = User::find($id);
        // $roles = Role::all();

        // $pdf = PDF::loadView('pdf.lapsit', array('user' =>  $users, 'role' => $roles))
        // ->setPaper('a4', 'portrait');

        // return $pdf->stream(); 

    }

    public function downloadPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.usersdetails', array('users' =>  $users))
        ->setPaper('a4', 'portrait');

        return $pdf->download('users-details.pdf');   
    }

    public function exportLaporanKejadian($id)
    {
        // Retrieve the report data
        $report = Report::with('user', 'assessments')->findOrFail($id);

        // Share data to view
        $data = ['report' => $report];

        $pdf = PDF::loadView('pdf.laporan-kejadian', $data);

        return $pdf->stream('laporan-kejadian.pdf');
    }
}
