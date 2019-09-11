<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\Product;




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

        // dd($subcategories);
         

        return view('frontend.home',compact('sliders','categories','subcategories','products'));
    }

     public function showProduct($id)
    {
         $sliders = Banner::get();
         $categories = Category::where('parent_id','=', 0)->get();
         $subcategories = category::with('children')->get();
       
         $products = Product::whereHas('productCategories',function($q) use($id)
         {
            $q->where('category_id',$id);
         })->with('productImage')->get();
        
       return view('frontend.home',['sliders'=>$sliders,'categories'=>$categories,'subcategories'=>$subcategories,'products'=>$products]);
    }


   
     

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function contact(Request $request)
    {
        //
        return view('frontend.contactus');

    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
