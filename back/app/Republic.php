<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\RepublicRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use User;

class Republic extends Model
{
    //use SoftDeletes;

    public function userLocatario(){
        return $this->hasOne('App\User');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function userFavoritas(){
        return $this->belongsToMany('App\User');
    }

    public function createRepublic(RepublicRequest $request){
        $this->name = $request->name;
        $this->street = $request->street;
        $this->number = $request->number;
        $this->complement = $request->complement;
        $this->district = $request->district;
        $this->city = $request->city;
        $this->state = $request->state;
        $this->cep = $request->cep;
        $this->price = $request->price;
        $this->description = $request->description;

        if (!Storage::exists('localPhotos/'))
            Storage::makeDirectory('localPhotos/', 0755, true);

        /*$file = $request->file('photo');
        $filename=rand().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('localphotos', $filename);*/

        $image=base64_decode($request->photo);
        $filename=uniqid();
        $path=storage_path('/app/localPhotos/'.$filename);
        file_put_contents($path, $image);
        $this->photo=$path;

        $this->save();
    }

    public function updateRepublic(RepublicRequest $request){
        if($request->name)
            $this->name = $request->name;
        if($request->street)
            $this->street = $request->street;
        if($request->number)
            $this->number = $request->number;
        if($request->complement)
            $this->complement = $request->complement;
        if($request->district)
            $this->district = $request->district;
        if($request->city)
            $this->city = $request->city;
        if($request->state)
            $this->state = $request->state;
        if($request->cep)
            $this->cep = $request->cep;
        if($request->price)
            $this->price = $request->price;
        if($request->description)
            $this->description = $request->description;

        $this->save();
    }

    public function deleteThis(){
        if($this->photo;){}
            //unlink($photo);
        $this->delete();
        //Republic::destroy($id);
    }

    public function anunciar($user_id){
        $user = User::findOrFail($user_id);
        $this->user_id = $user_id;
        $this->save();
    }

}


