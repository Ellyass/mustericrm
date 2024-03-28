<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\Cancel;
use App\Models\Customer;
use Illuminate\Http\Request;

class CancelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['customers'] = Customer::orderBy('id', 'desc')->where('customer_status', 3)->paginate(10);
        return view('backend.satis.cancel.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cancel=Customer::all();
        return view('backend.satis.customer.create', compact('cancel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cancel = Customer::insert(
            [
                "customer_cancel" => $request->customer_cancel_tx,
            ]
        );

        if ($cancel) {
            return redirect(route('customer.Index'))->with('success', 'İşlem Başarılı');
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
        $cancel = Cancel::find($id);
        $customer = $cancel->customer;
        return view('cancel.show', compact('cancel', 'customer'));
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
            return redirect()->route('cancel.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('cancel.Index')->with('success', 'Kayıt başarıyla silindi.');
    }
}
