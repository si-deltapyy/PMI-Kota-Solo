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

    public function test()
    {
        notify()->success('Hi Admin , welcome to codelapan');
        return view('pdf.flash-report');
    }

    public function downloadPDF()
    {
        $users = User::all();

        $pdf = PDF::loadView('pdf.usersdetails', array('users' =>  $users))
        ->setPaper('a4', 'portrait');

        return $pdf->download('users-details.pdf');   
    }
}
