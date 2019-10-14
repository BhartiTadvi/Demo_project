<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use app\Product_attribute;

class Product_attributeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'price'=>'required', 
            'quantity'=>'required'
            ]);
        $attribute = new Product_attribute();
        $attribute->price = $request->color;
        $attribute->quantity = $request->quantity;
        
        $result = $attribute->save();
        if($result){
             return redirect('products.product_attribute')->with('success', 'Attribute added successfully');
                 }
    }

}
