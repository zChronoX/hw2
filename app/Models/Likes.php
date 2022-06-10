<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes extends Model{

    protected $table = 'likes';
    public $timestamps = false;

    protected $fillable = [
        'postid',
        'userid',
    ];

    public function user(){
        #relazione N-N
        return $this->belongsTo("App/Models/User");
    }
}