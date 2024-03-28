<?php

namespace App\Http\Controllers\Satis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::orderBy('id', 'desc')->get();
        return view('backend.satis.user.index', compact('data'));
    }


    public function create(){
        $data['users'] = User::all();
        return view('backend.satis.user.create',compact('data'));
    }


    public function store(Request $request)
    {
        if ($request->hasFile('user_file')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|Min:6',
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'role' => 'required',
                "created_at" => Carbon::now('Europe/Istanbul'),
            ]);

            $file_name = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('storage/images/users'), $file_name);
        } else {
            $file_name = null;
        }


        $users = User::insert(
            [
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "user_file" => $file_name,//İşlem
                'role' => $request->role,
                "created_at" => Carbon::now('Europe/Istanbul'),
            ]
        );

        if ($users) {
            return redirect(route('user.Index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function edit($id){
        $user = User::where('id', $id)->first();

        return view('backend.satis.user.edit')->with('user',$user);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);


        if ($request->hasFile('user_file')) {
            $request->validate([
                'user_file' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $file_name = uniqid() . '.' . $request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('storage/images/users'), $file_name);


            if (strlen($request->password) > 0) {

                $request->validate([
                    'password' => 'required|Min:6'
                ]);

                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_file" => $file_name,//İşlem
                        "password" => Hash::make($request->password),
                        "role" => $request->role,
                    ]
                );
            } else {
                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "user_file" => $file_name,//İşlem
                        "role" => $request->role,
                    ]
                );
            }


            $path = '/storage/images/users/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }

        } else {

            if (strlen($request->password) > 0) {

                $request->validate([
                    'password' => 'required|Min:6'
                ]);

                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "password" => Hash::make($request->password),
                        "role" => $request->role,
                    ]
                );

            } else {

                $user = User::Where('id', $id)->update(
                    [
                        "name" => $request->name,
                        "email" => $request->email,
                        "role" => $request->role,
                    ]
                );

            }
        }
        if ($user) {
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function destroy($id)
    {
        $post = User::find($id);

        if (!$post) {
            return redirect()->route('user.Index')->with('error', 'Kayıt bulunamadı.');
        }

        $post->delete();

        return redirect()->route('user.Index')->with('success', 'Kayıt başarıyla silindi.');
    }

}
