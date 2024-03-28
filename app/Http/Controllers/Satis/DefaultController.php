<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultController extends Controller
{
    public function index()
    {
        $bugununTarihi = now()->startOfDay();
        $randevular = Customer::whereDate('customer_meet',$bugununTarihi)->get();
        $gecmisRandevular = Customer::where('customer_meet', '<', $bugununTarihi)
            ->whereDate('customer_meet', '!=', $bugununTarihi)
            ->get();

        if($randevular->isNotEmpty()) {
            return view('backend.satis.default.index', compact('randevular','gecmisRandevular'));
        }

        return view('backend.satis.default.index', compact('randevular','gecmisRandevular'));
    }

    public function login()
    {
        return view('backend.satis.default.login');
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
            return redirect()->intended(route('default.Index'));
        } else {
            return back()->with('error', 'Hatalı Giriş');
        }
    }


    public function getCustomersForDate(Request $request)
    {
        $date = $request->input('date');
//        $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');
        $customers = Customer::where('customer_meet', $date)->get();

        return response()->json($customers);
    }

}
