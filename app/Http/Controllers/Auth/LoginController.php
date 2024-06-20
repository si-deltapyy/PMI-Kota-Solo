<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();

        // Example role-based redirection
        if ($user->hasRole('admin')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/admin/dashboard';
        } elseif ($user->hasRole('relawan')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/relawan/dashboard';
        } elseif ($user->hasRole('pengelolaProfil')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/pengelolaProfil/dashboard';
        }

        // Default redirection if no roles match
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
