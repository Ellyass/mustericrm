<?php

namespace App\Http\Controllers\Onarim;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index(){
        return view('backend-repair.onarim.default.index');
    }

    public function login()
    {
        return view('backend-repair.onarim.default.login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('default.login.Login'))->with('success', 'Güvenli Çıkış Başarılı');
    }

    public function authenticate(Request $request)
    {

        $request->flash();


        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember_me') ? true : false;


        if (Auth::attempt($credentials, $remember_me)) {
            return redirect()->intended(route('onarim.default.Index'));
        } else {
            return back()->with('error', 'Hatalı Giriş');
        }
    }
}
