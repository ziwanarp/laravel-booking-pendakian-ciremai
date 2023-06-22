<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use DateTime;

use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
            'captcha' => 'required|captcha'
        ]);

        $valid = [
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ];

        if (Auth::attempt($valid)) {

            // generate new last login berdasarkan auth id
            Auth::user()->last_login = new DateTime();
            User::where('id', Auth::user()->id)->update(['last_login' => Auth::user()->last_login]);

            if (auth()->user()->role == 'Admin') {
                Alert::success('Login Berhasil !', 'selamat datang di Dashboard ' . auth()->user()->name);
                return redirect()->intended('/dashboard');
            } else {
                Alert::success('Login Berhasil !', 'selamat datang ' . auth()->user()->name);
                return redirect()->intended('/');
            }
        }
        Alert::error('Gagal Login !!', 'Email / Password Salah !!!');
        return redirect('/');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:5',
            'email' => 'required|unique:users',
            'alamat' => 'required|min:5',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'jenis_identitas' => 'required',
            'no_identitas' => 'required|min:10',
            'no_hp' => 'required|min:10',
            'foto_identitas' => 'required|file|image|max:1024',
            'password' => 'required|min:5',
            'captcha' => 'required|captcha'
        ];

        $validatedData = $request->validate($rules);

        //simpan foto di storage
        $validatedData['foto_identitas'] = $request->file('foto_identitas')->store('user-fotoidentitas', 'public');

        //encrypt password
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        Alert::success('Registrasi Berhasil !', 'Silahkan login');
        return redirect('/');
    }

    public function logout(Request $request)
    {
        if (auth()->user() === null) {
            Alert::error('Anda Belum Login !!', '');
            return redirect('/');
        } else {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            Alert::success('Logout Berhasil !!', '');
            return redirect('/');
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('flat')]);
    }
}
