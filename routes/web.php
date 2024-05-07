<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Controllers\FirstController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MollieController;
use Illuminate\Http\Request;

// Auth::routes(['register'=>false]);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[FirstController::class, 'MainPage'] );
Route::get('/products/{catid?}',[FirstController::class, 'GetAllCategoryProducts'])->name('products');
Route::get('/categories', [FirstController::class, 'GetCategoryProducts'])->name('categories');

Route::get('/addproduct', [ProductController::class, 'AddProduct'])->name('addproduct')->middleware('checkrole:admin,saler');
Route::get('/editproduct/{productid?}', [ProductController::class, 'EditProduct'])->name('editproduct')->middleware('checkrole:admin,saler');
Route::get('/removeproducts/{productid?}',[ProductController::class, 'RemoveProducts'])->name('removeproduct')->middleware('checkrole:admin,saler');
Route::post('/storeproduct', [ProductController::class, 'StoreProduct'])->name('storeproduct')->middleware('auth');

Route::get('/reviews', [FirstController::class, 'Reviews'])->name('reviews');
Route::post('/storereview', [FirstController::class, 'StoreReview'])->name('storereview');
Route::post('/search',function(Request $request){
    $products = Product::where('name', 'like', '%' . $request->searchkey . '%')->paginate(6);
    return view('product',['products'=> $products]);
})->name('search');

Route::get('/productstable',[ProductController::class, 'ProductsTable'])->name('productstable')->middleware('checkrole:admin,saler');
Route::get('/addproductimages/{productid}',[ProductController::class, 'AddProductImages'])->name('addproductimages')->middleware('checkrole:admin,saler');
Route::get('/cart',[CartController::class, 'cart'])->name('cart')->middleware('auth');
Route::get('/addproducttocart/{productid}', function($productid){
    $user_id=auth()->user()->id;
    $result=Cart::where('user_id',$user_id)->where('product_id',$productid)->first();
    if($result !== null){
        $result->quantity +=1;
        $result->save();
    } else{
    $newCart = new Cart();
    $newCart -> product_id =$productid;
    $newCart -> user_id =$user_id;
    $newCart -> quantity =1;
    $newCart -> save();
    }

    return redirect('/cart');
})->name('addproducttocart')->middleware('auth');
Route::get('/deletecartitem/{cartid}',function($cartid){
    Cart::find($cartid)->delete();
    return redirect('/cart');
})->name('deletecartitem')->middleware('auth');
Route::get('/removeproductphoto/{imageid?}',[ProductController::class, 'RemoveProductPhoto'])->name('removeproductphoto')->middleware('auth');
Route::post('/storeproductimage',[ProductController::class,'StoreProductImage']);

Route::get('/single-product/{productid}',[ProductController::class, 'showProduct'])->name('single-product');
Route::get('/completeorder',[CartController::class, 'Completeorder'])->name('completeorder');
Route::post('/storeorder',[CartController::class,'StoreOrder']);
Route::get('/previousorder',[CartController::class, 'PreviousOrder'])->name('previousorder')->middleware('auth');
Route::post('/lang/{local}', function($local){
    session()->put('local',$local);
    return redirect()->back();
})->name('changeLanguage');
Route::post('/mollie', [MollieController::class, 'mollie'])->name('mollie');
Route::get('/success', [MollieController::class, 'success'])->name('success');
Route::get('/cancel', [MollieController::class, 'cancel'])->name('cancel');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/regiterrequest', [FirstController::class, 'ContactUs'])->name('regiterrequest');
