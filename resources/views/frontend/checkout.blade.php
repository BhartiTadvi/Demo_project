  <?php 
  // $total=Session::get('total');
  //$totalamount=Session::get('totalamount');
   //dd(session('totalamount'));
  ?>
 @extends('frontend.layouts.master')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading"></h2>
			</div>
			<div class="checkout-options">
				<h3></h3>
				<ul class="nav">
					<li>
              <table class="table">
                                <thead>
                                    <tr id="address">
                                      <th class="address">Select address</th>
                                        <th class="address">Name</th>
                                        <th class="address">Mobile No</th>
                                        <th class="address">City</th>
                                        <th class="address">Zip code</th>
                                        <th class="address">Address 1</th>
                                        <th class="address">Address 2</th>
                                        <th class="address">Country</th>
                                        <th class="address">State</th>

                                    </tr>
                                </thead>
                                @foreach($addresses as $address)
                                <tbody>
                               
                                    <tr class=billingaddress>
                                      <td class="address">
                                    <input type="radio" name="address" class="billing" data-id="{{$address->id}}">
                                    <input type="hidden" name ="address_id" value="{{$address->id}}">
                                         </td>
                                        <td class="name">{{$address->name}}</td>
                                        <td class="mobileno">{{$address->mobileno}}</td>
                                        <td class="city">{{$address->city}}</td>
                                        <td class="zipcode">{{$address->zipcode}}</td>
                                        <td class="address1">{{$address->address2}}</td>
                                        <td class="address2">{{$address->address1}}</td>
                                        <td class="country">{{$address->country->country_name}}</td>
                                        <td class="state">{{$address->state->state_name}}</td>

                                    </tr>
                                </tbody>
                                @endforeach 
                                </table>				
					          </li>
					<!-- <li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li> -->
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form >
								<input type="text" placeholder="Display Name" value="{{Auth::user()->name}}">
								<input type="text" placeholder="email" value="{{Auth::user()->email}}" >
							
							</form>
						</div>
					</div>
					<div class="col-sm-9 clearfix">
						<div class="bill-to">
							<p>Billing Address</p>
							<div class="form-one" id="billing" >
							<form id="billing" method="POST" action="{{ route('placeorder.store') }}">
                         {{ csrf_field() }}
                  <!--  <input type="hidden" name ="address_id" value="{{$address->id}}"> -->
                   <input type="hidden" name ="user_id" value="{{Auth::user()->id}}">
                   <input type="hidden" name ="address_id" value="{{$address->id}}">
                   

                   <input type="text" placeholder="Name" name="name" class="name">
                                     {!! $errors->first('name', '<span class="error-message">:message</span>') !!}
									
								    <input type="text" placeholder="Phone number" name="phone_number" class="phone">
								     {!! $errors->first('phone_number', '<span class="error-message">:message</span>') !!}
            					   
            					    <input type="text" name="zip_code" placeholder="Zip / Postal Code *"
            					   class="zip">
            					    {!! $errors->first('zip_code', '<span class="error-message">:message</span>') !!}
                                  
                                    <input type="text" placeholder="city *"name="billing_city" class="city">
									 {!! $errors->first('billing_city', '<span class="error-message">:message</span>') !!}

                                     <input type="text" placeholder="address1 *"name="billing_address1" class="addreessline1">
									 {!! $errors->first('billing_address1', '<span class="error-message">:message</span>') !!}
									
									 <input type="text" placeholder="Address2 *"name="billing_address2"  class="addreessline2">
									
									 {!! $errors->first('billing_address2', '<span class="error-message">:message</span>') !!}
									 
                    <select class="country" name="country1" id="country">
										<option>-- Country--</option>
										@foreach($countries as $country)
                        
						            <option value={{$country->id}}>{{$country->country_name}}
									    </option>
										@endforeach
									</select><br/><br/>
									 {!! $errors->first('country', '<span class="error-message">:message</span>') !!}

									<select name="state1" class="state" id="state">
								
									<option value="{{$country->id}}" class="state" ></option>
									</select>
									 {!! $errors->first('state', '<span class="error-message">:message</span>') !!}
								

                @foreach($orders as $order)
                   <input type="hidden" name="order_id" value="{{$order->id}}">
                    <input type="hidden" name="created_at" value="{{$order->created_at}}">
                @endforeach
							</div>
					@if ($message = Session::get('success'))
		          <div class="alert alert-success">
		            <p>{{ $message }}</p>
		          </div>
		          @endif
							<div class="form-two">
								<p id="top">Shipping Address</p>
							
									  {{ csrf_field() }}
							       <input type="text" class="form" placeholder="Name" name="full_name" id="fullname">
							          {!! $errors->first('full_name', '<span class="error-message">:message</span>') !!}

									<input type="text" class="form" placeholder="Phone number" name="phone" id="Phone_number">
									 {!! $errors->first('phone', '<span class="error-message">:message</span>') !!}
									<input type="text" class="form" placeholder="Zip / Postal Code *"name="zipcode" id="zipcode">
									 {!! $errors->first('zipcode', '<span class="error-message">:message</span>') !!}
									
									<input type="text" class="form" placeholder="city *"name="city" id="city">
									
									 {!! $errors->first('city', '<span class="error-message">:message</span>') !!}
									
									 <input type="text" class="form" placeholder="Address1 *"name="address1" id="address1">
									
									 {!! $errors->first('address1', '<span class="error-message">:message</span>') !!}
									 <input type="text" class="form" placeholder="Address2 *"name="address2" id="address2">
									
									 {!! $errors->first('address2', '<span class="error-message">:message</span>') !!}
            					  <select class="country" name="country" id="country1">
										<option>-- Country--</option>
										@foreach($countries as $country)
						              <option value={{$country->id}}>{{$country->country_name}}
									    </option>
										@endforeach
									</select><br/><br/>
									 {!! $errors->first('country', '<span class="error-message">:message</span>') !!}
									
									<select name="state" class="state1" id="state1">
									<option value="{{$states[0]->id}}"></option>
									</select>
									 {!! $errors->first('state', '<span class="error-message">:message</span>') !!}
							</div>
						</div>
					</div>
					<div class=col-sm-8></div>

						<div class="order-message">
							<label><input type="checkbox" class="shipping"> Shipping to bill address</label>
						</div>	
					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
          <thead>
            <tr class="cart_menu">
              <td class="image">Item</td>
              <td class="description"></td>
              <td class="price">Price</td>
              <td class="quantity">Quantity</td>
              <td class="total">Total</td>
              <td></td>
            </tr>
          </thead>
          
     
          @foreach($cart as $item)
          <tbody id="updateQuantity">
            <tr>
              <td class="cart_product">
                <a href="">
              
                 <a href="">
                <img src="{{$item['product_image']}}" height="84" width="85" 
                  alt="img">
                </a>
                </a>
              </td>
              <td class="cart_description">
                <h4><a href="">{{$item['product_name']}}</a></h4>
               coupon
                <input type="hidden" name="product_id[]" value="{{$item['product_id']}}">
                 <input type="hidden" name="productname[]" value="{{$item['product_name']}}">

              </td>
              <td class="cart_price">
              <input type="hidden" name="price" value="{{$item['product_price']}}">

                <p>{{$item['product_price']}}</p>
              </td>
              <td class="cart_quantity">
               

               <div class="cart_quantity_button">

          
            <label class="cart_up" for="disabled">+</label><br>
             <input type="hidden" name="quantity1[]" value=" {{$item['quantity']}}">
              <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="1" min="1" disabled>
               <label class="cart_down" for="disabled">-</label><br>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price">
                  {{$item['product_price']*$item['quantity']}}
                 </p>
              </td>
              <td class="cart_delete">
              <label class="cart_up" for="disabled" style="    margin-bottom: -8px"><i class="fa fa-times"></i></label>

              </td>
            </tr>
          </tbody>
          @endforeach
        </table>

				<div class="col-sm-6"></div>
				<div class="col-sm-6">
	          	 <div class="total_area">
	            <ul>
	                   <li>Cart Sub Total<span id="subTotal">{{$subTotal}}</span>
                      <input type="hidden" name ="subtotal" value="{{$subTotal}}">    
                     </li>
               <li>Shipping Cost <span id="shippingCost">${{$ShippingCost}}</span>
               <input type="hidden" name="discount_amount" value="{{$discount_amount}}">
                <input type="hidden" name="coupon_id" value="{{$coupon_id}}">

                <input type="hidden" name ="shippingcost" value="{{$subTotal<500 ? 50 : 0}}">  
                </li>
               <input type="hidden" name ="coupon" value="                {{$coupon}}">  

                <li>Total <span id="grandTotal">
                  ${{$grandTotal}}</span>
                   <input type="hidden" name ="grandtotal" value="{{$grandTotal}}">  
                </li>
	            </ul>
	          </div>
	        </div>
				
			</div>
			<div class="payment-options">
					<span>
				 <label>
          <input type="hidden" name="paymentmode" value="cash on delivery" />
          <input type="radio" name="payment" id="cod"> Cash On Delivery</label>
					</span>
					<span>
						<label>
            <input type="hidden" name="paymentmode1" value="paypal" />
  
              <input type="radio" name="payment"  id ="paypal"> Paypal</label>
					</span>

			
			<input type="submit" id="hideplaceorder" name="submit" class="check_out btn-block"style="width: 101px;" value="placeorder"/>
			<button type="submit" value="1" id="showcod" name="submit" class="check_out btn-block"style="width: 150px;"> Cash on delivery </button>

			
		   <!--  <input type="submit"  name="submit" class="check_out btn-block"style="width: 101px;" value="placeorder"/> -->
		   
       <!-- <button type="submit" id="showpaypal" formaction="" name="submit" class="check_out btn-block"style="width: 120px;" >Paypal
       </button> -->
       <button  id="showpaypal" class="btn btn-primary btn-md" value="0" formaction="{{route('addmoney.paypal')}}" id="formButton" name="submit" style="margin-left:50px;margin-bottom:10px;" formmethod="POST">Pay with Paypal</button>
		    
   			</form>
				</div>
			</div>
	</section> <!--/#cart_items-->
@endsection

@section('script')
 <script type="text/javascript">
     
  $(document).ready(function(){
    //       $('.cart_quantity_up').on('click', function(e) {
    //       // alert('hi');
    //       //alert($('.cart_total_price').text());
    //     e.preventDefault();
    //     var id =$(this).attr("id"); 
    //     var rowId =$(this).data("id"); 
    //     var url = $(this).data('route');
    //     var  increase = $(this).data('increase');
    //     var  price = $('#price' + id).text(); 
    //     var  priceu = $('#priceu' + id).text(); 
    //      var coupontype =$('#discounttype').val();
    //     var couponvalue =$('#discountvalue').val();

       
       
    //   updateQty(url,increase,rowId,id, price,priceu,coupontype,couponvalue);
      
    // });

    // $('.cart_quantity_down').on('click', function(e) {
        
    //     e.preventDefault();
    //     var id =$(this).attr("id"); 
    //     var rowId =$(this).data("id"); 
    //     var url = $(this).data('route');
    //     var  increase = $(this).data('increase');
    //     var  price = $('#price' + id).text(); 
    //     var  priceu = $('#priceu' + id).text();
        
    //      // alert(price);

      
    //   updateQty(url,increase,rowId,id, price,priceu,coupontype,couponvalue);
      
    // });
      
   
    
    // function updateQty(url,increase,rowId,id,priceu,price,coupontype,couponvalue){
    
    //       var qty = $('#test' + id).val();
    //       var qtyval="";
    //       var subTotal = $('#subTotal').text();
    //      if (qty) {
    //     qtyval = qty;
    //     }

    //     $.ajax({
    //         type: 'POST',
    //         url: url,
    //         dataType: 'json', 
    //          headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         data: {
    //             cart_qty: qtyval,
    //             id: id,
    //             increase: increase,
    //             rowId: rowId,
    //             price: price,
    //             priceu: priceu,
    //             subTotal:subTotal,
                
    //         },
    //         success:function(response){

    //              console.log(response);


    //              console.log(response.totalamount);
                 

    //              var newSubTotal = response.subTotal;
    //              var grandTotal = 0;
    //              var shippingCost = 50;
    //               if( newSubTotal < 500)
    //               { 
    //                 grandTotal = newSubTotal + shippingCost;
    //                 $('#subTotal').text(newSubTotal);
    //                 $('#shippingCost').text(shippingCost);
    //               }else{
    //                 grandTotal = newSubTotal;
    //                 $('#subTotal').text(newSubTotal);
    //                 $('#shippingCost').text(0);
    //               }
                    
    //                 $('#grandTotal').empty();
    //                 $('#grandTotal').text(response.totalamount<500 ? response.totalamount+50 :response.totalamount);
    //                 // $('#grandTotal').text(grandTotal);
    //                 $('#test'+id).val(response.quantity.qty);
    //                 $('#priceu'+id).text(response.updateprice);
    //           }
    //         });
    //   } 


       $('.billing').on('click', function(e) {

       	  var $row = $(this).closest("tr");    
          var $name = $row.find(".name").text(); 
          var $mobileno = $row.find(".mobileno").text();
          var $city = $row.find(".city").text(); 
          var $zipcode = $row.find(".zipcode").text(); 
          var $address1 = $row.find(".address1").text(); 
          var $address2= $row.find(".address2").text(); 
          var $country= $row.find(".country").text(); 
          var $state= $row.find(".state").text(); 
          //alert($state);   
         if($(this).is(":checked"))
         {
     
         	//alert('hi');
           var name = $('.name').val($name);
           var mobileno = $('.phone').val($mobileno);
           var city = $('.city').val($city);
           var zipcode = $('.zip').val($zipcode);
           var address1 = $('.addreessline1').val($address1);
           var address2 = $('.addreessline2').val($address2);
           var country =$('.country :selected').text($country);
           var state = $('.state :selected').text($state);

         }
          else{
           var name = $('.name').val();
           var mobileno = $('.phone').val();
           var city = $('.city').val();
           var zipcode = $('.zip').val();
           var address1 = $('.addreessline1').val();
           var address2 = $('.addreessline2').val();
           var country =$('.country :selected').text();
           var state = $('.state :selected').text();
           }

       });
       

        $('.shipping').on('click', function(e) {

           var shippingname = $('.name').val();
           var shippingphone = $('.phone').val();
           var shippingcity = $('.city').val();
           var shippingzip = $('.zip').val();
           var shippingaddress1 = $('.addreessline1').val();
           var shippingaddress2 = $('.addreessline2').val();
           var shippingcountry = $('.country :selected').text();
           var shippingstate = $('.state :selected').text();

           //alert(shippingname);

           if($(this).is(":checked"))
           {
           var name = $('#fullname').val(shippingname);
           var mobileno = $('#Phone_number').val(shippingphone);
           var city = $('#city').val(shippingcity);
           var zipcode = $('#zipcode').val(shippingzip);
           var address1 = $('#address1').val(shippingaddress1);
           var address2 = $('#address2').val(shippingaddress2);
           var country =$('.country1 :selected').text(shippingcountry);
           var state = $('.state1 :selected').text(shippingstate);
           }
           else{
           var name = $('#fullname').val();
           var mobileno = $('#Phone_number').val();
           var city = $('#city').val();
           var zipcode = $('#zipcode').val();
           var address1 = $('#address1').val();
           var address2 = $('#address2').val();
           var country =$('.country1 :selected').text();
           var state = $('.state1 :selected').text();
           }

         });
        $('#country1').on('change', function(e){
      
    var country_id = e.target.value;
      // alert('hi');
    console.log(country_id);
    $.get('/get/states/?country_id=' + country_id, function(response){
    $('#state1').empty();
    $.each(response, function(index, stateObj){
    $('#state1').append('<option value="'+ stateObj.id +'">'+ stateObj.state_name+'</option>');
      });
     });
   });
    
  //    $("#CartMsg").hide();
    //$('#CartTotal').hide();
    $('#showcod').hide();
		$('#cod').click(function() {
		
		$('#showcod').show();
		$('#showpaypal').hide(); 

		});
		 $('#cod').click(function(){
       $('#hidecod').hide();
       });
       $('#paypal').click(function(){
       $('#hidecod').hide();
       });

       $('#cod').click(function(){
       $('#hideplaceorder').hide();
       });
       
       $('#paypal').click(function(){
       $('#showpaypal').show();
       $('#showcod').hide();
       $('#hideplaceorder').hide();


       });

     $('#country').on('change', function(e){
      
    var country_id = e.target.value;
      // alert('hi');
    console.log(country_id);
    $.get('/get/states/?country_id=' + country_id, function(response){
    $('#state').empty();
    $.each(response, function(index, stateObj){
    $('#state').append('<option value="'+ stateObj.id +'">'+ stateObj.state_name+'</option>');
      });
     });
   });
     

});

   



       
   
  
  </script>
@endsection
