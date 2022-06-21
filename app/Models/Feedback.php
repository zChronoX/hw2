<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class Feedback extends Model{
    public $timestamps = false;
    
    protected $connection = 'mongodb';

    protected $collection = 'Feedbacks';

    

}