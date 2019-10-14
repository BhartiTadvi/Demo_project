<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\address;
use App\Country;
use App\State;
use Auth;
use Illuminate\Http\Request;

class addressController extends Controller
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
            $address = address::where('name', 'LIKE', "%$keyword%")
                ->orWhere('address1', 'LIKE', "%$keyword%")
                ->orWhere('address2', 'LIKE', "%$keyword%")
                ->orWhere('country', 'LIKE', "%$keyword%")
                ->orWhere('state', 'LIKE', "%$keyword%")
                ->orWhere('city', 'LIKE', "%$keyword%")
                ->orWhere('zipcode', 'LIKE', "%$keyword%")
                ->orWhere('mobileno', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $address = address::latest()->paginate($perPage);
        }

        return view('frontend.address.index', compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Country::get();
       // dd($countries);
        return view('frontend.address.create',compact('countries'));
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
        //$requestData = $request->all();
    // dd($request->country);
        $request->validate([
            'name'=>'required',
            'address1'=>'required',
            'address2'=>'required',
            'mobileno'=>'required|max:50'
            ]);
        $address = new address();
        $address->name = $request->name;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;
        $address->mobileno = $request->mobileno;
        // $address->user_id = Auth::user()->id;
        $address->user_id = Auth::user()->id;

        $result = $address->save();
       

        return redirect('myAddress')->with('flash_message', 'address added!');
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
        $address = address::findOrFail($id);

        return view('frontend.address.show', compact('address'));
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
        $address = address::findOrFail($id);
        $countries = Country::get();
        //dd($countries);


        return view('frontend.address.edit', compact('address','$countries'));
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
        
        $address = address::findOrFail($id);
        $address->update($requestData);

        return redirect('myAddress')->with('flash_message', 'address updated!');
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
        address::destroy($id);

        return redirect('address')->with('flash_message', 'address deleted!');
    }

    public function getState(Request $request){

      $country_id =$request->country_id;
    
     return $countries= State::where('countryID', $country_id)
                    ->get();
                    
                   // echo '<pre>';print_r($countries);die;
        return Response::json($countries);

    
    //dd($request->all());


   }

}
