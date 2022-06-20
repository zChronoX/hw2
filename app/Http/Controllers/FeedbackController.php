<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends BaseController{

    public function feedback(){
        if(!Session::get('user_id')){
            return redirect('login');
        }
        return view('feedback');
    }

    public function send_feedback(Request $request){
        $user = User::find(Session::get('user_id'));
        $feedback = new Feedback;
        $feedback->userID = $user->id;
        $feedback->RealName = $user->nome;
        $feedback->RealSurname = $user->cognome;
        $feedback->RealUsername = $user->username;
        $feedback->Name = $request->get('Nome');
        $feedback->Surname = $request->get('Cognome');
        $feedback->Feedback = $request->get('Testo');
        $feedback->save();

        return redirect('feedback')->with('success', 'Il tuo feedback è stato invato!');
    }
}