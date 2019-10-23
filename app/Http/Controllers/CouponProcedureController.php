<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\CouponProcedure;
use Illuminate\Http\Request;

class CouponProcedureController extends Controller
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
            $couponprocedure=DB::select('CALL GetCoupons()');

            // $couponprocedure = CouponProcedure::where('title', 'LIKE', "%$keyword%")
            //     ->orWhere('code', 'LIKE', "%$keyword%")
            //     ->orWhere('discount', 'LIKE', "%$keyword%")
            //     ->orWhere('quantity', 'LIKE', "%$keyword%")
            //     ->orWhere('remaining_quantity', 'LIKE', "%$keyword%")
            //     ->orWhere('type', 'LIKE', "%$keyword%")
            //     ->latest()->paginate($perPage);
        } else {
            // $couponprocedure = CouponProcedure::latest()->paginate($perPage);
             $couponprocedure=DB::select('CALL GetCoupons()');

        }

        return view('coupon-procedure.index', compact('couponprocedure'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('coupon-procedure.create');
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
        $title=$request->title;
        $type=$request->type;
        $code=$request->code;
        $discount=$request->discount;
        $quantity=$request->quantity;
        $remaining_quantity=$request->remaining_quantity;

        //dd($request->all());
        $couponAdd = DB::insert("CALL InsertCoupons('$title','$type',
            '$code',$discount,$quantity, $remaining_quantity)");
        //CouponProcedure::create($requestData);

        return redirect('coupon-procedure')->with('flash_message', 'CouponProcedure added!');
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
        $couponprocedure = CouponProcedure::findOrFail($id);

        return view('coupon-procedure.show', compact('couponprocedure'));
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
        $couponprocedure = CouponProcedure::findOrFail($id);
        return view('coupon-procedure.edit', compact('couponprocedure'));
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
        $title=$request->title;
        $type=$request->type;
        $code=$request->code;
        $discount=$request->discount;
        $quantity=$request->quantity;
        $remaining_quantity=$request->remaining_quantity;
        $couponUpdate = DB::select('CALL UpdateCoupons(?,?,?,?,?,?,?)',[$title,$type,$code,$discount,$quantity,$remaining_quantity,$id]);
     
        return redirect('coupon-procedure')->with('flash_message', 'CouponProcedure updated!');
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
        // CouponProcedure::destroy($id);
        $couponDelete = DB::select('CALL DeleteCoupons(?)',[$id]);
        return redirect('coupon-procedure')->with('flash_message', 'CouponProcedure deleted!');
    }
}
