
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<style type="text/css">
   
.table {
  border-collapse: collapse;
}

table, td, th {
  border: 1px solid black;
}

</style>
<body>
 <table class="table">
              <thead>
                  <tr>
                     <th>Product Name</th>
                     <th>Price</th>
                     <th>name</th>
                     <th>email</th>
                    </tr>
                       </thead>
                           <tbody>
                          @foreach($wishlist as $wish)
                         @foreach($wish->productDetail as $product)
                          @foreach($wishlist as $wish)
                           @foreach($wish->userDetail as $user)
                           <tr>
                           <td>{{$product->productname}} </td>
                           <td> {{$product->price}} </td>
                             <td>{{$user->name}}</td>
                             <td>{{$user->email}}</td>
                            </tr>
                             @endforeach
                             @endforeach
                             @endforeach
                             @endforeach
                                </tbody>
                         </table>



</body>
</html>