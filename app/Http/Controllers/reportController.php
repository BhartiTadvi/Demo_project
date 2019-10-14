<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Product;
use App\User;

use Illuminate\Http\Request;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
          $products = Product::orWhere('Ordered products', 'LIKE', "%$keyword%")
                ->orWhere('pagecontent', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {

              $products = Product::paginate($perPage);

        }

        // dd($orders[0]->products[0]->product->productname);
        //dd($orders[0]->products[0]->quantity);
        // dd($orders[0]->products[0]->product->price);

        return view('report.sale_report', compact('products'));
    }

     public function showCustomer()
    {
        $perPage = 15;
        $users=User::paginate($perPage);
       return view('report.customer_report', compact('users'));

    }


   
}
