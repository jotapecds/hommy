<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use App\Http\Requests\RepublicRequest;

class RepublicController extends Controller
{
    public function createRepublic(RepublicRequest $request){
        $republic = new Republic;
        $republic->createRepublic($request);
        return response()->json($republic);
    }

    public function showRepublic($id){
        $republic = Republic::findOrFail($id);
        return response()->json($republic);
    }

    public function listRepublics(){
        $republic = Republic::all();
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

    public function addAnnounce($republic_id, $locator_id){
        $locator = User::findOrFail($locator_id);
        $republic = Republic::findOrFail($republic_id);
        $republic->locator_id = $locator_id;
        $republic->save();
        return response()->json($republic);
    }

    public function removeAnnounce($republic_id){
        $republic = Republic::findOrFail($republic_id);
        $republic->locator_id = NULL;
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
