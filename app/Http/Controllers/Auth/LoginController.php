<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, HasRoles;

    protected function redirectTo()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/admin/laporan-kejadian';
        } elseif ($user->hasRole('relawan')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/relawan/laporan-kejadian';
        } elseif ($user->hasRole('pengelola_profil')) {
            return '/pengelolaProfil/relawan_management';
        }

        return '/home';
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->is_approved) {
            Auth::logout();
            Log::info('User is not approved: ' . $user->email);
            return redirect('/login')->with('error', 'Your account is not approved yet. Please wait for approval from the profile manager.');
        }

        return redirect()->intended($this->redirectPath());
       
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        // Cari pengguna berdasarkan email
        $user = User::where($this->username(), $credentials[$this->username()])->first();

        // Jika pengguna ditemukan dan belum disetujui
        if ($user && !$user->is_approved) {
            // Logout jika pengguna belum disetujui
            Auth::logout();
            return false;
        }

        // Coba login dengan kredensial yang ada
        return Auth::attempt($credentials, $request->filled('remember'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $user = User::where($this->username(), $credentials[$this->username()])->first();

        if ($user && !$user->is_approved) {
            // Jika pengguna ditemukan dan belum disetujui, kirim pesan khusus
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors([
                    $this->username() => 'Your account is not approved yet. Please wait for approval from the profile manager.',
                ]);
        }

        // Jika pengguna tidak ditemukan atau kredensial tidak cocok, kirim pesan default
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => trans('auth.failed'),
            ]);
    }
}
