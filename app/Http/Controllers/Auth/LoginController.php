<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
            return '/admin/dashboard';
        } elseif ($user->hasRole('relawan')) {
            notify()->preset('success', ['message' => 'Hi '.$user->name.' Selamat Datang']);
            return '/relawan/dashboard';
        } elseif ($user->hasRole('pengelola_profil')) {
            return '/pengelolaProfil/user_management';
        }

        return '/home';
    }

    protected function authenticated(Request $request, $user)
    {
        if (!$user->is_approved) {
            Auth::logout();
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
        return Auth::attempt(
            $this->credentials($request) + ['is_approved' => true],
            $request->filled('remember')
        );
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')],
            ]);
    }
}
