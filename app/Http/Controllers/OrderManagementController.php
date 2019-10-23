<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;

class OrderManagementController extends Controller
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
            $orders = Order::where('id', 'LIKE', "%$keyword%")
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
    
    public function editOrder($id)
    {
        $orderDetails=OrderDetail::find($id);
       
        return view('order_management.editorder',compact('orderDetails'));
    }
}
