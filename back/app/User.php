<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\UserRequest;
use Laravel\Passport\HasApiTokens;
use Republic;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function republic(){
        return $this->hasOne('App\Republic');
    }

    public function republics() {
        return $this->belongsTo('App\Republic');
    }

    public function favoritas(){
        return $this->belongsToMany('App\Republic');
    }

    public function alugar($republic_id){
        $republic = Republic::findOrFail($republic_id);
        $this->republic_id = $republic_id;
        $this->save();
    }

    public function createUser(UserRequest $request){
        $this->name = $request->name;
        $this->email = $request->email;
        $this->password = bcrypt($request->password);
        $this->tel_num = $request->tel_num;
        $this->birth_date = $request->birth_date;
        $this->is_locator = $request->is_locator;
        $this->save();
    }

    public function updateUser(UserRequest $request){
        if($request->name)
            $this->name = $request->name;
        if($request->locator)
            $this->locator = $request->locator;
        // Um usuário locatário pode virar locador, mas a operação é irreversível

        $this->save();
    }
}
