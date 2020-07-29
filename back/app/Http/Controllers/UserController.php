<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Republic;

class UserController extends Controller
{
    /*public function createUser(UserRequest $request){
        $user = new User;
        $user->createUser($user);
        return response()->json($user);
    }*/
    public function createUser(UserRequest $request){
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->tel_num = $request->tel_num;
        $user->birth_date = $request->birth_date;
        $user->is_locator = $request->is_locator;
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

    public function alugar($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->alugar($republic_id);
        return response()->json($user);
    }

    public function anunciar($user_id, $republic_id){
        $republic = Republic::findOrFail($republic_id);
        $republic->anunciar($user_id);
        return response()->json($republic);
    }

    public function favoritar($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->favoritas()->attach($republic_id);
        return response()->json($user);
    }

    public function desfavoritar($user_id, $republic_id){
        $user = User::findOrFail($user_id);
        $user->favoritas()->detach($republic_id);
        return response()->json($user);
    }

}
