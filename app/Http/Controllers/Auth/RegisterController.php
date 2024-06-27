<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // protected function create(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'role' => 'relawan', // set role sebagai relawan
    //         'is_approved' => false, // awalnya belum disetujui
    //     ]);

    //     return $user;
    // }

    protected function create(array $data)
    {
        $this->validator($data)->validate();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            // 'role' => 'relawan', // set role sebagai relawan
            'is_approved' => false, // awalnya belum disetujui
        ])->assignRole('relawan');

        return $user;
    }

    // public function register(Request $request)
    // {
    //     $this->validator($request->all())->validate();

    //     event(new Registered($user = $this->create($request->all())));

    //     return $this->registered($request, $user)
    //         ?: redirect($this->redirectPath())->with('status', 'Registration successful! Please wait for approval.');
    // }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status', 'Registration successful! Please wait for approval.');
    }


    protected function registered(Request $request, $user)
    {
        // Custom logic after registration, if needed
        return redirect()->intended($this->redirectPath());
    }

    protected function redirectPath()
    {
        // Define the path to redirect after registration
        return '/login';
    }
}
