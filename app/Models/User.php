<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class User extends Model{
    public $timestamps = false;

    protected $table = 'users';



    protected $fillable = ['id', 'nome', 'cognome', 'username', 'password', 'email',
    'gender', 'data_registrazione'];

    public function posts(){

        return $this->hasMany('App\Models\Post');

    }


    public function likes(){


        return $this->belongsToMany('App\Models\Post');
    }

}


?>