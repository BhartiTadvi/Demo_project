<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage =5;
    if (!empty($keyword)) {

            $category = Category::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
            $categories = Category::where('parent_id',0)->get();
        } else {
         $category = Category::latest()->paginate($perPage);
         $categories = Category::where('parent_id',0)->get();
     }
     return view('category.index', compact('category','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('category.create');
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
        $request->validate([
            'category_name'=>'required', 
            ]);
        $category = new Category();
        $category->name = $request->category_name;
        $result = $category->save();
        if($result){
         return redirect()->route('category.index')->with('success', 'Category added successfully');
                 }
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
     $categories = category::with('children')->findOrFail($id);
        return view('category.show', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        //$category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
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
        $request->validate([
            'category_name'=>'required', 
            ]);
       $category = Category::findOrFail($id);
       $category->name = $request->category_name;
       $category->status = $request->status;
         if($category->save())
        {
          return redirect()->route('category.index')->with('success', 'Category updated successfully');
        }
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
        Category::destroy($id);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
   /** Get subcategory from category**/
   public function getSubCategory(Request $request){
      $category =$request->category_id;
      $subcategories= Category::where('parent_id', '=', $category)
                    ->get();
        return Response::json($subcategories);
   }
}
