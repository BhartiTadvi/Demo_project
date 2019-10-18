  <?php 
  $total=Session::get('total');
  ?>
  @extends('frontend.layouts.master')

@section('content')
 <form  method="POST" action="{{ route('create.checkout') }}">
  <section id="cart_items">
    {{ csrf_field() }}
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
          <li><a href="#">Home</a></li>
          <li class="active">Shopping Cart</li>
        </ol>
      </div>
      @if(Cart::content()->count()!=0)
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
          @foreach($data as $item)
          <tbody id="updateQuantity">
            <tr>
              <td class="cart_product">
                <input type="hidden" name="product_image[]" value="{{asset('uploads/'.$item->options->product_image)}}">
                <a href="">
                 <img src="{{asset('uploads/'.$item->options->product_image)}}" height="84" width="85" 
                  alt="">
                </a>
              </td>
              <td class="cart_description">
                <input type="hidden" name="product_name[]" value="{{$item->name}}">
                 <input type="hidden" name="product_id[]" value="{{$item->id}}">
                <h4><a href="">{{$item->name}}</a></h4>
                <p>Web ID: 1089772</p>
              </td>
              <td class="cart_price" id="price{{$item->id}}" >
                <input type="hidden" name="product_price[]" value="{{$item->price}}">
                <p>{{$item->price}}</p>
              </td>
              <td class="cart_quantity">
               <div class="cart_quantity_button">

             <a class="cart_quantity_up" href="javascript:void(0)" data-route="{{route('cart.increment')}}" data-increase="1" data-id="{{$item->rowId}}" id="{{$item->id}}"> + </a>
                
              <input class="cart_quantity_input" type="text" name="quantity[]" value="{{$item->qty}}" autocomplete="off" size="1" id="test{{$item->id}}" min="1">
                <a class="cart_quantity_down" href="javascript:void(0)" data-route="{{route('cart.decrement')}}" data-increase="0" data-id="{{$item->rowId}}" id="{{$item->id}}"> - </a>
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price" id="priceu{{$item->id}}" >
                  {{$item->price*$item->qty}}
                 </p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href="{{ route('cart.remove', ['id'=>$item->rowId])}}"><i class="fa fa-times"></i></a>
              </td>
            </tr>
          </tbody>
          @endforeach
        </table>
      </div>
    </div>
  </section> <!--/#cart_items-->

  <section id="do_action">
    <div class="container">
      <div class="heading">
        <h3>What would you like to do next?</h3>
        <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
      </div>
      <div class="row">
        <div class="col-sm-6">
           <div class="chose_area">
                
            <ul class="user_option">
              <li>
              <input type="hidden" id="coupon_id" name="coupon_id">
               <label>Use Coupon Code</label><br/>
               <input type="text" class="coupon_code" name="coupon"/>
              </li>
            </ul>
            <span class="error-message" id="invalid_coupon" style="margin-left: 43px;">
                </span><br/>
            <input type="button" class="btn btn-default update coupon" value="Apply coupon">

            <input type="button" class="btn btn-default update" id="cancelcode" value="Cancel" style="display:none">
          </div>
        </div>
        <div class="col-sm-6">
          <div class="total_area">
            <ul>
             <input type="hidden" name="subTotal" value="{{$total}}">
              <li>Cart Sub Total<span id="subTotal">{{$total}}</span></li>
             <input type="hidden" name="ShippingCost" value="{{$total<500 ? 50 : 0}}">
                <li>Shipping Cost <span id="shippingCost">{{$total<500 ? 50 : 0}}</span></li>
                  <input type="hidden" id="discounttype" name="discounttype">
                  <input type="hidden" id="discountvalue" name="discountvalue">
                <li>Discount Coupon <span id="discountamount">0</span></li>
           <input type="hidden" name="grandTotal" id="grandTotal1">
                <li>Total <span id="grandTotal">
                  {{$total<500 ? $total+50 : $total}}</span></li>
            </ul>
           <input type="submit" name="checkout" class="btn btn-default check_out" value="Checkout">
            </div>
                </form>
        </div>
      </div>
    </div>
    @else
    <div>continue shipping</div>
    @endif
  </section><!--/#do_action-->
  @endsection

  @section('script')
   <script>
 $(document).ready(function(){
      $('.cart_quantity_up').on('click', function(e) {
        e.preventDefault();
        var id =$(this).attr("id"); 
        var rowId =$(this).data("id"); 
        var url = $(this).data('route');
        var  increase = $(this).data('increase');
        var  price = $('#price' + id).text(); 
        var  priceu = $('#priceu' + id).text(); 
        var coupontype =$('#discounttype').val();
        var couponvalue =$('#discountvalue').val();
        updateQty(url,increase,rowId,id, price,priceu,coupontype,couponvalue);
      });

    $('.cart_quantity_down').on('click', function(e) {
        
        e.preventDefault();
       var id =$(this).attr("id"); 
       var rowId =$(this).data("id"); 
       var url = $(this).data('route');
       var  increase = $(this).data('increase');
       var  price = $('#price' + id).text(); 
       var  priceu = $('#priceu' + id).text();
       var coupontype =$('#discounttype').val();
      var couponvalue =$('#discountvalue').val();
      updateQty(url,increase,rowId,id, price,priceu,coupontype,couponvalue);
      
    });
    
    function updateQty(url,increase,rowId,id,priceu,price,coupontype,couponvalue){
          var qty = $('#test' + id).val();
          var qtyval="";
          var subTotal = $('#subTotal').text();
         if (qty) {
        qtyval = qty;
        }
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json', 
             headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                cart_qty: qtyval,
                id: id,
                increase: increase,
                rowId: rowId,
                price: price,
                priceu: priceu,
                subTotal:subTotal,
                coupontype:coupontype,
                couponvalue:couponvalue
            },
            success:function(response){
                 console.log(response);
                 var newSubTotal = response.subTotal;
                 var grandTotal = 0;
                 var shippingCost = 50;
                  if( newSubTotal < 500)
                  { 
                    grandTotal = newSubTotal + shippingCost;
                    $('#subTotal').text(newSubTotal);
                    $('#shippingCost').text(shippingCost);
                  }else{
                    grandTotal = newSubTotal;
                    $('#subTotal').text(newSubTotal);
                    $('#shippingCost').text(0);
                  }
                    $('#discountamount').empty();
                    $('#discountamount').text(0);

                    $('#discountamount').text(response.couponvalue);
                    $('#grandTotal').empty();
                    $('#grandTotal').text(response.total);
                    //$('#grandTotal').text(response.total);
                    $('#grandTotal1').val(response.total);


                    $('#test'+id).val(response.quantity.qty);
                    $('#priceu'+id).text(response.updateprice);
              }
            });
      }  
    
        $('.cart_quantity_up').on('click',function(){
          var quantity=$('.cart_quantity_input').val();
          if(quantity >1) 
          {
           $('.cart_quantity_down').removeAttr('disable');
          }             

        });

         $('.cart_quantity_down').on('click',function(){
         var quantity=$('.cart_quantity_input').val();
           console.log(quantity);
        if(quantity == 1){
                $('.cart_quantity_down').attr('disable','true');
             }

        });
        
        $('.coupon').click(function(){

         
          var coupon_code =$('.coupon_code').val();
          var subTotal = $('#subTotal').text();
          $.ajax({
           
           data: {'coupon_code':coupon_code,'subTotal':subTotal},
           type: 'post',
           url: "{{route('coupon')}}",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success:function(response){
              console.log(response);
            var invalidCoupon = response.error_message;
            if(invalidCoupon){
               $('#invalid_coupon').text(response.error_message);
            }else{
              
         $('.coupon').hide();
         $('#cancelcode').show();
         $('#discountamount').text(0);
         $('#discountamount').empty();
         $('#discountamount').append(response.discount);
         $('#grandTotal').empty();
         $('#grandTotal').append(response.total<500 ? response.total+50 :response.total);
         $('#grandTotal1').val(response.total<500 ? response.total+50 :response.total);
         $('#coupon_id').val(response.coupon_id);
         $('#discounttype').val(response.discounttype);
         $('#discountvalue').val(response.discount);
         $('#invalid_coupon').text('');


            }
          }
        });
        });

        $('#cancelcode').click(function(){

          $('.coupon').show();
          $('#cancelcode').hide();
          var subTotal = $('#subTotal').text();
          $.ajax({
           data: {'subTotal':subTotal},
           type: 'post',
           url: "{{route('cancel.coupon')}}",
           headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
            success:function(response){
              console.log(response);
              $('#grandTotal').empty();
              $('#grandTotal').text(response.total<500 ? response.total+50 :response.total);
              $('#discountamount').text(response.discountCoupon);


       }
        });
      });
         
        

  });
</script>
  @endsection