<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function createUser(UserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tel_num = $request->tel_num;
        $user->birth_date = $request->birth_date;
        $user->is_locator = $request->is_locator;
        $user->save();
        return response()->json($user);
    }

    public function showUser($id){
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function listUsers(){
        $user = User::all();
        return response()->json([$user]);
    }

    public function updateUser(Request $request, $id){
        $user = User::findOrFail($id);

        if($request->name)
            $user->name = $request->name;


        if($request->locator)
            $user->locator = $request->locator;
        // Um usuário locatário pode virar locador, mas a operação é irreversível

        $user->save();
        return response()->json($user);
    }
}
