<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Product_image;


use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 4;

        if (!empty($keyword)) {
            $products = Product::where('productname', 'LIKE', "%$keyword%")
                ->orWhere('price', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage)
                ->with('productCategories','productCategories.category');
            dd($products);


        } else {
            $products = Product::with('productCategories','productCategories.category')->paginate($perPage);

           //dd($products);
        }

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::with('children')->where('parent_id',0)->get();
        return view('products.create',compact('categories',$categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();

         //dd($requestData);
        $product=Product::create($requestData);
        
        $files = $request->file('image');
        
        foreach($files as $file)
        {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        
        $imgName = str_random(10).'.'.$extension;
        //dd($imgName);
            $file->move(public_path('/uploads'), $imgName);
            $imgObj = new Product_image;
            $imgObj->product_id = $product->id;
            $imgObj->image = $imgName;
            $imgObj->save();       
        }


         $product->categories()->attach($request->subcategory);



        return redirect('products')->with('flash_message', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $product = Product::with('productImage','productCategories','productCategories.category')->findOrFail($id);
        //dd($product);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::with('productCategories','productCategories.category'
            ,'categories','productImage','parentCategory')->findOrFail($id);
         $categories = Category::with('children')->get();

       
         //dd($product);

        return view('products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        // $requestData = $request->all();
        // //dd($requestData);
        $products = Product::findOrFail($id);

        $products->productname = $request->productname;
        $products->price = $request->price;
        $products->description = $request->description;
       // $products->categories->id = $request->subcategory_id;
        
        //dd($products);

      // $product_path =Product_image::delete(public_path() . '/uploads', $productimages->image);
      //dd($product_image);

     if($request->hasFile('image')){
       
       $imageName=Product_image::select('image')->where('product_id',$id)->get();
       //dd($imageName);

       foreach ($imageName as $img) {

        unlink(public_path('/uploads').'/'.$img->image);

        // dd(public_path('/uploads').'/'.$img->image);
           # code...
       }
      
      $productimages= Product_image::where('product_id',$id)->delete();


        $files = $request->file('image');
          
           
          foreach($files as $file)
         {
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $imgName = str_random(10).$extension;
            $file->move(public_path('/uploads'), $imgName);
            
            $imgObj = new Product_image;
            $imgObj->product_id = $products->id;
            $imgObj->image = $imgName;
            $imgObj->save(); 


         }
         
    }

        

     
       $products->save();

       // dd($products,$request->all());
       // dd($request->all());
        $products->categories()->sync([$request->subcategory_id]);
        // dd($products);
        
        

        return redirect('products')->with('message', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect('products')->with('message', 'Product deleted!');
    }
}
