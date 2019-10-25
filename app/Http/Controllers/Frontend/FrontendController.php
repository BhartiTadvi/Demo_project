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
use Illuminate\Support\Facades\Mail;
use App\EmailTemplate;
use App\Mail\ContactMail;
use App\Cms;
class FrontendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $sliders = Banner::get();
        $categories = Category::where(['parent_id'=>0,'status'=>1])->get();
        $subcategories = category::with('children')->get();
        $products = Product::with('productCategories','productCategories.category','categories','productImage','parentCategory')->get();
        $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
        $minprice=0;
        $maxprice=Product::max('price');
        return view('frontend.home',compact('sliders','categories','subcategories','products','productCounts','product','minprice','maxprice'));
     }
    
     /**Show all products on home page**/
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
        $minprice=0;
        $maxprice=Product::max('price');
       return view('frontend.home',['sliders'=>$sliders,'categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products,'productCounts'=>$productCounts,'minprice'=>$minprice,'maxprice'=>$maxprice]);
     }
     
    /** Get dynamic contacts info content from database**/
      public function contact()
      {
        $contact_info = Cms::where('id',1)->get();
        return view('frontend.contactus',compact('contact_info'));
      }
    
    /** Store Contact us into database and send mail when user fill contact details**/
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
       
        $contactmail= array(
        'name'  => $request->get('name'),
        'email'  => $request->get('email'),
        'subject'  => $request->get('subject'),
        'message' => $request->get('message'),
        'ip' => $request->ip(),
        'template_key' => "contact_template_key",
        );
        $email="bhartitadvi081@gmail.com";
        Mail::to($email)->send(new ContactMail($contactmail));
        if($result){
           return redirect()->back()->with('success','Contact done successfully');
                 }
     }
    
    /** Show product details **/
     public function productDetails($id)
     {
        $products = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->find($id);
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
          $categories = Category::where('parent_id','=', 0)->get();
           $subcategories = category::with('children')->get();
         
        return view('frontend.product_details',compact('products','productCounts','categories','subcategories'));
     }
  
    /**Get particular product from category **/
     public function productCategory(Request $request)
     {
        $category_id =$request->category_id;
        $products = Product::whereHas('productCategories',function($q) use($category_id)
         {
            $q->where('category_id',$category_id);
         })->with('productImage')->get();
       return view('frontend.product', compact('products'));
     }
 
     /**Wishlist View**/
     public function ViewWishList()
     {
      $categories = Category::where('parent_id','=', 0)->get();
      $subcategories = category::with('children')->get();
      $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
      $products =Product::where('id','product_id')->with('wishList','productImage')->get();
      $productwish =UserWishlist::with('product')->get();   
      return view('frontend.wishlist',compact('categories','subcategories','productCounts','productwish','products'));
     }
    /** Store Wishlist into database**/
     public function wishList(Request $request) 
     {
      $categories = Category::where('parent_id','=', 0)->get();
      $subcategories = Category::with('children')->get();
      $productCounts = Category::where('parent_id','!=', 0)->with('productCategories')->get();
      $productwish=UserWishlist::where('user_id',Auth::user()->id)
             ->where('product_id',$request->product_id)
             ->first();
     if(isset($productwish->user_id) and isset($request->product_id))
     {
       return redirect()->back()->with('flash_messaged', 'This item is already in your wishlist!');
     }
     else
     {
        $wishList = new UserWishlist;
        $wishList->user_id = Auth::user()->id;
        $wishList->product_id = $request->product_id;
        $wishList->save();
        return redirect()->back()->with('success',
                     'Item, '. $wishList->product->title.' Added to your wishlist.');
     }
    }
    /** Remove Wish from Wishlist **/
    public function removeWishList($id) 
    {
       UserWishlist::destroy($id);
       return redirect('/WishList')->with('success', 'Item Removed from Wishlist');
    }
}