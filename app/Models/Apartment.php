<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable=['title', 'rooms', 'beds', 'bathrooms', 'mq', 'address', 'image', 'description'];

    public function user (){
        return $this-> belongsTo('App\User'); 
    }

    public function stats() {
        return $this->hasMany('App\Models\Stat');
    }

    public function messages (){
        return $this-> hasMany('App\Models\Message'); 
    }

    public function services (){
        return $this-> belongsToMany('App\Models\Service'); 
    }
}
