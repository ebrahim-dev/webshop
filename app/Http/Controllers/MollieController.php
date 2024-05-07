<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    public function mollie(Request $request){
        // dd($request);
         $payment = Mollie::api()->payments->create([
        "amount" => [
            "value" => $request->price, // You must send the correct number of decimals, thus we enforce the use of strings
            "currency" => "EUR",
        ],
        // "description" => $request->product_name,
        "description" => auth() -> user() -> email,
        "redirectUrl" => route('success'),
        // "webhookUrl" => route('webhooks.mollie'),
        "metadata" => [
            "order_id" => "123",
        ],
    ]);
    // dd($payment);
    // redirect customer to Mollie checkout page
    session()->put('paymentId',$payment->id );
    session()->put('quntity', $request->quantity);
    return redirect($payment->getCheckoutUrl(), 303);
    }

    public function success(Request $request){
    $paymentId = session()->get('paymentId');
    $payment = Mollie::api()->payments->get($paymentId);

    if ($payment->isPaid())
    {
        $obj = new Payment();
        $obj->payment_id = $paymentId;
        $obj->product_name = $payment->description;
        $obj->quantity = session()->get('quntity');
        $obj->amount = $payment->amount->value ;
        $obj->currency = $payment->amount->currency ;
        $obj->payment_status = $payment->status ;
        $obj->payment_method = $payment->method ;
        $obj->save();
        session()->forget('paymentId');
        session()->forget('quntity');
        echo 'Payment received.';
    } else{
        return redirect()->route('cancel');
    }
    }
    public function cancel(){
        echo "Payment is cancelled!";
    }
}
