<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Sponsorship;
use App\Models\Apartment;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index (Apartment $apartment){

        $sponsorships = Sponsorship::all();

        $now = Carbon::now();

        $expiration = false;
        $end_sponsorship = false;

        if(count((array)$apartment->sponsorships)!=0){
            foreach ($apartment->sponsorships as $sponsorship){
                $end_sponsorship = $sponsorship->pivot->end_sponsorship;
                if($end_sponsorship < $now){
                    $apartment->sponsorships()->detach($sponsorship);
                }
            }
            $carbon_end_sponsorship = new Carbon($end_sponsorship);
            $expiration = $carbon_end_sponsorship;
        }

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        return view('admin.payment.index', compact('sponsorships', 'apartment', 'expiration', 'now', 'end_sponsorship'));
    }

    public function checkout(Request $request, Apartment $apartment){

        $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
        ]);

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
        $sponsorship = $request->sponsorship_select;


        $this_sponsorship = Sponsorship::where('id', $sponsorship)->first();
        $sponsorship_price = $this_sponsorship->price;

        if ($sponsorship_price != $amount) {
            die('Errore, questo non è il prezzo per la sponsorizzazione');
        }

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success || !is_null($result->transaction)) {
        $transaction = $result->transaction;

        if (isset($sponsorship)) {
            $expiration_sponsorship = Carbon::now('Europe/Rome')->addHours($this_sponsorship->duration);

            $apartment->sponsorships()->attach($sponsorship, [
            'end_date' => $expiration_sponsorship,
            'start_date' => Carbon::now('Europe/Rome'),
            ]);
        }

        return redirect()->route('admin.payment.transaction', compact('apartment'));

        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
            return redirect()->route('admin.apartments.index', compact('apartment'));
        }
    }

    public function transaction(Apartment $apartment){
        $user = Auth::user();

        return view('admin.payment.transaction', compact('apartment', 'user'));
    }
}
