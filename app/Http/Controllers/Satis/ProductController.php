<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data['product'] = Product::paginate(5);
        return view('backend.satis.product.index', compact('data'));
    }


    public function create(){
        $data['product'] = Product::all();
        return view('backend.satis.product.create',compact('data'));
    }


    public function store(Request $request)
    {
        if ($request->hasFile('product_file')) {
            $request->validate([
                'product_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'product_name' => 'required',
                'product_buy' => 'required',
                'product_sell' => 'required',
                'product_second_sell' => 'required|nullable',
                'product_description' => 'required',
                "created_at" => Carbon::now('Europe/Istanbul'),
            ]);

            $file_name = uniqid() . '.' . $request->product_file->getClientOriginalExtension();
            $request->product_file->move(public_path('storage/images/products'), $file_name);
        } else {
            $file_name = null;
        }


        $product = Product::insert(
            [
                "product_name" => $request->product_name,
                "product_buy" => $request->product_buy,
                "product_sell" => $request->product_sell,
                "product_second_sell" => $request->product_second_sell,
                "product_file" => $file_name,
                "product_description" => $request->product_description,
                "created_at" => Carbon::now('Europe/Istanbul'),
            ]
        );

        if ($product) {
            return redirect(route('product.Index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function edit($id){

        $product = Product::where('id', $id)->first();
        return view('backend.satis.product.edit')->with('product',$product);
    }


    public function update(Request $request, $id) {

        $request->validate([
            'product_buy' => 'required',
            'product_sell' => 'required',
            'product_second_sell' => 'required',
        ]);


        $product = Product::find($id);

        if ($request->hasFile('product_file')) {
            $request->validate([
                'product_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name = uniqid() . '.' . $request->product_file->getClientOriginalExtension();
            $request->product_file->move(public_path('storage/images/products'), $file_name);

            $path = 'storage/images/products/' . $product->product_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }

            $product->product_name = $request->product_name;
            $product->product_buy = $request->product_buy;
            $product->product_sell = $request->product_sell;
            $product->product_second_sell = $request->product_second_sell;
            $product->product_description = $request->product_description;
            $product->product_file = $file_name;

            $product->save();

        } else {
            $product->update([
                "product_name" => $request->product_name,
                "product_buy" => $request->product_buy,
                "product_sell" => $request->product_sell,
                "product_second_sell" => $request->product_second_sell,
                "product_description" => $request->product_description,
            ]);
        }

        return redirect()->route('product.Index')->with('success', 'İşlem Başarılı');
    }


    public function destroy($id)
    {
        $post = Product::find($id);

        if (!$post) {
            return redirect()->route('product.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('product.Index')->with('success', 'Kayıt başarıyla silindi.');
    }


}
