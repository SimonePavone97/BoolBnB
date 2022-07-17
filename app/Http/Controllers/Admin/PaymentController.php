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
        //importo il gateway di Braintree
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        //genero un token per il pagamento
        $token = $gateway->ClientToken()->generate();

        return view('admin.payment.index', compact('token', 'sponsorship', 'apartment', 'amount'));
    }

    public function store(Request $request, Sponsorship $sponsorship, Apartment $apartment){
        //importo il gateway di Braintree
       $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = 5.99;
        $nonce = $request["payment_method_nonce"];

        $result = $gateway->transaction()->sale([
            'amount' => 5.99,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        if ($result->success) {
            $transaction = $result->transaction;

            $duration = $sponsorship->duration;
            //imposto la data attuale
            $today = Carbon::now('Europe/Rome');
            //invio i dati al DB
            $apartment_sponsorship = new ApartmentSponsorship();
            $apartment_sponsorship->apartment_id = $apartment->id;
            $apartment_sponsorship->sponsorship_id = $sponsorship->id;
            $apartment_sponsorship->start_date = Carbon::now('Europe/Rome');
            $apartment_sponsorship->end_date = date('Y-m-d h:i:s', strtotime($today)+60*60*$duration);
            $apartment_sponsorship->save();
            //rimando alla index degli appartamenti con messaggio di transazione avvenuta o rifiutata       
            return redirect()->route('admin.apartments.index', compact('apartment'))->with('success-message', 'Transazione eseguita con successo. Sponsorizzazione: ' . ucfirst($sponsorship->name));
        } else {
            $errorString = "";
            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return back()->withErrors('Error occured:'. $result->message);
        }
    }
}
