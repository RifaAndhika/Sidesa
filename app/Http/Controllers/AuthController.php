<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Resident;

class AuthController extends Controller
{

    public function login(){
        if(Auth::check()){
            return back();
        }
        return view('pages.auth.login');
    }

    public function authenticate(Request $request)
    {
        if(Auth::check()){
            return back();
        }
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],

        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password harus diisi',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userStatus = Auth::user()->status;

            if ($userStatus == 'submitted'){
                $this->_logout($request);
                return back()->withErrors([
                            'email' => 'akun masih menunggu persetujuan admin']);

            } elseif ($userStatus == 'rejected'){
                $this->_logout($request);
                return back()->withErrors([
                            'email' => 'Akun anda telah ditolak admin']);

            }

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Terjadi kesalahan, periksa kembali email dan password anda.',
        ])->onlyInput('email');
    }


    public function registerView(){
        if(Auth::check()){
            return back();
        }
        return view('pages.auth.register');
    }


            public function register(Request $request)
        {
            $validated = $request->validate([
                // User
                'name' => ['required'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

                // KTP
                'ktp_file' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

                // Resident
                'nik' => ['required', 'digits:16'],
                'gender' => ['required', 'in:male,female'],
                'birth_place' => ['required'],
                'birth_date' => ['required', 'date', 'before_or_equal:today'],
                'address' => ['required'],
                'religion' => ['required', 'string', 'max:50'],
                'marital_status' => ['required', 'in:single,married,divorced,widowed'],
                'occupation' => ['nullable', 'string', 'max:100'],
                'phone' => ['required', 'string', 'max:15'],
            ], [
                // Custom error messages (optional)
                'name.required' => 'Nama wajib diisi',
                'nik.required' => 'NIK wajib diisi',
                'nik.digits' => 'NIK harus 16 digit',
                'email.required' => 'Email wajib diisi',
                'email.unique' => 'Email sudah terdaftar',
                'gender.required' => 'Jenis kelamin wajib diisi',
                'birth_place.required' => 'Tempat lahir wajib diisi',
                'birth_date.required' => 'Tanggal lahir wajib diisi',
                'birth_date.before_or_equal' => 'Tanggal lahir tidak valid.',
                'address.required' => 'Alamat wajib diisi',
                'marital_status.required' => 'Status perkawinan wajib diisi',
                'religion.required' => 'Agama wajib diisi',
                'phone.required' => 'Nomor telepon wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak sesuai',
                'ktp_file.required' => 'Foto KTP wajib diunggah',
            ]);

            // Simpan User
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role_id' => 2, // default: warga
            ]);

            // Upload file KTP
            $ktpPath = $request->file('ktp_file')->store('ktp', 'public');

            // Simpan ke Resident
            Resident::create([
                'user_id' => $user->id,
                'nik' => $validated['nik'],
                'gender' => $validated['gender'],
                'birth_place' => $validated['birth_place'],
                'birth_date' => $validated['birth_date'],
                'address' => $validated['address'],
                'religion' => $validated['religion'] ?? null,
                'marital_status' => $validated['marital_status'],
                'occupation' => $validated['occupation'] ?? null,
                'phone' => $validated['phone'] ?? null,
                'ktp_file' => $ktpPath,
            ]);

            return redirect('/login')->with('success', 'Berhasil mendaftar, menunggu persetujuan admin.');
        }



    public function _logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

    }
    public function logout(Request $request)

{
    if(!Auth::check()){
        return redirect('/');
    }

    $this->_logout($request);

    return redirect('/');
}
}
