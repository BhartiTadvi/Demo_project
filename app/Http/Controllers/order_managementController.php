<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\order_management;
use Illuminate\Http\Request;
use App\Order;
class order_managementController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View

     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $order_management = order_management::where('customer_details_with_address', 'LIKE', "%$keyword%")
                ->orWhere('Ordered products', 'LIKE', "%$keyword%")
                ->orWhere('pagecontent', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
             $orders=Order::with('products','products.product','orderDetail')->paginate($perPage);
        }

        return view('order_management.index', compact('orders'));
    }

    public function orderDetail($id)
    {
      $orders=Order::with('products','products.product','orderDetail','address')->find($id);
     return view('order_management.product_details',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('order_management.create');
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
      order_management::create($requestData);
      return redirect()->route('order_management.index')->with('flash_message', 'order_management added!');
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
     $order_management = order_management::findOrFail($id);
     return view('order_management.show', compact('order_management'));
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
     $order_management = order_management::findOrFail($id);
     return view('order_management.edit', compact('order_management'));
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
        $requestData = $request->all();
        $order_management = order_management::findOrFail($id);
        $order_management->update($requestData);
        return redirect()->route('order_management.index')->with('flash_message', 'order_management updated!');
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
       order_management::destroy($id);
       return redirect()->route('order_management.index')->with('flash_message', 'order_management deleted!');
    }
}
