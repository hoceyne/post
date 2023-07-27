<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {

        $users = User::all();

        return $users;
    }

    public function show($id)
    {

        $user = User::with(["posts"])->find($id);
        if(!$user){
            abort(404);
        }
        return $user;
    }

    public function create(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }


    public function delete($id)
    {
        $user = User::find($id);
        if(!$user){
            abort(404);
        }
        $user->delete();
    }
}
