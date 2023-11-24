<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            "page_name" => "User",
            "sub_page_name" => "",
            "list_users" => User::all(),
            "list_roles" => Role::all()
        ];

        return view('pages/user/index', $data);
    }

    public function show($id)
    {
        $user = User::with('role')->get()->find($id);

        return response()->json(['message' => 'success', 'data' => $user]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "username" => "required",
            "role_id" => "required"
        ]);

        $is_username_exist = User::where('username', $request->username)->first();

        if($is_username_exist){
            return response()->json(['message' => 'error', 'text' => 'Username telah terdaftar!']);
        }

        $get_role_name = Role::find($request->role_id)->name;
        $get_role_name = explode(' ', $get_role_name);
        $get_role_name = strtolower($get_role_name[0]);

        $user_obj = [
            "id" => (string) Str::uuid(),
            "role_id" => $request->role_id,
            "name" => $request->name,
            "username" => $request->username,
            "phone" => $request->phone,
            "address" => $request->address,
            "role_id" => $request->role_id,
            "password" => Hash::make($get_role_name . '123456'),
        ];

        $new_user = User::create($user_obj);

        if($new_user->exists){
            return response()->json(['message' => 'success']);
        }
    }
}
