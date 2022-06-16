<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class News extends Model{
    
    protected $connection = 'mongodb';

    protected $collection = 'News';

}