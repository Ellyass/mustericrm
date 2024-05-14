<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search');
        $results = Customer::where('customer_name', 'LIKE', "%{$query}%")->get();

        return response()->json($results);
    }
}
