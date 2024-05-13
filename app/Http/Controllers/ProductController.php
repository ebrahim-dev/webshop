<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function AddProduct () {
        $allcategories = Category::all();
        return view('Products.addproduct',['allcategories'=>$allcategories]);
    }
    public function EditProduct ($productid=null) {
        if ($productid != null) {
            $currentProduct= Product::findorfail($productid);
            $allcategories = Category::all();
            return view('Products.editproduct',['product' => $currentProduct , 'allcategories'=>$allcategories]);
        } else {
            return redirect('/addproduct');
        }

    }
    public function RemoveProducts ($productid=null) {
        if($productid){
            $currentProduct= Product::find($productid);
            $currentProduct->delete();
            return redirect('/products');
        }
        else{
            abort(403, "Please enter product id in the route!");
        }

    }
    public function StoreProduct(Request $request){
        $request -> validate([
            'name'=>'required|max:100',
            'price'=>'required',
            'quantity'=>'required|integer',
            'photo'=>'image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);
        if($request->id){
            $currentProduct= Product::find($request->id);
            $currentProduct->name = $request->name;
            $currentProduct->price = $request->price;
            $currentProduct->quantity = $request->quantity;
            $currentProduct->description = $request->description;
            $currentProduct->imagepath = $request->imagepath;
            $currentProduct->category_id = $request->category_id;
                    if ($request->has('photo')) {
          $currentProduct -> imagepath =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());

        }
            $currentProduct-> save();
            //Add new product
        } else{
        $newProduct = new Product();
        $newProduct -> name = $request -> name;
        $newProduct -> price = $request -> price;
        $newProduct -> quantity = $request -> quantity;
        $newProduct -> description = $request -> description;
        $newProduct -> category_id =$request -> category_id;
        $newProduct -> imagepath =$request -> imagepath;
        if ($request->has('photo')) {
          $newProduct -> imagepath =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());

        }
        $newProduct -> save();
        }

        return redirect('/products');
    }
    public function ProductsTable(){
        $products = Product::all();
        return view('Products.productstable',['products'=> $products]);
    }
    public function AddProductImages($productid){
        $product = Product::find($productid);
        $productImages = ProductPhoto::where('product_id',$productid)->get();
        return view('Products.addproductimages',['product'=> $product, 'productImages'=> $productImages]);
    }

    public function StoreProductImage(Request $request){
        $request -> validate([
            'product_id'=> 'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $photo = new ProductPhoto();
        $photo->product_id = $request -> product_id;

        if ($request->has('photo')) {
            $path =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());
            $photo->imagepath = $path;
        }
        $photo->save();
        return redirect('/productstable');
    }
        public function RemoveProductPhoto ($imageid=null) {
        if($imageid){
            $photo= ProductPhoto::find($imageid);
            $photo->delete();
            return redirect('/productstable');
        }
        else{
            abort(403, "Please enter image id in the route!");
        }

    }

     public function showProduct($productid) {

        $product= Product::with('Category','ProductPhoto')->find($productid);
        $relatedProducts= Product::where('category_id', $product ->category_id)->where('id', '!=',$productid)->inRandomOrder()->limit(3)->get();
        return view('Products.showProduct', ['product'=>$product, 'relatedProducts'=>$relatedProducts]);

    }
    public function addcategory (Request $request) {
        $categories = Category::all();
        $products = Product::all();
        return view('Products.addcategory',['categories'=>$categories, 'products'=>$products]);
    }
    public function storeCategory (Request $request) {
        // dd($request->name);
        $request -> validate([
            'name'=>'required|max:100',
            'photo'=>'image|mimes:jpeg,png,jpg,gif|max:9048',
        ]);
        $categories = Category::all();
        $products = Product::all();
        if($request->id){
            $currentategory= Category::find($request->id);
            $currentategory->name = $request->name;
            $currentategory->description = $request->description;
            $currentategory->imagepath = $request->imagepath;
                if ($request->has('photo')) {
                $currentategory -> imagepath =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());

                }
                // dd($currentategory);
            $currentategory-> save();

            //Add new category
        } else{
            $newCategory = new Category();
            $newCategory -> name = $request -> name;
            $newCategory -> description = $request -> description;
            $newCategory -> imagepath =$request -> imagepath;
            if ($request->has('photo')) {
            $newCategory -> imagepath =$request->photo->move('uploads',Str::uuid()->toString().'_'. $request->file('photo')->getClientOriginalName());

            }
            // dd( $newCategory);
            $newCategory -> save();

        }

        return view('category',['categories'=>$categories, 'products'=>$products]);
    }
     public function CategoryTable(){
        $categories = Category::all();
        return view('Products.categorytable',['categories'=> $categories]);
    }
     public function EditCategory ($categoryid=null) {
        if ($categoryid != null) {
            $currentCategory= Category::findorfail($categoryid);
            $allcategories = Category::all();
            return view('Products.editcategory',['category' => $currentCategory , 'allcategories'=>$allcategories]);
        } else {
            return redirect('/addcategory');
        }

    }
    public function RemoveCategory ($categoryid=null) {
        if($categoryid){
            $currentCategory= Category::find($categoryid);
            $currentCategory->delete();
            return redirect('/categorytable');
        }
        else{
            abort(403, "Please enter category id in the route!");
        }

    }

}