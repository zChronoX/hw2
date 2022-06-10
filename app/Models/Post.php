<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Post extends Model{
    public $timestamps = false;

    protected $table = 'posts';

    protected $fillable = [
        'user_id', 'titolo', 'testo' ,'time'
    ];

    public function user(){

        return $this->belongsTo('App\Models\User');

    }

    public function likes(){


        return $this->belongsToMany('App\Models\User');
    }

}


?>