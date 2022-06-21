<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\Post;
use App\Models\User;
use App\Models\Likes;
use DB;
use Illuminate\Http\Request;

class LikeController extends BaseController{

    public function likes(Request $request){
        $pid=$request->route('id_post');
        $response = array();

        $likes_post = Likes::where('userid', Session::get('user_id') )->get();
        foreach($likes_post as $postLiked){
            if($pid == $postLiked['postid']){
                #se avevo messo il like, lo tolgo
                $result=Likes::where('userid',Session::get('user_id'))->where('postid',$pid)->delete();
                if($result){
                    $response['postid']=$pid;
                    $response['like']=false;
                    return response()->json($response);
                }
                else{
                    $response['postid']=$pid;
                    $response['error']=true;
                    $response['errorType']="Non è stato possibile togliere il like";
                    return response()->json($response);
                }
            }
        }
        #gli metto il like
        $newLike = Likes::create([
            'userid' => Session::get('user_id'),
            'postid' => $pid
        ]);
        if($newLike){
            $response['postid']=$pid;
            $response['like']=true;
            return response()->json($response);
        }else{
            $response['postid']=$pid;
            $response['error']=true;
            $response['errorType']="Non è stato possibile inserire il like";
            return response()->json($response);
        }
    
    }
}