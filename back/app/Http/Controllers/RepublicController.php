<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Republic;
use App\User;
use App\Http\Requests\RepublicRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Resources\Republics as RepublicResource;
use Illuminate\Support\Facades\Storage;
use DB;

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
        $republic = Republic::find($id);

        if($republic->photo)
            Storage::delete($republic->photo);

        Republic::destroy($republic->id);
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

    public function searchRepublic(Request $request) {
        $query = Republic::query();
    // Filtrando repúblicas com preço até o valor digitado
        if ($request->price)
            $query->where('price','<=',$request->price);
    // Filtrando repúblicas localizadas na cidade procurada
        if ($request->city)
            $query->where('city','LIKE','%'.$request->city.'%');
    // Filtrando repúblicas com residentes
        if ($request->locatarios)
            $query->has('userLocatario', '>=', 1);

    // Paginação e resource
        $search = $query->paginate(3);
        $republic = RepublicResource::collection($search);

        return response()->json([
            'data' => $republic,
            'current_page' => $search->currentPage(),
            'last_page' => $search->lastPage()
        ]);
    }

    public function deletedRepublics(){
        $result = Republic::onlyTrashed()->get();
        return response()->json($result);
    }
}
