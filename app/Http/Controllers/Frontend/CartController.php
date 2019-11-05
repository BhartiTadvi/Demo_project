<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Banner;
use App\Category;
use App\Coupon;
use Cart;
use Session;

class CartController extends Controller
{
   /** Show cart page **/
    public function createCart(){
        return view('frontend.cart');
    }

    /** Add item into cart **/
    public function addItem($id){
      $perPage = 9;
     $product = Product::with('productCategories','productCategories.category','categories','productImage','parentCategory')->find($id);
     $add = Cart::add([
            'id' => $product->id, 
            'name' => $product->productname,
            'price' => $product->price,
            'qty' => 1,
            'options' => ['product_image'=> $product->productImage[0]->image]]);
     $sliders = Banner::get();
     $products = Product::with('productCategories','productCategories.category','categories','productImage','parentCategory')->paginate($perPage);
     $categories = Category::where(['parent_id'=>0,'status'=>1])->get();
     $subCategories = category::with('children')->get();
     $productCounts = Category::where('parent_id','!=', 0)->
                      where('status',1)->with('productCategories','children')->get();
     $minprice=0;
     $maxprice=Product::max('price');
     $recommendationProduct = $products->chunk(3);
     return view('frontend.home',[
         'data' => Cart::content()
       ,'sliders'=>$sliders,'categories'=>$categories,'subcategories'=>$subCategories,'products'=>$products,'productCounts'=>$productCounts,'minprice'=>$minprice,'maxprice'=>$maxprice,'recommendationProduct'=>$recommendationProduct]);
     }

     /** Show cart details **/
        public function index(){
      $total=0;
      $cart = Cart::content();
      $coupons = Coupon::first();
      foreach($cart as $item)
         {
            $total=$total+($item->qty*$item->price);
         }
      Session::put('total',$total);
      return view('frontend.cart', [
        'data' => $cart, 'coupons' => $coupons
     ]);
    }
   
    /** Increment Quantity of product **/
    public function incrementItem(Request $request)
    {
        
       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $subTotal=$request->subTotal;
       $productPrice = $request->priceu;
        if($qty == null ||$rowId == null){
          $quantityError = "sorry quantity is empty";
        return response()->json(['quantityError' =>$quantityError]);
        }
        if(!empty($qty)){
        $qty++;
       }
       $subTotal = $subTotal+$productPrice;
       $couponType=$request->coupontype;
       $couponValue=$request->couponvalue;
        if($couponValue == null){
          $couponValue=0;
        }
        $coupons = Coupon::get();
        if($coupons == null){
           return response()->json(['coupon' =>$coupon]);
        }
        if($couponType == 0){
              $couponAmount = $subTotal-$couponValue; 
               $total=$couponAmount;
        }
        else{
                $couponAmount =$subTotal*($couponValue/100);
                $total=$subTotal-$couponAmount;
            }
       $update = Cart::update($rowId, $qty);
       $updateprice= $update->subtotal();
         return response()->json(['quantity' =>$update,'updateprice' =>$updateprice, 'subTotal' => $subTotal,'couponvalue' => $couponValue,'couponamount' =>$couponAmount,'total' =>$total]);
    }
        
     /** Decrement Quantity of product **/
    public function decrementItem(Request $request){

       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $subTotal=$request->subTotal;
       $productPrice = $request->priceu;
        if($qty == null ||$rowId == null){
          $quantityError = "sorry quantity is empty";
        return response()->json(['quantityError' =>$quantityError]);
        }
        if(!empty($qty)){
        $qty--;
       }

       $subTotal = $subTotal-$productPrice;
       $couponType=$request->coupontype;
       $couponValue=$request->couponvalue;
       if($couponValue == null)
        {
          $couponValue=0;
        }
       $coupons = Coupon::get();
      if($coupons == null)
          {
             return response()->json(['coupon' =>$coupon]);
          }
           if($couponType == 0)
             {
              $couponAmount = $subTotal-$couponValue; 
               $total=$couponAmount;
             }
            else{
                $couponAmount =$subTotal*($couponValue/100);
                $total=$subTotal-$couponAmount;
                }
      $update = Cart::updateDecrement($rowId, $qty);
      $updateprice= $update->subtotal();
      return response()->json(['quantity' =>$update,'updateprice' =>$updateprice,'subTotal' => $subTotal,'couponvalue' => $couponValue,'couponamount' =>$couponAmount,'total' =>$total]);
     }
    
    /** Remove cart details form cart **/
    public function removeItem($id){
      Cart::remove($id);
      return back();
    }
   
    /** Apply coupon on product price in cart **/
     public function applyCoupon(Request $request)
    {
       $coupon =$request->coupon_code;
       $subTotal=$request->subTotal;
       $coupons = Coupon::where('code',$coupon)->first();
      
      if($coupons == null || $subTotal < 300)
      {
         $error_message ="Coupon is invalid";
        return response()->json(['error_message' =>$error_message]);
      }
      
     else{
      if($coupons->type == 0)
             {
              $couponAmount = $subTotal-$coupons->discount; 
              $total=$couponAmount;
             }
            else{
                $couponAmount =$subTotal*($coupons->discount/100);
                $total=$subTotal-$couponAmount;
                }
           $discounttype=$coupons->type;
           $coupon_id=$coupons->id;
           $discount=$coupons->discount;
           Session::put('discounttype',$discounttype);
           Session::put('discount',$discount);
           Session::put('total',$total);
           Session::put('coupon_id',$coupon_id);
        return response()->json(['couponamount' =>$couponAmount,'total' =>$total,'discounttype' =>$discounttype,'discount' =>$discount,'coupon_id' =>$coupon_id]);
    }
     }
     public function cancelCoupon(Request $request)
     {
         $total=$request->subTotal;
         $discountCoupon =0;
         return response()->json(['discountCoupon' =>$discountCoupon,'total' =>$total]);
     }

      

}
