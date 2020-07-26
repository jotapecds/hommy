<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;

class RepublicController extends Controller
{
    public function createRepublic(Request $request){

        $republic = new Republic;
        $republic->name = $request->name;
        $republic->street = $request->street;
        $republic->number = $request->number;
        $republic->complement = $request->complement;
        $republic->district = $request->district;
        $republic->city = $request->city;
        $republic->state = $request->state;
        $republic->cep = $request->cep;
        $republic->price = $request->price;
        $republic->description = $request->description;

        $republic->save();
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
}
