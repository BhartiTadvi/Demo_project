<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Address;
use App\Country;
use App\State;
use Auth;
use Response;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $perPage = 25;
        $address = Address::latest()->paginate($perPage);
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
        $request->validate([
            'name'=>'required',
            'address1'=>'required',
            'address2'=>'required',
            'mobileno'=>'required|max:50'
            ]);
        $address = new Address();
        $address->name = $request->name;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->country_id = $request->country;
        $address->state_id = $request->state;
        $address->city = $request->city;
        $address->zipcode = $request->zipcode;
        $address->mobileno = $request->mobileno;
        $address->user_id = Auth::user()->id;
        $result = $address->save();
        return redirect()->route('myaddress')->with('flash_message', 'address added!');
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
        $address = Address::findOrFail($id);
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
        $address = Address::findOrFail($id);
        $countries = Country::get();
        $states = State::get();
        return view('frontend.address.edit', compact('address','countries','states'));
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
        $address = Address::findOrFail($id);
        $address->update($requestData);
        return redirect()->route('myaddress')->with('success', 'Address updated successfully!');
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
        Address::destroy($id);
         return redirect()->route('myaddress')->with('success', 'Address deleted successfully!');
    }
   
    public function getState(Request $request){
      $country_id =$request->country_id;
      $countries= State::where('countryID', $country_id)
                    ->get();
        return Response::json($countries);

   }

}


