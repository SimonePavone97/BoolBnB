<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apartment;
use Carbon\Carbon;
use App\Models\Sponsorship;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $apartments = Apartment::with("services")->get();
        //->paginate(5);

        return response()->json( compact('apartments') );
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
        // in questa pag, grazie a slug (o id o qualsiasi cosa voglio), mi salvo lo spacifico id di riferimento
        $apartment = Apartment::where('id', $id)->with('services')->first();
        //if(!$apartment) return response('apartment not found', 404);

        // tale query la passo ora nel json. Verrà generata un Api: api/apartments/id(di riferimento)
        return response()->json( $apartment );
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

    public function sponsored(){
        $today = Carbon::now('Europe/Rome');

        $sponsorships = Sponsorship::with('apartments')->get();

        $sponsorized = [];

        foreach($sponsorships as $sponsorship){
            $sponsorized[]=$sponsorship->apartments()->wherePivot('end_date', '>', $today)->get();
        }
        return response()->json($sponsorized);
    }
}
