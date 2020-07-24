<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;

class RepublicController extends Controller
{
    public function createRepublic(Request $request){
        $republic = new Republic;
        $republic->street = $request->street;
        $republic->number = $request->number;
        $republic->complement = $request->complement;
        $republic->district = $request->district;
        $republic->city = $request->city;
        $republic->state = $request->state;
        $republic->description = $request->description;
        $republic->price = $request->price;
        $republic->available_vacancies = $request->available_vacancies;

        $republic->save();
        return response()->json($republic);
    }

    public function showRepublic($id){
        $republic = Republic::findOrFail($id);
        return response()->json($republic);
    }

    public function listRepublic(){
        $republic = Republic::all();
        return response()->json([$republic]);
    }

    public function updateRepublic(Request $request, $id){
        $republic = Republic::findOrFail($id);

        if($request->street)
            $republic->street = $request->street;
        
        if($request->number)
            $republic->number = $request->number;
        
        if($request->complement)
            $republic->complement = $request->complement;
        
        if($request->neighborhood)
            $republic->neighborhood = $request->neighborhood;
        
        if($request->city)
            $republic->city = $request->city;
        
        if($request->state)
            $republic->state = $request->state;
        
        $republic->save();
        return response()->json($republic);
    }

    public function deleteRepublic($id){
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

    public function removeAnnounce($republic_id, $locator_id){
        $locator = User::findOrFail($locator_id);
        $republic = Republic::findOrFail($republic_id);
        $republic->locator_id = NULL;
        $republic->save();
        return response()->json($republic);
    }

}