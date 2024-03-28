<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Meet;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $today = Carbon::today();
        $data['customers'] = Customer::where('customer_status', 4)
            ->orderBy('id', 'desc')
            ->paginate(15);
//            ->whereDate('customer_meet', $today)


        return view('backend.satis.meet.index', compact('data',));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('backend.satis.meet.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $meet = Meet::create([
            'customer_id' => $request->customer_id,
            'customer_meet' => $request->customer_meet_dt
        ]);

        if ($meet) {
            return redirect()->route('customer.Index')->with('success', 'İşlem Başarılı');
        }

        return back()->with('error', 'İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Customer::find($id);

        if (!$post) {
            return redirect()->route('meet.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('meet.Index')->with('success', 'Kayıt başarıyla silindi.');
    }

    public function date(Request $request)
    {
        $baslangicTarihi = $request->input('baslangicTarihi');
        $bitisTarihi = $request->input('bitisTarihi');


        if (!empty($baslangicTarihi) && !empty($bitisTarihi)) {
            $data['customers'] = Customer::where('customer_status', 4)
                ->where('customer_meet', '>=', $baslangicTarihi)
                ->where('customer_meet', '<=', $bitisTarihi)
                ->orderBy('id','desc')
                ->paginate(15);

        } else {
            $data['customers'] = Customer::where('customer_status', 4)
                ->get();
        }

        return view('backend.satis.meet.index', compact('data'));
    }
}
