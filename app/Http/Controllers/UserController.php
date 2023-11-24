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
            "list_users" => User::where(['is_deleted' => 0])->get(),
            "list_roles" => Role::all()
        ];

        return view('pages/user/index', $data);
    }

    public function show($id)
    {
        $user = User::with('role')->where(['id' => $id, 'is_deleted' => 0])->first();

        return response()->json(['message' => 'success', 'data' => $user]);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "username" => "required|string|max:255",
            "phone" => "max:14",
            "role_id" => "required"
        ]);

        $is_username_exist = User::where(['username' => $request->username, 'is_deleted' => 0])->first();
 
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

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "username" => "required|string|max:255",
            "phone" => "max:14",
            "role_id" => "required"
        ]);

        $user_obj = [
            "role_id" => $request->role_id,
            "name" => $request->name,
            "username" => $request->username,
            "phone" => $request->phone,
            "address" => $request->address,
        ];

        $updated_user = User::find($request->id)->update($user_obj);

        if($updated_user){
            return response()->json(['message' => 'success', 'data' => $user_obj]);
        }
    }

    public function delete(Request $request)
    {
        //soft delete
        $deleted_user = User::find($request->id)->update(['is_deleted' => 0]);

        if($deleted_user){
            return response()->json(['message' => 'success']);
        }
    }
}
