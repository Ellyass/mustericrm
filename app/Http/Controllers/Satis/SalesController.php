<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customer'] = Customer::orderBy('id', 'desc')->where('customer_status',2)->get();
        return view('backend.satis.sales.index', compact('data'));
    }

    public function product($id)
    {
        $product = Product::where('product_id',$id);
        return $this->belongsTo(Product::class, 'product');
    }

    public function calculateEarnings($id)
    {
        $sales = Sales::find($id);
        $earnings = $sales->calculateEarnings();

        return view('sales.calculate', ['earnings' => $earnings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pro = Product::all();
        return view('backend.satis.sales.create',compact('pro'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = Sales::insert(
            [
                "sales_buy" => $request->sales_buy,
                "sales_sell" => $request->sales_sell,
                "sales_second_sell" => $request->sales_second_sell,
            ]
        );

        if ($sales) {
            return redirect(route('sales.Index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Customer::find($id);

        if (!$post) {
            return redirect()->route('sales.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('sales.Index')->with('success', 'Kayıt başarıyla silindi.');
    }
}
