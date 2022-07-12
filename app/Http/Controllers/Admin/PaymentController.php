<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sponsorship;
use App\Models\Apartment;

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

        $amount = $request["amount"];
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
            $today = Carbon::now('Europe/Rome');

            $duration = $sponsorship->duration;
            $endDate = date('Y-m-d h:i:s', strtotime($today)+60*60*$duration);
            $apartment->sponsorships()->sync([$sponsorship->id => ['start_date' => $today, 'end_date' => $endDate]]);
            $apartment->visible = 1;
            $apartment->save();
            
            return redirect()->route('admin.apartment.index', compact('apartment'))->with('sponsor-success-message', 'Transazione eseguita con successo. Sponsorizzazione: ' . ucfirst($sponsorship->name));
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            return back()->withErrors('Error occured:'. $result->message);
        }
    }
}
