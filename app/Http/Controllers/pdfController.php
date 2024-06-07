<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class pdfController extends Controller
{
    public function viewPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.usersdetails', array('users' =>  $users))
        ->setPaper('a4', 'portrait');

        return $pdf->stream();

    }

    public function downloadPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.usersdetails', array('users' =>  $users))
        ->setPaper('a4', 'portrait');

        return $pdf->download('users-details.pdf');   
    }
}
