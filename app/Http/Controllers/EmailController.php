<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Models\OrderDetail;
class EmailController extends Controller
{
    public function sendWelcomeEmail($order_id)
    {
        $orderDetails = OrderDetail::where('order_id', $order_id)->get();
        $defineData = Order::where('id', $order_id)->first();
        $totalAmount = $orderDetails->sum(function ($detail) {
        return $detail->product->price * $detail->quantity;
        });
        $toEmail = $defineData->email;
        $message = "Beste ".$defineData->name.", your order will be shipped to ".$defineData->addres;
        $subject = 'Order Confirmation';
        $goal = "Status: ".$defineData->situation;
        // dd($totalAmount);
        Mail::to($toEmail)->send(new WelcomeEmail($message, $subject, $goal, $orderDetails, $totalAmount));
    }


}
