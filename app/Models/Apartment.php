<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function user (){
        return $this-> belongsTo('App\User'); 
    }

<<<<<<< HEAD
    public function stats() {
        return $this->hasMany('App\Models\Stat');
=======
    public function messages (){
        return $this-> hasMany('App\Models\Message'); 
    }

    public function services (){
        return $this-> belongsToMany('App\Models\Service'); 
>>>>>>> origin/ga/tank/ludo
    }
}
