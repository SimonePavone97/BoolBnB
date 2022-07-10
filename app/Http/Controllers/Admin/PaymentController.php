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

        $gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        return view('admin.payment.index', compact('sponsorships'));
    }   
}
