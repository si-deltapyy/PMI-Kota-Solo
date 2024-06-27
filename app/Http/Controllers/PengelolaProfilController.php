<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Mail\UserApproved;
use Illuminate\Support\Facades\Mail;

class PengelolaProfilController extends Controller
{

    public function index()
    {
        // dd('PengelolaProfilController@index dipanggil');
        return view('pengelola_profil.dashboard');
    }
    // public function user_management()
    // {
    //     $roles = Role::all();
    //     $user = User::all();
    //     return view('pengelola_profil.user_management', compact('user', 'roles'));
    // }

    // public function user_management(Request $request)
    // {
    //     $roles = Role::all();
    
    //     // Fetch query parameters
    //     $search = $request->input('search');
    //     $filterRole = $request->input('role');
    
    //     // Initialize the query
    //     $query = User::query();
    
    //     // Apply search filter
    //     if ($search) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('name', 'like', '%' . $search . '%')
    //               ->orWhere('email', 'like', '%' . $search . '%')
    //               ->orWhere('username', 'like', '%' . $search . '%');
    //         });
    //     }
    
    //     // Apply role filter
    //     if ($filterRole) {
    //         $query->whereHas('roles', function($q) use ($filterRole) {
    //             $q->where('name', $filterRole);
    //         });
        
    //         // Apply is_approved filter for 'relawan' role
    //         if ($filterRole == 'relawan') {
    //             $query->where(function ($query) {
    //                 $query->where('is_approved', true)
    //                       ->orWhere('is_approved', false);
    //             });
    //         }
    
    //     $users = $query->get();
    
    //     return view('pengelola_profil.user_management', compact('users', 'roles', 'search', 'filterRole'));
    // }
    // }

    public function user_management(Request $request)
    {
        $roles = Role::all();

        // Fetch query parameters
        $search = $request->input('search');
        $filterRole = $request->input('role');

        // Initialize the query
        $query = User::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('username', 'like', '%' . $search . '%');
            });
        }

        // Apply role filter
        if ($filterRole) {
            $query->whereHas('roles', function ($q) use ($filterRole) {
                $q->where('name', $filterRole);
            });
    
            // Apply is_approved filter for relawan role
            // if ($filterRole == 'relawan') {
            //     $query->where('is_approved', true);
            // }

            if ($filterRole == 'relawan') {
                            $query->where(function ($query) {
                                $query->where('is_approved', true)
                                      ->orWhere('is_approved', false);
                            });
                        }
        }
    
        $users = $query->get();
    
        return view('pengelola_profil.user_management', compact('users', 'roles', 'search', 'filterRole'));
    }
    



    public function user_management_edit($id)
    {

        $user = User::find($id);
        return view('pengelola_profil.user_management_edit', compact('user'));
    }
    public function user_management_hapus($id){
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengelola-user')->with('success', 'Akun berhasil dihapus.');
    }

    public function user_management_update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->is_approved = true; // always set is_approved to true
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
    
            $user->save();

        return redirect()->route('pengelola-user')->with('success', 'Akun berhasil diedit.');
         } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengedit akun.');
        }
    }

    // public function relawan_management(Request $request)
    // {
    //     $search = $request->input('search');

    //     if ($search) {
    //         $user = User::role('relawan')
    //                     ->where(function($query) use ($search) {
    //                         $query->where('name', 'LIKE', "%{$search}%")
    //                               ->orWhere('email', 'LIKE', "%{$search}%")
    //                               ->orWhere('username', 'LIKE', "%{$search}%");
    //                     })
    //                     ->get();
    //     } else {
    //         $user = User::role('relawan')->get();
    //     }

    //     return view('pengelola_profil.relawan_management', compact('user'));
    // }

    public function relawan_management(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status'); // Menangkap nilai status dari parameter request

        // Query dasar untuk mengambil semua user dengan role 'relawan'
        $query = User::role('relawan');

        // Filter berdasarkan pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('username', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan status approval
        if ($status) {
            if ($status == 'approved') {
                $query->where('is_approved', true);
            } elseif ($status == 'not_approved') {
                $query->where('is_approved', false);
            }
        }

        // Ambil data user sesuai dengan query yang sudah dibuat
        $user = $query->get();

        // Kembalikan view dengan data yang diperlukan
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
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // $user = User::findOrFail($id);
        // $user->name = $request->name;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // if($request->password){
        //     $user->password = Hash::make($request->password);
        // }
        // $user->save();
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->is_approved = true; // always set is_approved to true
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            return redirect()->route('pengelola-relawan')->with('success', 'Akun Relawan berhasil diedit.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengedit akun.');
        }
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
                ->where(function ($query) use ($search) {
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
            'is_approved' => true,
        ]);

        // Berikan peran admin kepada user
        $user->assignRole('admin');

        // Redirect atau tampilkan pesan sukses
        return redirect()->route('pengelola-admin')->with('success', 'Pembuatan akun Admin berhasil.');
        // return view('pengelola_profil.add-admin');
    }

    public function edit_admin($id)
    {
        $user = User::findOrFail($id);
        return view('pengelola_profil.edit-admin', compact('user'));
    }

    public function update_admin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->is_approved = true;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('pengelola-admin')->with('success', 'Akun Admin berhasil diedit.');
    }

    public function destroy_admin(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('pengelola-admin')->with('success', 'Akun Admin berhasil dihapus.');
    }

    public function show_detail($id)
    {
        $user = User::findOrFail($id);
        return view('pengelola_profil.detail-User', compact('user'));

    }

    //aproval

    public function show_ApprovalPage()
    {
        // Debugging statement
        $users = User::role('relawan')->where('is_approved', false)->get();
        dd($users);

        return view('pengelolaProfil.approval_relawan', compact('users'));
    }

    // public function approveUser(User $user)
    // {
    //     $user->update(['is_approved' => true]);

    //     // Optional: Memberikan notifikasi atau pesan sukses
    //     return redirect()->back()->with('success', 'User telah berhasil disetujui.');
    // }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_approved' => true]);

        // Optional: Memberikan notifikasi atau pesan sukses
        Mail::to($user->email)->send(new UserApproved($user));
        return redirect()->back()->with('success', 'Relawan telah berhasil disetujui.');
    }

}
