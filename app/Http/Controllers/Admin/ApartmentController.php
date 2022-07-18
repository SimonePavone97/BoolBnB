<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Message;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = DB::table('apartments')->where('user_id', Auth::id())->get();

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $apartment = new Apartment();

        $apartment->fill($data);
        $apartment->user_id = Auth::id();
        $apartment->visibility = true;

        // Chiamata a TOMTOM API per calcolo latitude e logitude
        $APIrequest = 'https://api.tomtom.com/search/2/geocode/' . $apartment->address . '.json?key=cMTORuMrpmoMysQnNBGRyAx2g8Nmo8P9';
        $response = Http::get($APIrequest)->json();
        $apartment->longitude = $response['results'][0]['position']['lon'];
        $apartment->latitude = $response['results'][0]['position']['lat'];

        $apartment->save();

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
       
        if ($apartment->user_id == Auth::id()) {
            return view('admin.apartments.show', compact('apartment'));
        } else {
            // Sostituire con 404
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();

        $apartment_services_id = $apartment->services->pluck('id')->toArray();

        if ($apartment->user_id == Auth::id()) {
            return view('admin.apartments.edit', compact('apartment','services', 'apartment_services_id'));
        } else {
            // Sostituire con 404
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $data = $request->all();

        // $apartment['slug'] = Str::slug($request->title, '-');

        if(array_key_exists('image', $data)){
            if($apartment->image) Storage::delete($apartment->image);
            $image_url = Storage::put('apartment_images', $data['image']);
            $data['image'] = $image_url;
        };
        //php artisan storage:link
        
        if( array_key_exists('services', $data)) $apartment->services()->sync( $data['services']);

        $apartment->fill($data);

        // Chiamata a TOMTOM API per calcolo latitude e logitude
        $APIrequest = 'https://api.tomtom.com/search/2/geocode/' . $apartment->address . '.json?key=PsUYA2pnhpu22nLOAzS8KbMCWHziEWf3';
        $response = Http::get($APIrequest)->json();
        $apartment->longitude = $response['results'][0]['position']['lon'];
        $apartment->latitude = $response['results'][0]['position']['lat'];

        $apartment->update($data);

        return redirect()->route('admin.apartments.show', $apartment)->with('message', "Hai aggiornato con successo: $apartment->title");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        if ($apartment->user_id == Auth::id()) {
            $apartment->delete();
        }

        return redirect()->route('admin.apartments.index')->with('message', "Hai eliminato con successo: $apartment->title");
    }
}
