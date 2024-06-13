<?php 
namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectStatusController extends Controller
{
    public function admin_laporan_kejadian(Request $request)
    {
        $status = $request->query('status');

        if ($status) {
            $reports = Report::where('status', $status)->get();
        } else {
            $reports = Report::all();
        }

        return response()->json($reports);
    }

    public function relawan_laporan_kejadian(Request $request)
    {
        $status = $request->query('status');
        $id_user = Auth::id(); // Get the authenticated user's ID

        if ($status) {
            $reports = Report::where('status', $status)->where('id_user', $id_user)->get();
        } else {
            $reports = Report::where('id_user', $id_user)->get();
        }

        return response()->json($reports);
    }
}
