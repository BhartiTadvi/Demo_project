<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
      $categories = Category::with('children')
                   ->where('parent_id',0)
                   ->get();
      return view('category.subcategory',compact('categories',$categories));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name'=>'required',
            'category_name'=>'required'
            ]);
        $subcategory = new Category();
        $subcategory->parent_id = $request->category_name;
        $subcategory->name = $request->subcategory_name;
        $result = $subcategory->save();
        if($result){
             return redirect('category')->with('success', 'Subcategory added successfully!');
                 }
    }

    /** Delete subcategory **/
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('category')->with('success', 'Subcategory deleted successfully!');
    }
}
