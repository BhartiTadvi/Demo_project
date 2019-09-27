<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Banner;
use App\Category;
use App\Coupon;

use Cart;
USE Session;


class CartController extends Controller
{
    //
    public function createCart(){
    	return view('frontend.cart');
    }
    public function addItem($id){

      $product = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->find($id);
      //dd($product);
      //dd($product->productImage[0]->image);
     
      
           $add = Cart::add([
            'id' => $product->id, 
            'name' => $product->productname,
            'price' => $product->price,
            'qty' => 1,
            'options' => ['product_image'=> $product->productImage[0]->image]]);
       
        $sliders = Banner::get();
        $products = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->get();
        
         $categories = Category::where('parent_id','=', 0)->get();
         $subcategories = category::with('children')->get();
         $productCounts = Category::where('parent_id','!=', 0)->with('productCategories','children')->get();
         $minprice=Product::min('price');
         $maxprice=Product::max('price');
         $filter = Product::whereBetween('price',[$minprice,$maxprice])->get();
       return view('frontend.home',[
         'data' => Cart::content()
       ,'sliders'=>$sliders,'categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products,'productCounts'=>$productCounts,'minprice'=>$minprice,'maxprice'=>$maxprice,'filter'=>$filter]);
     
     }
		public function index(){
      $total=0;
        $cart = Cart::content();
        $coupons = Coupon::get();


         foreach($cart as $item)
         {
            $total=$total+($item->qty*$item->price);
         }
         // dd($total);
        
         Session::put('total',$total);

        return view('frontend.cart', [
        'data' => $cart, 'coupons' => $coupons
      
     ]);
    }
    public function incrementItem(Request $request){
       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $subTotal=$request->subTotal;
       $productPrice = $request->priceu;
       $qty++;
        $subTotal = $subTotal+$productPrice;
       // dd($subTotal);
       $update = Cart::update($rowId, $qty);
       $updateprice= $update->subtotal();


         return response()->json(['quantity' =>$update,'updateprice' =>$updateprice, 'subTotal' => $subTotal]);
    }
    public function decrementItem(Request $request){
       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $subTotal=$request->subTotal;
       $productPrice = $request->priceu;
       // dd($request->all());
       $qty--;
       $subTotal = $subTotal-$productPrice;
       $update = Cart::updateDecrement($rowId, $qty);
       $updateprice= $update->subtotal();

         return response()->json(['quantity' =>$update,'updateprice' =>$updateprice,'subTotal' => $subTotal]);
      
    }

    public function removeItem($id){
      Cart::remove($id);
      // dd($id);
      return back();
    }
    
     public function applyCoupon(Request $request)
    {
      $coupon_id = $request->coupon_id;
      $coupon = Coupon::where('id',$coupon_id)->get();
      return response()->json(['coupon_id' =>$coupon_id]);
    }
     
    






}
