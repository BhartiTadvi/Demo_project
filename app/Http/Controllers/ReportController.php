<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use Illuminate\Http\Request;
class ReportController extends Controller
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
          $products = Product::Where('productname', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
              $products = Product::paginate($perPage);
        }
        return view('report.sale_report', compact('products'));
    }


    /** Show customer**/
    public function showCustomer(Request $request)
    {
       $keyword = $request->get('search');
      $perPage = 15;
       if (!empty($keyword)) {
          $users = User::Where('name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
       $users=User::paginate($perPage);
        }
      return view('report.customer_report', compact('users'));
    }
}
