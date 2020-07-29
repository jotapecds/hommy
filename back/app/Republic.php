<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\RepublicRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use User;

class Republic extends Model
{
    use SoftDeletes;

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
        $this->save();
    }

    public function anunciar($user_id){
        $user = User::findOrFail($user_id);
        $this->user_id = $user_id;
        $this->save();
    }

}


