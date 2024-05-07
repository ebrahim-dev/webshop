<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;
use App\Models\Order;
use App\Models\OrderDetail;
class EmailController extends Controller
{
    public function sendWelcomeEmail($id){
        $data=Order::find($id);
        $toEmail=$data['email'];
        $message = "Beste".$data['name']. "your order will be shiped to ". $data['addres'];
        $subject= 'Approved';
        $goal="Status: " . $data['situation'];
        Mail::to($toEmail)->send(new WelcomeEmail($message, $subject, $goal));
    }
}
