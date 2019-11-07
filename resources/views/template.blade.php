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
                    <th>Name</th>
                      <th>Email</th>
                        <th>productname</th>
                          <th>Transaction_id</th>
                          <th>Date and time</th>
                          <th>Subtotal</th>
                    </tr>
                       </thead>
                           <tbody>
                         @foreach($orderdetails as $orderdetail)
                              <tr>
                                   <td>{{ $orderdetail->user->name }}</td>
                                   <td>{{ $orderdetail->user->email }}</td>
                                    @foreach($orderdetail->products as $product)
                                    <td>
                                    	{{ $product->productname }}
                                    </td>
                                    @endforeach
                                @foreach($orderdetail->orderDetail as $order)
                                     <td>
                                 {{ $order->transaction_id }}
                                     </td>
                                    <td>
                                  {{ $order->created_at }}
                              </td>
                                @endforeach
                                    <td>{{ $orderdetail->total }}</td>
                                       
                               </tr>
                         @endforeach
                             </tbody>
                         </table>

</body>
</html>