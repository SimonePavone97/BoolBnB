<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class TomtomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();

        $positions = [];

        foreach ($apartments as $apartment) {
                $position =
            [
                "poi" => $apartment->id                              ,
                
              "position" => [
                "lat"=>$apartment->latitude,
                "lon"=>$apartment->longitude
              ],
        
            ];

          array_push($positions, $position);
        }

         json_encode($positions);
         json_decode(json_encode($positions));

        // var_dump($positions);
        // [{"position":
        //     {"lat":40.80558,"lon":-73.96548}},
        // {"position":
        //     {"lat":40.80076,"lon":-73.96556}}]

        return response()->json( $positions);
    }

        public function banana(User $user) {

        

        if ($user->id == Auth::id()) {
            var_dump($user);

            return response()->json( $user);
        } 

    //     if (Auth::check()) {

    //         return response()->json( $email);

    // }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
