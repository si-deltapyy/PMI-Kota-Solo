<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class PengelolaProfilController extends Controller
{
    
    public function index()
    {

        return view('pengelola_profil.dashboard');
    }
    public function user_management()
    {
        $roles = Role::all();
        $user = User::all();
        return view('pengelola_profil.user_management', compact('user', 'roles'));
    }

    public function user_management_edit($id){

        $user = User::find($id);
        return view('pengelola_profil.user_management_edit', compact('user'));
    }

    public function relawan_management(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $user = User::role('relawan')
                        ->where(function($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%")
                                  ->orWhere('email', 'LIKE', "%{$search}%")
                                  ->orWhere('username', 'LIKE', "%{$search}%");
                        })
                        ->get();
        } else {
            $user = User::role('relawan')->get();
        }

        return view('pengelola_profil.relawan_management', compact('user'));
    }

    //  relawan
    public function create_relawan()
    {
        return view('pengelola_profil.add-volunteer');
    }

    public function store_relawan(Request $request)
    {
                // Validasi input
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Berikan peran admin kepada user
            $user->assignRole('relawan');

           
            return redirect()->route('pengelola-relawan')->with('success', 'Relawan account created successfully.');
                // return view('pengelola_profil.add-admin');
    }
    public function edit_relawan($id)
    {
        $user = User::findOrFail($id);
        return view('pengelola_profil.edit-relawan', compact('user'));
    }
    public function update_relawan(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('pengelola-relawan')->with('success', 'Akun Relawan berhasil diedit.');
    }

  
    public function show_relawan($id)
    {
        $user = User::findOrFail($id);
        return view('pengelola_profil.detail-volunteer');
    }

    public function destroy_relawan(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengelola-relawan')->with('success', 'Akun Relawan berhasil dihapus.');
    }




    // Admin 
    public function admin_management(request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $user = User::role('admin')
                        ->where(function($query) use ($search) {
                            $query->where('name', 'LIKE', "%{$search}%")
                                  ->orWhere('email', 'LIKE', "%{$search}%")
                                  ->orWhere('username', 'LIKE', "%{$search}%");
                        })
                        ->get();
        } else {
            $user = User::role('admin')->get();
        }
       
        return view('pengelola_profil.admin_management', compact('user'));
       
    }

    public function create_admin()
    {
        return view('pengelola_profil.add-admin');
    }
    public function store_admin(Request $request)
    {
                // Validasi input
            $request->validate([
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users,username',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Buat user baru
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Berikan peran admin kepada user
            $user->assignRole('admin');

            // Redirect atau tampilkan pesan sukses
            return redirect()->route('pengelola-admin')->with('success', 'Admin account created successfully.');
                // return view('pengelola_profil.add-admin');
    }

    public function edit_admin($id){
        $user = User::findOrFail($id);
        return view('pengelola_profil.edit-admin', compact('user'));
    }

    public function update_admin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('pengelola-admin')->with('success', 'Akun Relawan berhasil diedit.');
    }

    public function destroy_admin(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengelola-admin')->with('success', 'Akun Relawan berhasil dihapus.');
    }

    public function show_admin($id)
    {
        $user = User::findOrFail($id);
        return view('pengelola_profil.detail-admin', compact('user'));

    }

}
