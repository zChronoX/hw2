<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\Post;
use App\Models\User;
use DB;
class FeedController extends BaseController{


    public function post(){
        //Controllo del login
        if(!Session::get('user_id')){
            return [];
        }
        //Funzione di visualizzazione di tutti i post nella home
        $userid = User::find(Session::get('user_id'));
        $uid = $userid->id;
        $post = array();
        $query = "SELECT users.id AS usersid, users.nome AS nome, users.username AS username,
        users.cognome AS cognome, posts.titolo AS titolo, posts.testo AS testo, posts.time AS tempo,
        posts.id AS postsid, EXISTS(SELECT userid FROM likes WHERE postid = posts.id AND userid = $uid) as liked
        FROM posts JOIN users on posts.userid = users.id ORDER BY postsid DESC";

        $row = DB::select($query);
        for($i=0; $i<count($row); $i++){
        
            $post[] = array("userid" => ($row[$i]->usersid), "nome" => ($row[$i]->nome), "cognome" => ($row[$i]->cognome), "username" => ($row[$i]->username),
            "titolo" => ($row[$i]->titolo), "testo" => ($row[$i]->testo), "tempo" => ($this->getTime($row[$i]->tempo)), "posts_id" => ($row[$i]->postsid), "liked" => ($row[$i]->liked));

        }

        return $post;

        

    }

    public function search_post($q){
        //Controllo del login
        if(!Session::get('user_id')){
            return [];
        }
        //Funzione di ricerca dei post dato un carattere nel testo
        $userid = User::find(Session::get('user_id'));
        $uid = $userid->id;

        $post = array();
        $query = "SELECT users.id AS usersid, users.nome AS nome, users.username AS username,
        users.cognome AS cognome, posts.titolo AS titolo, posts.testo AS testo, posts.time AS tempo,
        posts.id AS postsid, EXISTS(SELECT userid FROM likes WHERE postid = posts.id AND userid = $uid) as liked
        FROM posts JOIN users on posts.userid = users.id WHERE testo like '%".$q."%' ORDER BY postsid DESC ";

        $row = DB::select($query);
        for($i=0; $i<count($row); $i++){
        
            $post[] = array("userid" => ($row[$i]->usersid), "nome" => ($row[$i]->nome), "cognome" => ($row[$i]->cognome), "username" => ($row[$i]->username),
            "titolo" => ($row[$i]->titolo), "testo" => ($row[$i]->testo), "tempo" => ($this->getTime($row[$i]->tempo)), "posts_id" => ($row[$i]->postsid), "liked" => ($row[$i]->liked));

        }

        return $post;

        

    }




    public function getTime($timestamp) {      
        // Calcola il tempo trascorso dalla pubblicazione del post       
        $old = strtotime($timestamp); 
        $diff = time() - $old;           
        $old = date('d/m/y', $old);
    
        if ($diff /60 <1) {
            return intval($diff%60)." secondi fa";
        } else if (intval($diff/60) == 1)  {
            return "Un minuto fa";  
        } else if ($diff / 60 < 60) {
            return intval($diff/60)." minuti fa";
        } else if (intval($diff / 3600) == 1) {
            return "Un'ora fa";
        } else if ($diff / 3600 <24) {
            return intval($diff/3600) . " ore fa";
        } else if (intval($diff/86400) == 1) {
            return "Ieri";
        } else if ($diff/86400 < 30) {
            return intval($diff/86400) . " giorni fa";
        } else {
            return $old; 
        }
    }

    public function spotify(){
        $client_id = env('SPOTIFY_CLIENT_ID');
        $client_secret = env('SPOTIFY_CLIENT_SECRET');
    
        // ACCESS TOKEN
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Eseguo la POST
        curl_setopt($ch, CURLOPT_POST, 1);
        # Setto body e header della POST
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
        $token=json_decode(curl_exec($ch), true);
        curl_close($ch);    
    
        // QUERY EFFETTIVA
        $query = urlencode($_GET["q"]);
        $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        # Imposto il token
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
        $res=curl_exec($ch);
        curl_close($ch);
    
        echo $res;
    }

    public function delete_post($id){
        if (Post::find($id)->userid != Session::get('user_id'))
        {
            return array("notauthorized" =>true);
        }
        
        $deletedPost = Post::where('id',$id)->delete();
        return array("notauthorized" => false);
    }



}

