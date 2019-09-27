  <?php $total=Session::get('total');
  ?>
  @extends('frontend.layouts.master')

@section('content')

  <section id="cart_items">
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
                <a href="">
                 <img src="{{asset('uploads/'.$item->options->product_image)}}" height="84" width="85" 
                  alt="">
                </a>
              </td>
              <td class="cart_description">
                <h4><a href="">{{$item->name}}</a></h4>
                <p>Web ID: 1089772</p>
              </td>
              <td class="cart_price" id="price{{$item->id}}" >
                <p>{{$item->price}}</p>
              </td>
              <td class="cart_quantity">
               

               <div class="cart_quantity_button">

             <a class="cart_quantity_up" href="javascript:void(0)" data-route="{{url('/cartincrementitem/')}}" data-increase="1" data-id="{{$item->rowId}}" id="{{$item->id}}"> + </a>
                
              <input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}" autocomplete="off" size="1" id="test{{$item->id}}" min="1">
             
                <a class="cart_quantity_down" href="javascript:void(0)" data-route="{{url('/cartdecrementitem/')}}" data-increase="0" data-id="{{$item->rowId}}" id="{{$item->id}}"> - </a>
               
                </div>
              </td>
              <td class="cart_total">
                <p class="cart_total_price" id="priceu{{$item->id}}" >
                  {{$item->price*$item->qty}}
               
                 </p>
              </td>
              <td class="cart_delete">
                <a class="cart_quantity_delete" href="{{url('cart/remove')}}/{{$item->rowId}}"><i class="fa fa-times"></i></a>
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
               <label>Use Coupon Code</label><br/>
               @foreach($coupons as $coupon)
                <input type="radio" class="coupon" name="coupon" data-id="{{$coupon->id}}">
                  {{$coupon->code}}
               @endforeach
              </li>
            </ul>
            <a class="btn btn-default update" href="">Apply coupon</a>
            <!-- <a class="btn btn-default check_out" href="">Continue</a> -->
          </div>
        </div>
        <div class="col-sm-6">
          
           
          <div class="total_area">
            <ul>
              
              <li>Cart Sub Total<span id="subTotal">{{$total}}</span></li>
                <li>Shipping Cost <span id="shippingCost">${{$total<500 ? 50 : 0}}</span></li>
                <li>Total <span id="grandTotal">${{$total<500 ? $total+50 : $total}}</span></li>
              
            </ul>
              <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
          </div>
          
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
          // alert('hi');
          //alert($('.cart_total_price').text());
        e.preventDefault();
        var id =$(this).attr("id"); 
        var rowId =$(this).data("id"); 
        var url = $(this).data('route');
        var  increase = $(this).data('increase');
        var  price = $('#price' + id).text(); 
        var  priceu = $('#priceu' + id).text(); 

         //alert(priceu);
        updateQty(url,increase,rowId,id, price,priceu);
      });

    $('.cart_quantity_down').on('click', function(e) {
        
        e.preventDefault();
        var id =$(this).attr("id"); 
        var rowId =$(this).data("id"); 
        var url = $(this).data('route');
       var  increase = $(this).data('increase');
        var  price = $('#price' + id).text(); 
       var  priceu = $('#priceu' + id).text();

         // alert(price);

      updateQty(url,increase,rowId,id, price,priceu);
      
    });
    
    function updateQty(url,increase,rowId,id,priceu,price){
    
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
                subTotal:subTotal
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
                 
                    $('#grandTotal').text(grandTotal);
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
            // $('.cart_quantity_down').css('cursor','allowed');
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
        var coupon_id =$(this).data("id"); 
       // alert(coupon_id);
      $.ajax({
        url:'{{url('/applycoupon')}}',
        data: 'coupon_id=' + coupon_id,
        success:function(response){
       // alert(res);
       console.log(response);
       // $('#cartTotal').html(response);
        }
      })
  });
        // cursor: default;
         


  });
</script>
  @endsection