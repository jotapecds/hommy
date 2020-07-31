<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use App\Http\Requests\RepublicRequest;
use App\Http\Resources\Republics as RepublicResource;

class RepublicController extends Controller
{
    public function createRepublic(RepublicRequest $request){
        $republic = new Republic;
        $republic->createRepublic($request);
        return response()->json($republic);
    }

    public function showRepublic($id){
        $republic = Republic::findOrFail($id);
        return response()->json(new RepublicResource($republic));
    }

    public function listRepublics(){
        $republic = Republic::paginate(3);
        return response()->json([$republic]);
    }

    public function updateRepublic(Request $request, $id){
        $republic = Republic::findOrFail($id);

        if($request->name)
            $republic->name = $request->name;

        if($request->street)
            $republic->street = $request->street;

        if($request->number)
            $republic->number = $request->number;

        if($request->complement)
            $republic->complement = $request->complement;

        if($request->district)
            $republic->district = $request->district;

        if($request->city)
            $republic->city = $request->city;

        if($request->state)
            $republic->state = $request->state;

        if($request->cep)
            $republic->cep = $request->cep;

        if($request->price)
            $republic->price = $request->price;

        if($request->description)
            $republic->description = $request->description;

        $republic->save();
        return response()->json($republic);
    }

    public function deleteRepublic($id){
        $republic = Republic::findOrFail($id);
        Republic::destroy($id);
        return response()->json(['Republica deletada']);
    }

    public function addAnnounce($republic_id, $user_id){
        $locator = User::find($user_id);
        $republic = Republic::find($republic_id);
        return response()->json([$locator,$republic]);
        $republic->user_id = $locator->id;
        $republic->save();
        return response()->json($republic);
    }

    public function removeAnnounce($republic_id){
        $republic = Republic::findOrFail($republic_id);
        $republic->user_id = NULL;
        $republic->save();
        return response()->json($republic);
    }

    public function listLocatarios($id){
        $republic = Republic::findOrFail($id);
        $locatarios = $republic->userLocatario->get();
        return response()->json($locatarios);
    }

    public function showLocador($id){
        $republic = Republic::findOrFail($id);
        return response()->json($republic->user);
    }

}
