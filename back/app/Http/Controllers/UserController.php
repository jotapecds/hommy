<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Republic;

class UserController extends Controller
{
    public function createUser(UserRequest $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'tel_num' => 'nullable|numeric|min:9',
            'birth_date' => 'required|date_format:d/m/Y',
            'is_locator' => 'boolean'
        ]);

        if($validator->fails())
            return response()->json($validator->errors());

        $user = new User;
        $user->createUser($request);
        return response()->json($user);
    }
    public function updateUser(UserRequest $request, $id){
        $user = User::findOrFail($id);
        $user->updateUser($request);
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
