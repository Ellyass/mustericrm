<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\CallExplanation;
use App\Models\City;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    public function index()
    {
        $authUserId = Auth::user();
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        if ($authUserId->role == 'admin') {
            $data['customer'] = Customer::where('customer_status', 1)
                ->orderBy('id', 'desc')
                ->paginate($pageSize);
        } else {
            // Admin değilse, sadece kendi eklediği müşterileri getir
            $data['customer'] = Customer::where('added_by_user_id', $authUserId->id)
                ->where('customer_status', 1)
                ->orderBy('id', 'desc')
                ->paginate($pageSize);
        }


        return view('backend.satis.customer.index', compact('data'));
    }


    public function create()
    {
        $cities = City::all();
        $status = Customer::all();
        $product = Product::all();
        $data['cities'] = $cities;

        return view('backend.satis.customer.create', compact('data', 'status', 'product'));
    }


    public function show($id)
    {
        //
    }


    public function store(Request $request)
    {
        $user = auth()->user();
        $customer = Customer::insert(
            [
                "customer_name" => $request->customer_name,
                "customer_city" => $request->customer_city,
                "customer_mail" => $request->customer_mail,
                "customer_company_name" => $request->customer_company_name,
                "customer_official" => $request->customer_official,
                "customer_phone" => $request->customer_phone,
                "customer_phone_home" => $request->customer_phone_home,
                "customer_address" => $request->customer_address,
                "customer_url" => $request->customer_url,
                "customer_status" => $request->customer_status,
                "customer_cancel" => $request->customer_cancel_tx,
                "customer_meet" => $request->customer_meet_dt,
                "added_by_user_id" => $user->id,
                "created_at" => Carbon::now('Europe/Istanbul'),
            ]
        );

        if ($customer) {
            return redirect(route('customer.Index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function edit($id)
    {
        $customer = Customer::where('id', $id)->first();
        $musteriler = Customer::all();
        $cities = City::all();
        $product = Product::all();
        $pro = Product::all();
        $sales = Sales::all();
        $callExplanation = CallExplanation::orderBy('id','desc')->where('customer_id', $id)->get();

        return view('backend.satis.customer.edit')
            ->with('customer', $customer)
            ->with('call', $callExplanation)
            ->with('cities', $cities)
            ->with('product', $product)
            ->with('sales', $sales)
            ->with('pro', $pro)
            ->with('customer_id', $musteriler);

    }


    public function update(Request $request, $id)
    {

        $customer = Customer::find($id);

        if (!$customer) {
            return back()->with('error', 'Müşteri bulunamadı');
        }

        $customer->update([
            "customer_name" => $request->customer_name,
            "customer_city" => $request->customer_city,
            "customer_mail" => $request->customer_mail,
            "customer_company_name" => $request->customer_company_name,
            "customer_official" => $request->customer_official,
            "customer_phone" => $request->customer_phone,
            "customer_phone_home" => $request->customer_phone_home,
            "customer_address" => $request->customer_address,
            "customer_url" => $request->customer_url,
            "customer_status" => $request->customer_status,
            "customer_meet" => $request->customer_meet_dt,
            "customer_cancel" => $request->customer_cancel_tx,
        ]);

        if ($request->customer_status == '1') {
            $customer->update(['customer_meet' => null]);
        }
        elseif ($request->customer_status == '2') {
            $customer->update(['customer_meet' => null]);
        }
        elseif ($request->customer_status == '3') {
            $customer->update(['customer_meet' => null]);
        }
        elseif ($request->customer_status == '4') {
            $customer->update(['customer_cancel' => null]);
        }

        $customer->save();

        if ($customer) {
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $customer = Customer::find(intval($value));
            $customer->id = intval($key);
            $customer->save();
        }

        echo true;
    }


    public function callExplanation(Request $request)
    {

        $request->validate([
            'customer_id' => 'required|integer',
            'call_explanation' => 'nullable|string',
        ]);


        $calls = CallExplanation::create([
            'customer_id' => $request->customer_id,
            'call_explanation' => isset($request->call_explanation) ? $request->call_explanation : ' '
        ]);
        $id = $request->customer_id;

        return redirect(route('customer.Edit', ['id' => $id]))->with('success','İşlem Başarılı');
    }


    public function destroy($id)
    {
        $post = Customer::find($id);

        if (!$post) {
            return redirect()->route('customer.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('customer.Index')->with('success', 'Kayıt başarıyla silindi.');
    }


    public function stor(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_buy' => 'required',
            'product_sell' => 'required',
            'product_second_sell' => 'nullable|numeric',
        ]);


        $product = Product::insert(
            [
                "product_name" => $request->product_name,
                "product_buy" => $request->product_buy,
                "product_sell" => $request->product_sell,
                "product_second_sell" => $request->product_second_sell,
            ]
        );

        if ($product) {
            return redirect(route('product.Index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function sales(Request $request)
    {
        try {
            $customerId = $request->input('customer_id');
            $productId = $request->input('product_name');
            $salesBuy = $request->input('sales_buy');
            $salesSell = $request->input('sales_sell');
            $salesSecondSell = $request->input('sales_second_sell');

            $product = Product::find($productId);

            if (!$product) {
                return redirect()->back()->with('error', 'Ürün bulunamadı.');
            }


            if ($salesSecondSell) {
                Sales::create([
                    'customer_id' => $customerId,
                    'product_id' => $productId,
                    'sales_buy' => $salesBuy,
                    'sales_second_sell' => $salesSecondSell,
                ]);
            } else {
                Sales::create([
                    'customer_id' => $customerId,
                    'product_id' => $productId,
                    'sales_buy' => $salesBuy,
                    'sales_sell' => $salesSell,
                ]);
            }
            return redirect()->back()->with('success', 'Satış başarıyla kaydedildi.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('fail', 'Satış yok');
        }


    }


    public function getTodayAppointments()
    {
        $todayAppointments = Customer::whereDate('customer_id', now()->toDateString())->get();
        return response()->json($todayAppointments);
    }



    public function tumu()
    {
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        $data['customer'] = Customer::orderBy('id','desc')->paginate($pageSize);
        return view('backend.satis.customer.index', compact('data'));
    }


    public function new()
    {
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        $data['customer'] = Customer::where('customer_status', 1)->paginate($pageSize);
        return view('backend.satis.customer.index', compact('data'));
    }


    public function acceptance()
    {
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        $data['customer'] = Customer::where('customer_status', 2)->paginate($pageSize);
        return view('backend.satis.customer.index', compact('data'));
    }


    public function rejection()
    {
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        $data['customer'] = Customer::where('customer_status', 3)->paginate($pageSize);
        return view('backend.satis.customer.index', compact('data'));
    }


    public function appointment()
    {
        $pageSize = session('page_size', 15);

        // İstekte yeni bir sayfa boyutu belirtilmişse, oturumu güncelle
        if (request()->has('page_size')) {
            $pageSize = request('page_size');
            session(['page_size' => $pageSize]);
        }

        $data['customer'] = Customer::where('customer_status', 4)->paginate($pageSize);
        return view('backend.satis.customer.index', compact('data'));
    }

    public function import()
    {
        return view('backend.satis.customer.import');
    }

    public function importStore(Request $request)
    {
        if (strtolower($request->file->getClientOriginalExtension()) == "xls") {
            $excel = \Shuchkin\SimpleXLSX::parse($request->file);
        } elseif (strtolower($request->file->getClientOriginalExtension()) == "xlsx") {
            $excel = \Shuchkin\SimpleXLSX::parse($request->file);
        }
        $xls = $excel->rows();
        unset($xls[0]);
        foreach (array_values($xls) as $user){

            $customer_company_name = trim($user[1]) !== '' ? $user[1] : null;
            $customer_official = trim($user[2]) !== '' ? $user[2] : null;
            $customer_mail = trim($user[3]) !== '' ? $user[3] : null;
            $customer_address = trim($user[5]) !== '' ? $user[5] : null;
            $customer_phone_home = trim($user[7]) !== '' ? $user[7] : null;
            $customer_url = trim($user[8]) !== '' ? $user[8] : null;

            $userData = [
                'customer_name' => $user[0],
                'customer_company_name' => $customer_company_name,
                'customer_official' => $customer_official,
                'customer_mail' => $customer_mail,
                'customer_city' => $user[4],
                'customer_address' =>  $customer_address,
                'customer_phone' => $user[6],
                'customer_phone_home' => $customer_phone_home,
                'customer_url' => $customer_url,
            ];

            $userData['added_by_user_id'] = Auth::user()->id;
            $userData['customer_status'] = 1;

            Customer::create($userData);
        }

        return redirect('customer/home')->with('success', 'Tablo başarıyla Yüklendi.');
    }
}
