<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use App\Models\Post;
class CreateController extends BaseController{

    //Funzioni di registrazione
    public function index(){
        if(!Session::get('user_id')){
            return redirect('login');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('create')->with('error', $error);

    }



    public function do_create(){
        if(!Session::get('user_id')){
            return redirect('home');
        }
        //Controllo che i post rispettino delle regole di lunghezza
    if(strlen(request('Titolo')) < 4){

            Session::put('error', 'short_title');
            return redirect('create')->withInput();

        }
    if(strlen(request('Testo')) < 10){

            Session::put('error', 'short_text');
            return redirect('create')->withInput();

        }


    //Creazione del post
    
        $post = new Post;
        $post->testo = request('Testo');
        $post->titolo = request('Titolo');
        $user = User::find(Session::get('user_id'));
        $uid = $user->id;
        $post->userid = $uid;
        $timestamp = now();
        $post->time = $timestamp;
        $post->save();

        return redirect('home');
    }

}