<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;
use App\Contactus;
use App\UserWishlist;
use Auth;
use DB;



class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $sliders = Banner::get();
         $categories = Category::where('parent_id','=', 0)->get();
         $subcategories = category::with('children')->get();
         $products = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->get();

         //dd($products);
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
         $minprice=Product::min('price');
         $maxprice=Product::max('price');
         $filter = Product::whereBetween('price',[$minprice,$maxprice])->get();

         

       // dd($maxprice);
        return view('frontend.home',compact('sliders','categories','subcategories','products','productCounts','product','minprice','maxprice','filter'));
    }

     
     public function showProduct($id)
    {
         $sliders = Banner::get();
         $categories = Category::where('parent_id','=', 0)->get();
         $subcategories = category::with('children')->get();
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories','children')->get();

         $products = Product::whereHas('productCategories',function($q) use($id)
         {
            $q->where('category_id',$id);
         })->with('productImage')->get();
         $minprice=Product::min('price');
         $maxprice=Product::max('price');
         
         
         $filter = Product::whereBetween('price',[$minprice,$maxprice])->get();
         

         //dd($products);
        
       return view('frontend.home',['sliders'=>$sliders,'categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products,'productCounts'=>$productCounts,'minprice'=>$minprice,'maxprice'=>$maxprice,'filter'=>$filter]);
    }


       public function filterPrice(Request $request)
    {
         $minprice = $request->min_price;
         $maxprice = $request->max_price;

         $filter = Product::whereBetween('price',[$minprice,$maxprice])->get();
         

         $minprice=Product::min('price');
         $maxprice=Product::max('price');
         $sliders = Banner::get();
         $products = Product::get();
         $categories = Category::where('parent_id','=', 0)->get();
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories','children')->get();
         $subcategories = category::with('children')->get();

        
         return view('frontend.home',compact('filter','sliders','categories','subcategories','products','productCounts','minprice','maxprice','products'));
    }

      

    public function contact()
    {
        //
        return view('frontend.contactus');
     }

    public function storeContact(Request $request)
    {
       $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contactus,email',
            'subject'=>'required',
            'message'=>'required'
            ]);
       $contactus=new Contactus();
       $contactus->name = $request->name;
       $contactus->email = $request->email;
       $contactus->subject = $request->subject;
       $contactus->message = $request->message;
        $result = $contactus->save();
        if($result){
             return view('frontend.contactus');
                 }
    }
    
    public function productDetails($id)
    {
        $products = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->find($id);
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
          $categories = Category::where('parent_id','=', 0)->get();
           $subcategories = category::with('children')->get();

         //dd($products->productImage[0]->image);
        //
         
        //dd($products->productname);
        return view('frontend.product_details',compact('products','productCounts','categories','subcategories'));
     }

  public function productCategory(Request $request)
    {
        $category_id =$request->category_id;
        $products = Product::whereHas('productCategories',function($q) use($category_id)
         {
            $q->where('category_id',$category_id);
         })->with('productImage')->get();

         
        
       return view('frontend.product', compact('products'));
    }

   public function View_wishList(){
      $categories = Category::where('parent_id','=', 0)->get();
      $subcategories = category::with('children')->get();
      $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
       $products =Product::where('id','product_id')->with('wishList','productImage')->get();
      $productwish =UserWishlist::with('product')->get();   

     //dd($productwish);
                return view('frontend.wishlist',compact('categories','subcategories','productCounts','productwish','products'));

       }

       public function wishList(Request $request) {

        // dd($request->all());
        $user_id = Auth::user()->id;
        $wishList = new UserWishlist;
        $wishList->user_id = $user_id;
        $wishList->product_id = $request->product_id;
        $wishList->save();
        // $products = Product::with('productImage')->where('id', $request->product_id)->get();
        // // dd($products[0]->productImage);
       $categories = Category::where('parent_id','=', 0)->get();
       $subcategories = Category::with('children')->get();
       $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();

        $productwish =UserWishlist::with('product')->get();   

           // dd($productwish[0]->product->productImage);

          //dd($productwish);
        
       return redirect('/WishList')->with('flash_message', 'address added!');

       // return view('frontend.wishlist',compact('categories','subcategories','productCounts','products','productwish'));

    }

    public function removeWishList($id) {
        // dd($id);

        UserWishlist::destroy($id);

        return redirect('/WishList')->with('success', 'Item Removed from Wishlist');
        

    }
   
}
