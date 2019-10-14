<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Banner;
use App\Category;
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

         foreach($cart as $item){
            $total=$total+$item->qty*$item->price;
        }
         Session::put('total',$total);

           // dd($cart,'gdfgds');
        // $products = Product::with('productCategories','productCategories.category'
        //     ,'categories','productImage','parentCategory')->get();   
        return view('frontend.cart', [
        'data' => $cart, 
      
     ]);
    }
     public function incrementItem(Request $request){
       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $qty++;
       // $price =$request->price;
       // $total=0;
        // $cart = Cart::content();

        //  foreach($cart as $item){
        //     $total=$total+$item->qty*$item->$price;
        // }
        // $total=$total+$qty*$price;
       $update = Cart::update($rowId, $qty,$total);
       $updateprice= $update->subtotal();

         return response()->json(['quantity' =>$update,'updateprice' =>$updateprice,'total' =>$total]);
    }


    public function decrementItem(Request $request){
       $rowId = $request->rowId;
       $qty =$request->cart_qty;
       $price =$request->price;
       $qty--;
       
       $update = Cart::updateDecrement($rowId, $qty);
       $updateprice= $update->subtotal();

         return response()->json(['quantity' =>$update,'updateprice' =>$updateprice,'total' =>$total]);
      
    }

    public function removeItem($id){
      Cart::remove($id);
      // dd($id);
      return back();
    }

     
    






}
