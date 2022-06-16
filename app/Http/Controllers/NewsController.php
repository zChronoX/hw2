<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\News;
class NewsController extends BaseController{

    //Index

    public function news(){
        if(!Session::get('user_id')){
            return redirect('login');
        }
        return view('news');
    }

    public function getnews(){
        $news = News::all();
        return $news;
    }
}