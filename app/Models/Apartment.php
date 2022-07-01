<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function user (){
        return $this-> belongsTo('App\User'); 
    }

    public function stats() {
        return $this->hasMany('App\Models\Stat');
    }
}
