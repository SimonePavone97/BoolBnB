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

        return view('admin.payment.index', compact('sponsorship', 'apartment', 'amount'));
    }

    public function checkout(Request $request, Apartment $apartment){

       //
    }
}
