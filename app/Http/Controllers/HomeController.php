<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
class HomeController extends BaseController{

    //Funzioni di registrazione
    public function home(){
        if(!Session::get('user_id')){
            return redirect('login');
        }

        //Leggo nome,cognome, e username
        $user = User::find(Session::get('user_id'));
        return view('home')->with("user",$user);

    }
}

