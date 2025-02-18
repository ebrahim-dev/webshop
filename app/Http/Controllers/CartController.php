<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;

class CartController extends Controller
{
    public function cart(){
        $user_id = auth()->user()->id;
        $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();
        return view('products.cart',['cartProducts'=>$cartProducts]);
    }


    public function Completeorder(){
         $user_id = auth()->user()->id;
         $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();

         return view('Products.completeorder',['cartProducts'=>$cartProducts]);
    }
    public function StoreOrder(Request $request){
        $newOrder = new Order();
        $user_id = auth() -> user() -> id;
        $newOrder -> name = $request -> name;
        $newOrder -> addres = $request -> addres;
        $newOrder -> email = $request -> email;
        $newOrder -> phone = $request -> phone;
        $newOrder -> note = $request -> note;
        $newOrder -> user_id = $user_id;
        $newOrder -> save();


        $cartProducts = Cart::with('Product')->where('user_id', $user_id)->get();
        foreach ($cartProducts as $item) {
            $newOrderDetail = new OrderDetail();
            $newOrderDetail -> product_id = $item -> product_id;
            $newOrderDetail -> price = $item -> product -> price;
            $newOrderDetail -> quantity = $item -> quantity;
            $newOrderDetail -> order_id = $newOrder -> id;
            $newOrderDetail -> save();
        }

        Cart::where('user_id', $user_id) -> delete();
        return redirect('/');
    }
    public function PreviousOrder(){
        $user_id = auth() -> user() -> id;
        $result = Order::with('OrderDetail')->where('user_id', $user_id)->get();

        return view('Products.previousorder',['orders'=>$result , 'user_id' => $user_id]);
    }
}