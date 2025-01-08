<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class BackController extends Controller
{
    protected $users;

    public function __construct()
    {
        $this->users = session('data_login');
    }

    public function login()
    {
        $users = session('data_login');
        if ($users) {
            return redirect()->route('home');
        }
        return view('login');
    }

    public function ubah_password(Request $request)
    {
        $users = session('data_login');
        $login_password_1 = $request->login_password_1;
        $login_password_2 = $request->login_password_2;
        if ($login_password_1 === $login_password_2) {
            $login_password_baru = Hash::make($login_password_1, [
                'rounds' => 12,
            ]);
            $login = Login::find($users->id);
            $login->update([
                'login_password' => $login_password_baru,
                'updated_at' => now()
            ]);
            return redirect()->route('home')->with('status', 'Berhasil mengubah password Akun.');
        } else {
            return redirect()->route('home')->with('status', 'Gagal Mengganti Password.');
        }
    }

    public function logout(Request $request)
    {
        $users = session('data_login');
        $request->session()->forget(['data_login']);
        $request->session()->flush();
        return redirect()->route('login')->with('status', 'Anda telah logout!');
    }

    public function post_login(Request $request)
    {
        $data_login = Login::where('login_username', $request->login_username)->first();
        if (!$data_login) {
            return back()->with('status', 'Maaf, username tidak terdaftar')->withInput();
        }
        $login_request = $request->login_req;
        if ($data_login) {
            $cek_password = Hash::check($request->login_password, $data_login->login_password);
            if ($cek_password === true) {
                $users = session(['data_login' => $data_login]);
                switch ($login_request) {
                    case 'Dashboard':
                        return redirect()->route('home')->with('status', 'Berhasil Login!');
                        break;
                    case 'File':
                        return redirect()->route('files')->with('status', 'Berhasil Login!');
                        break;
                }
            } elseif ($cek_password !== true) {
                return back()->with('status', 'Maaf username atau password salah!')->withInput();
            } else {
                return back()->with('status', 'Maaf username atau password salah!')->withInput();
            }
        }
        return back()->with('status', 'Maaf username atau password salah!')->withInput();
    }

    public function post_register(Request $request)
    {
        $login = Login::where("login_username", $request->login_username)->first();
        if ($login != null) {
            return back()->with('status', 'Maaf username yang anda masukkan sudah terdaftar')->withInput();
        }
        $validatedLogin = $request->validate([
            'login_nama' => 'required',
            'login_username' => 'required',
            'login_password' => 'required',
            'login_email' => 'required',
        ]);
        if ($validatedLogin["login_password"] !== $request->login_password2) {
            return back()->with('status', 'Password harus sama.')->withInput();
        }
        $hashPassword = Hash::make($validatedLogin["login_password"], [
            'rounds' => 12,
        ]);
        $token_raw = Str::random(16);
        $token = Hash::make($token_raw, [
            'rounds' => 12,
        ]);
        $level = "user";
        $login_status = "verified";
        $login_data = new Login;
        $save_login = $login_data->create([
            'login_nama' => $validatedLogin["login_nama"],
            'login_username' => $validatedLogin["login_username"],
            'login_password' => $hashPassword,
            'login_email' => $validatedLogin["login_email"],
            'login_telepon' => $request->login_telepon,
            'login_token' => $token,
            'login_level' => $level,
            'login_status' => $login_status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $save_login->save();

        $data = new Data;
        $save_data = $data->create([
            "data_nama" => $validatedLogin["login_nama"],
            "data_telepon" => $request->login_telepon,
            "data_jeniskelamin" => "L",
            "data_kode" => strtoupper(Str::random(8)),
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        $save_data->save();
        $save_data->login()->associate($save_login->id);
        $save_data->save();

        return redirect()->route('login-client')->with('status', 'Berhasil melakukan registrasi!');
    }

    public function register()
    {
        return view('register');
    }
}
