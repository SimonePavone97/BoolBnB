<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sponsorship;
use App\Models\Apartment;
use App\Models\ApartmentSponsorship;

class PaymentController extends Controller
{
    public function index (Sponsorship $sponsorship, Apartment $apartment){

        $amount = $sponsorship->price;


        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $token = $gateway->ClientToken()->generate();

        return view('admin.payment.index', compact('token', 'sponsorship', 'apartment', 'amount'));
    }

    public function store(Request $request, Sponsorship $sponsorship, Apartment $apartment){

       $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = 5.99;
        $nonce = $request["payment_method_nonce"];

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $transaction = $result->transaction;
            $duration = $sponsorship->duration;
            
            $today = Carbon::now('Europe/Rome');

            $apartment_sponsorship = new ApartmentSponsorship();
            $apartment_sponsorship->apartment_id = $apartment->id;
            $apartment_sponsorship->sponsorship_id = $sponsorship->id;
            $apartment_sponsorship->start_date = Carbon::now('Europe/Rome');
            $apartment_sponsorship->end_date = date('Y-m-d h:i:s', strtotime($today)+60*60*$duration);

            $apartment_sponsorship->save();
            
            
            return back()->with('sponsor-success-message', 'Transazione eseguita con successo.');
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Error occured:'. $result->message);
        }
    }
}
