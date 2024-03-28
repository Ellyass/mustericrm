<?php

namespace App\Http\Controllers\Onarim;

use App\Http\Controllers\Controller;
use App\Models\RepairCallExplanation;
use App\Models\RepairCustomer;
use App\Models\RepairPiece;
use App\Models\RepairType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RepairCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = request()->has('page_size') ? request('page_size') : session('page_size', 15);

        if (request()->has('page_size')) {
            session(['page_size' => $pageSize]);
        }

        $repairCustomers = RepairCustomer::orderBy('id', 'desc')->paginate($pageSize);

        return view('backend-repair.onarim.repair-customer.index', compact('repairCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend-repair.onarim.repair-customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repairCustomers = RepairCustomer::create([
            'repair_customer_name' => $request->repair_customer_name,
            'repair_customer_phone' => $request->repair_customer_phone,
            'repair_customer_date' => $request->repair_customer_date,
        ]);
        if ($repairCustomers) {
            $repair_types = $request->choices;
            $repair_Pieces = $request->pieces;

            if (isset($repair_types) && count($repair_types) > 0) {
                foreach ($repair_types as $key => $repair_type) {
                    $repairs = RepairType::create([
                        'repair_customer_id' => $repairCustomers->id,
                        'type' => $repair_type,
                    ]);
                }

                if (isset($repair_Pieces) && count($repair_Pieces) > 0) {
                    foreach ($repair_Pieces as $key => $repair_Piece) {
                        $pieces = RepairPiece::create([
                            'repair_customer_id' => $repairCustomers->id,
                            'piece' => $repair_Piece,
                        ]);
                    }
                }

                if ($repairs) {
                    return redirect(route('onarim.repair.Index'))->with('success', 'İşlem Başarılı..');

                } else {
                    return back()->with('danger', 'İşlem başarısız.');
                }
            }
        } else {
            return back()->with('danger', 'İşlem başarısız.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repairCustomers = RepairCustomer::where('id', $id)->first();
        $repairExplanations = RepairCallExplanation::where('repair_customer_id', $id)->orderBy('id','desc')->get();

        return view('backend-repair.onarim.repair-customer.edit', compact('repairCustomers','repairExplanations'));
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
        $repairCustomer = RepairCustomer::find($id);

        if (!$repairCustomer) {
            return back()->with('error', 'Müşteri bulunamadı');
        }

        $repairCustomer->update([
            "repair_customer_name" => $request->repair_customer_name,
            "repair_customer_phone" => $request->repair_customer_phone,
            "repair_customer_date" => $request->repair_customer_date,
        ]);

        RepairType::where('repair_customer_id', $repairCustomer->id)->delete();
        RepairPiece::where('repair_customer_id', $repairCustomer->id)->delete();

        if ($repairCustomer) {
            $repair_types = $request->choices;
            $repair_Pieces = $request->pieces;

            foreach ($repair_types as $key => $repair_type) {
                RepairType::create([
                    'repair_customer_id' => $repairCustomer->id,
                    'type' => $repair_type,
                ]);
            }

            foreach ($repair_Pieces as $key => $repair_Piece) {
                RepairPiece::create([
                    'repair_customer_id' => $repairCustomer->id,
                    'piece' => $repair_Piece,
                ]);
            }
        }
        return redirect(route('onarim.repair.Index'))->with('success', 'işlem başarılı');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = RepairCustomer::find($id);

        if (!$post) {
            return redirect()->route('onarim.repair.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $delete = RepairType::where('repair_customer_id', $id)->delete();

        $post->delete();

        return redirect()->route('onarim.repair.Index')->with('success', 'Kayıt başarıyla silindi.');
    }



    public function call(Request $request)
    {
        $id = $request->repair_customer_id;

        $request->validate([
            'repair_customer_id' => 'required|integer',
            'repair_explanation' => 'required',
        ]);


        $repairExplanations = RepairCallExplanation::create([
            'repair_customer_id' => $request->repair_customer_id,
            'repair_explanation' => $request->repair_explanation,
            'created_at' => Carbon::now('Europe/Istanbul'),
        ]);


        return redirect(route('onarim.repair.Edit',['id' => $id]))->with('success','İşlem Başarılı');
    }
}
