<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class FirstController extends Controller
{
    public function MainPage () {
        $value= now();
        Session()->put('date', $value);
        if (Auth::user()) {
            Session()->put('username', auth()->user()->name);
        }
        $result = Category::all();
        return view('welcome',['categories'=>$result]);
    }
    public function Reviews () {
        $reviews = Review::all();
        return view('reviews',['reviews'=>$reviews]);
    }
    public function StoreReview (Request $request) {
        $request -> validate([
            'name'=>'required|max:100|unique:reviews',
            'phone'=>'required',
            'email'=>'required|email',
            'subject'=>'required',
            'message'=>'required',
        ]);
        $newReview = new Review();
        $newReview -> name = $request -> name;
        $newReview -> phone = $request -> phone;
        $newReview -> email = $request -> email;
        $newReview -> subject = $request -> subject;
        $newReview -> message = $request -> message;
        $newReview -> imagepath = $request -> imagepath;
        if ($request->has('photo')) {
            $newReview -> imagepath =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());

        }
        $newReview -> save();
        return redirect('/reviews');
    }

    public function GetAllCategoryProducts ($catid =null) {
        b:if($catid){
            $result = Product::where('category_id',$catid)->paginate(6);
            return view('product',['products' =>$result]);
        }
        else{
            $result = Product::paginate(6);
            return view('product',['products' =>$result]);

        }

    }
    public function GetCategoryProducts () {
        $categories = Category::all();
        $products = Product::all();
        return view('category',['products'=>$products,'categories'=>$categories]);
    }

    public function ContactUs(Request $request)
    {
        // Valideer het formuliergegevens
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Stuur een e-mail
        Mail::to('mailtrap@demomailtrap.com')->send(new ContactFormMail($request->name, $request->email, $request->password));

        // Redirect terug naar de contactpagina met een succesbericht
        return redirect('/contact')->with('success', 'Bedankt voor je bericht! We nemen spoedig contact met je op.');
    }

}
