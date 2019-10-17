<?php
namespace App\Http\Controllers\Coupon;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Coupon;
use Illuminate\Http\Request;
class CouponController extends Controller
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
            $coupon = Coupon::where('title', 'LIKE', "%$keyword%")
                ->orWhere('code', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('discount', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $coupon = Coupon::latest()->paginate($perPage);
        }
        return view('coupon.index', compact('coupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('coupon.create');
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
            'title'=>'required', 
            'code'=>'required||unique:coupons,code', 
            'discount'=>'required',
            'quantity'=>'required', 
            'type'=>'required'
             ]);
        $requestData = $request->all();
        Coupon::create($requestData);
        redirect()->route('coupon.index')->with('success', 'Coupon added!');
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
        $coupon = Coupon::findOrFail($id);

        return view('coupon.show', compact('coupon'));
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
        $coupon = Coupon::findOrFail($id);
        return view('coupon.edit', compact('coupon'));
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
            'title'=>'required', 
            'code'=>'required', 
            'type'=>'required', 
            'discount'=>'required', 
             ]);
        $requestData = $request->all();
        $coupon = Coupon::findOrFail($id);
        $coupon->update($requestData);
        return redirect()->route('coupon.index')->with('success', 'Coupon updated!');
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
        Coupon::destroy($id);
        return redirect()->route('coupon.index')->with('success', 'Coupon deleted!');
    }
}

