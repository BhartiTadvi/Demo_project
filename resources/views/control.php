@foreach($categories as $category)
      @foreach($category->children as $children)
       $("#{{$children->id}}").click(function(){
         var category = {{$children->id}};  
   
       $.ajax({
	      type: 'get',
	      dataType: 'html',
	      url: '{{url('/productscateory')}}',
	      data: 'category_id=' + category,
	      success:function(response){
	        console.log(response);
               
	        $("#products").html(response);
	        $.each(response, function(index, productObj){

            //alert(productObj.productname);
           });
	      }
       });
    });
         @endforeach
        @endforeach

        <?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Cart;
use App\products;
use App\orders;
class cartController extends Controller
{
    //
    public function index(){
      $cart = Cart::content();
      return view('cart.index', [
        'data' => $cart,
      
     ]);
    }
 
    public function addItem($id){
      $pro = products::find($id);
    $add = Cart::add(['id' => $pro->id, 'name' => $pro->pro_name,
      'qty' => 1, 'price' => $pro->pro_price,
    'options' =>[
      'img' => $pro->pro_img,
      'size' => 'large'
      ]]);
     if($add){
       return view('cart.index',[
         'data' => Cart::content()
       ]);
     }
    }
    public function update(Request $request){
      $qty = $request->newQty;
      $rowId = $request->rowID;
    
      Cart::update($rowId,$qty);
      echo "Cart updated successfully";
    }
    public function removeItem($id){
      Cart::remove($id);
      return back();
    }
}

public function cartStore(Request $request)
    {   
        $q=1;
        $id = $request->id;
        $product= Product::find($id);
        $product_img = DB::table('product_img')->where('product_id', $id)->first();
        //dd($product_img);
        foreach(Cart::content() as $row){
            if($row->id == $id){

                $price= $row->price+$product->product_price;
               
                
               
                Cart::update($row->rowId,['price'=>$price]);
                //dd('existing product');
            }
            else{
                 goto xyz;
            } 
         }
        xyz:{ $cartitem=Cart::add(['id' => $id, 'name' => $product->product_name, 'qty' => 1, 'price' =>$product->product_price, 'options' => ['img' => $product_img->product_img]]);
                 //dd('new product');
            
            }
        return redirect('productinfo');

    }
    $('#upCart<?php echo $i;?>').on('change keyup', function(){
  var newqty = $('#upCart<?php echo $i;?>').val();
  var rowId = $('#rowId<?php echo $i;?>').val();
  var proId = $('#proId<?php echo $i;?>').val();
   if(newqty <=0){ alert('enter only valid qty') }
  else {
    $.ajax({
        type: 'get',
        dataType: 'html',
        url: '<?php echo url('/cart/update');?>/'+proId,
        data: "qty=" + newqty + "& rowId=" + rowId + "& proId=" + proId,
        success: function (response) {
            console.log(response);
            $('#updateDiv').html(response);
        }
    });
  }



   
                  @foreach($productwish as $data)
                     {{$data->product_id}}
                    {{$data->user_id}}
                    {{$data->id}}

                    {{$data->product->productImage[0]->image}}

                    {{$data->product->productname}}
                    {{$data->product->price}}

                      @endforeach
                        


                          @extends('frontend.layouts.master')

@section('content')

<section id="cart_items">
    <div class="container">
      <div class="breadcrumbs">
        <ol class="breadcrumb">
         
        </ol>
      </div><!--/breadcrums-->

      <div class="step-one">
        <h2 class="heading"></h2>
      </div>
      <div class="checkout-options">
        <h3></h3>
        <p>Checkout options</p>
        <ul class="nav">
          <input type="radio" name="billing" id="billing"><br>

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
                <input type="text" placeholder="Display Name" value="">
                
                <input type="text" placeholder="User Name" value="" >
              
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> <!--/#cart_items-->
@endsection

@section('script')
 <script type="text/javascript">
     
    
      $('#billing').on('click', function(e){
        // alert('hi');
        var user_id =$(this).data("id"); 
        $.ajax({
        data: {'user_id':user_id},
        type: 'get',
        url: "{{route('getBillingAddress')}}",
       
        success: function (response) {
        
             //alert(response);

            $('#billing').empty();

             $.each(response, function(index, subcatObj){

            $('#billing').append('<input value="' + subcatObj.address1 + '">');
            $('#billing').append('<input value="' + subcatObj.address2 + '">');

            $('#billing').append('<input value="' + subcatObj.country + '">');

            $('#billing').append('<input value="' + subcatObj.state + '">');
            $('#billing').append('<input value="' + subcatObj.city + '">');

           });
            // $('#category_meal_list').replaceWith(response); 
        }
      });
      });
            $('.shipping').on('click', function(e){
        var user_id =$(this).data("id"); 
        $.ajax({
        data: {'user_id':user_id},
        type: 'get',
        url: "{{route('getshippingAddress')}}",
       
        success: function (response) {
        
             //alert(response);

            $('#shipping').empty();

             $.each(response, function(index, subcatObj){

            $('#shipping').append('<input value="' + subcatObj.address1 + '">');
            $('#shipping').append('<input value="' + subcatObj.address2 + '">');

            $('#shipping').append('<input value="' + subcatObj.country + '">');

            $('#shipping').append('<input value="' + subcatObj.state + '">');
            $('#shipping').append('<input value="' + subcatObj.city + '">');

           });
            // $('#category_meal_list').replaceWith(response); 
        }
      });
      });


        
  
  </script>
@endsection



<?php
Route::get('changepassword', function() {
    $user = App\User::where('email', 'admin@laravel.com')->first();
    $user->password = Hash::make('123456');
    $user->save();
 
    echo 'Password changed successfully.';
});
?>

SELECT order_details.transaction_status FROM order_details INNER JOIN user_orders ON order_details.order_id=user_orders.id





?>

 <strong id="shopping"> Welcome to My Shopping Cart.</strong>
        To log in when visiting our site just  click log in or My account at the top of every page, and then enter your email address and password.
        <br/>
        Use the following values when  prompted to log in.

        <hr/>
        Email-
        Password-


        ublic function build()
    {

        $showtemplates = EmailTemplate::where('template_keys',$this->data['template_keys'])->get();

        foreach($showtemplates as $showtemplate){
        $template = htmlspecialchars_decode($showtemplate->email_template_content);
        }

        $template = $this->replace($template,$this->data);

        return $this->from('eshopper@gmail.com')->subject($showtemplate->email_subject)->view('dynamic_mail_template')->with('template',$template);
    }

    public function replace($template,$data){
            foreach( $data as $key => $value){
            $template = str_replace('{{'.$key.'}}', $value,$template);     
            }
            //dd($template);
            return $template;

    }

}
Expected response code 354 but got code "550", with message "550 5.7.0 Requested action not taken: too many emails per second "



@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
           
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">Sales Report</div>
                    <div class="box-body">
                       

                        <form method="GET" action="{{ url('/order_management') }}" accept-charset="UTF-8" class="form-inline my-2 my-lg-0 float-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                               
                            </div>
                             <span class="input-group-append">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </span>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                         <th class="order">Product Id</th>
                                        <th class="order">Product Name</th>
                                        <th class="order">Total Quantity</th>
                                         <th class="order">Unit price</th>
                                    </tr>
                                </thead>
                                @foreach($orders as $order)

                               
                                <tbody>
                                    <tr>
                                        <td class="order">
                                          {{$order->id}}
                                        </td>
                                        <td class="order">
                                      @foreach($order->products as $productreport)
                                         {{$productreport->product->productname}}
                                     @endforeach
                                        </td>
                                        <td class="order">
                                        @foreach($order->products as $product)
                                         {{$product->quantity}}
                                       @endforeach

                                        </td>
                                        <td class="order">
                                        @foreach($order->products as $productreport)
                                         {{$productreport->product->price}}
                                     @endforeach
                                        </td>
                                        
                                    </tr>
                                </tbody>
                              @endforeach
                     </table>
                     
                            <div class="pagination-wrapper">  </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

 $check = DB::table('coupons')
        ->where('coupon_code',$code)
        ->get();
        if(count($check)=="1"){
            //ok
            $user_id = Auth::user()->id;
            $check_used = DB::table('used_coupons')
            ->where('user_id',$user_id)
            ->where('coupon_id',$check[0]->id)
            ->count();
           if($check_used=="0"){
                //insert used one
            $used_add = DB::table('used_coupons')
            ->insert([
                    'coupon_id' => $check[0]->id,
                    'user_id' => $user_id
            ]);
            $insert_cart_total = DB::table('cart_total')
            ->insert([
                    'cart_totol' => Cart::total(),
                    'discount' => $check[0]->discount,
                    'user_id' => $user_id,
                    'gtotal' =>  Cart::total() - (Cart::total() * $check[0]->discount)/100,
            ]);
            $disnew = $check[0]->discount;
            $gtnew = Cart::total() - (Cart::total() * $check[0]->discount)/100;
            product_image" => "http://127.0.0.1:8000/uploads/INikqtDw2Kjpeg"
  "product_name" => "T shirt"
  "product_price" => "400"
  "quantity" => "8"
  //"coupon" => "OFF10"
  "subTotal" => "3200"
  "discounttype" => "1"
  "discountvalue" => "10"
  "grandTotal" => "2880"
  "checkout" => "Submit"