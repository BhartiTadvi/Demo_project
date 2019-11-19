<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\OrderDetail;
use DB;
use Charts;
use App\Coupon;
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

    public function showReport(Request $request)
    {
      
        $orderReport = DB::table('order_details')
                     ->select(DB::raw('count(transaction_status) as total, transaction_status'))
                     ->groupBy('transaction_status')
                     ->get();
       
        $transactionStatus = $orderReport->pluck('transaction_status');
        $total = $orderReport->pluck('total');
        $orderChart  =  Charts::create('pie', 'highcharts')
               ->title('Sales report')
               ->labels($transactionStatus)
               ->values($total)
               ->dimensions(500,300)
               ->responsive(false);

        $users = User::role('customer')->get();
        $userChart = Charts::database($users, 'bar', 'highcharts')
            ->title("User registered report")
            ->elementLabel("Total Users")
            ->dimensions(500, 300)
            ->responsive(false)
            ->groupByMonth(date('Y'), true);  

        $coupon = DB::table('coupon_codes')
                     ->select(DB::raw('quantity-remaining_quantity as couponused,code'))
                     ->get();
        $couponDetails = $coupon->pluck('couponused');
        $couponCode = $coupon->pluck('code');
        $couponChart  =  Charts::create('pie', 'highcharts')
               ->title('Coupons used')
               ->labels($couponCode)
               ->values($couponDetails)
               ->dimensions(500,300)
               ->responsive(false);          
      return view('report.report',compact('orderChart','couponChart','userChart'));
    }
}
