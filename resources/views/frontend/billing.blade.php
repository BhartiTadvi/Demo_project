@foreach($addresses as $address)
<form  method="POST" action="{{ url('/placeorder/store') }}">

     <input type="text" placeholder="Name" value="{{$address->name}}" name="name">								
								
     <input type="text" value="{{$address->mobileno}}" placeholder="Phone number" name="phone">
            					   								
     <input type="text" placeholder="Zip / Postal Code *"
      value="{{$address->zipcode}}" >
                                     
     <input type="text" placeholder="city *"name="cityb" value="{{$address->city}}">
									
     <input type="text" placeholder="Address1 *"name="billing_address1" value="{{$address->address1}}">
									 
									
	 <input type="text" placeholder="Address2 *"name="billing_address2" value="{{$address->address2}}">
									
	 <input type="text" placeholder="Address2 *"name="billing_address2" value="{{$address->country->country_name}}">

	 <input type="text" placeholder="Address2 *"name="billing_address2" value="{{$address->state->state_name}}">
 </form>
									

@endforeach							
