<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use App\Http\Requests\RepublicRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\Republics as RepublicResource;

class RepublicController extends Controller
{
    public function createRepublic(RepublicRequest $request){
        $republic = new Republic;
        $republic->createRepublic($request);
        return response()->json($republic);
    }

    public function updateRepublic(RepublicRequest $request, $id){
        $republic = Republic::findOrFail($id);
        $republic->updateRepublic($request);
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

    public function deleteRepublic($id){
        $republic = Republic::findOrFail($id);
        Republic::destroy($id);
        return response()->json(['Republica '. $republic->name .' deletada']);
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

    public function searchRepublic(Request $request) {
        $query = Republic::query();
        if ($request->price)
            $query->where('price','<=',$request->price);
        if ($request->city)
            $query->where('city','LIKE','%'.$request->city.'%');

        $search = $query->get();
        return response()->json($search);
    }

    public function deletedRepublics(){
        $result = Republic::onlyTrashed()->get();
        return response()->json($result);
    }
}
