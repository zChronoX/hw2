<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Session;
use App\Models\User;
use DB;
class FavoriteController extends BaseController{

    //Funzioni di registrazione
    public function index(){
        if(!Session::get('user_id')){
            return redirect('login');
        }
        return view('favorite');

    }

    public function post_liked(){
        //Controllo del login
        if(!Session::get('user_id')){
            return [];
        }
        //Funzione di visualizzazione di tutti i post nella home
        $userid = User::find(Session::get('user_id'));
        $uid = $userid->id;
        $post = array();
        $query = "SELECT u.nome AS nome, u.cognome AS cognome, u.username AS username, u.id AS usersid, p.titolo as titolo, p.testo as testo,
        p.time as tempo, p.id AS postsid, EXISTS(SELECT userid FROM likes WHERE postid = p.id AND userid = $uid) as liked
        FROM posts p join likes l on p.id=l.postid join users u on p.userid=u.id where l.userid= $uid";

        $row = DB::select($query);
        for($i=0; $i<count($row); $i++){
        
            $post[] = array("userid" => ($row[$i]->usersid), "nome" => ($row[$i]->nome), "cognome" => ($row[$i]->cognome), "username" => ($row[$i]->username),
            "titolo" => ($row[$i]->titolo), "testo" => ($row[$i]->testo), "tempo" => ($this->getTime($row[$i]->tempo)), "posts_id" => ($row[$i]->postsid), "liked" => ($row[$i]->liked));

        }

        echo json_encode($post);

        

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


}
