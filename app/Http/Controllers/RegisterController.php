<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
class RegisterController extends BaseController{

    //Funzioni di registrazione
    public function register_form(){
        if(Session::get('user_id')){
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('register')->with('error', $error);

    }


    public function do_register(){
        if(Session::get('user_id')){
            return redirect('home');
        }

        //Validazione dei dati

        if(strlen(request('Nome')) == 0 || strlen(request('Cognome')) == 0 || strlen(request('Username')) == 0
        || strlen(request('Password')) == 0 || strlen(request('cPassword')) == 0 || strlen(request('Email')) == 0 || strlen(request('Genere')) == 0)
        {
            Session::put('error', 'empty_fields');
            return redirect('register')->withInput();
        }
        else if(request('Password') != request('cPassword')){
            Session::put('error', 'bad_passwords');
            return redirect('register')->withInput();
        }
        else if(User::where('username', request('Username'))->first()){
            Session::put('error', 'existing_username');
            return redirect('register')->withInput();
        }
        else if(User::where('email', request('Email'))->first()){
            Session::put('error', 'existing_email');
            return redirect('register')->withInput();
        }

            

        //Creazione utente


        $user = new User;
        $user->nome = request('Nome');
        $user->cognome = request('Cognome');
        $user->username = request('Username');
        $user->password = password_hash(request('Password'), PASSWORD_BCRYPT);
        $user->email = request('Email');
        $user->gender = request('Genere');
        $data_registrazione = date("d-m-Y");
        $user->data_registrazione = $data_registrazione;
        $user->save();
        //Login

        Session::put('user_id', $user->id);

        //Redirect alla home

        return redirect('home');
    }

    public function checkUsername($query) {
        $exist = User::where('username', $query)->exists();
        return ['exists' => $exist];
    }

    public function checkEmail($query) {
        $exist = User::where('email', $query)->exists();
        return ['exists' => $exist];
    }



    public function logout()
    {
        //Elimina i dati della sessione
        Session::flush();
        return redirect('login');
    }

    //Funzioni di login

    public function login_form(){
        if(Session::get('user_id')){
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('login')->with('error', $error);

    }

    public function do_login(){
        if(Session::get('user_id')){
            return redirect('home');
        }

        //Validazione dei dati

        if(strlen(request('username')) == 0 || strlen(request('password')) == 0)
        {
            Session::put('error', 'empty_fields');
            return redirect('login')->withInput();
        }

        $user = User::where('username', request('username'))->first();
        if(!$user || !password_verify(request('password'), $user->password)){
            Session::put('error', 'wrong_credentials');
            return redirect('login')->withInput();
        }

        Session::put('user_id', $user->id);

        //Redirect alla home
        
        return redirect('home');
    }

}