<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Invoice -{{$order->id}}</title>
    <link rel="stylesheet" href="{{asset('css/admin_style.css')}}">
    <style>
        .content-wrapper{
          background: #FFF;
        }
        .invoice-header{
          background: #f7f7f7;
          padding: 10px 20px 10px 20px;
          border-bottom: 1px solid gray;
        }
    </style>
  </head>
<body>
        <div class="content-wrapper">
          <div class="invoice-header">
            <div class="float-left site-logo">
                 <img src="{{asset('images/favicon.png')}}" alt="">
            </div>
            <div class="float-right site-address">
                       <h4>esheba</h4>
                       <p>Phone:########</p>
                       <p>Email:########</p>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="invoice-description">
              <div class="invoice-left-top float-left">
                <h6>Invoice to</h6>
           <h3>{{ $order->name }}</h3>
           <div class="address">
            <p>
              <strong>Address: </strong>
              {{ $order->shipping_address }}
            </p>
             <p>Phone: {{ $order->phone_no }}</p>
             <p>Email: <a href="mailto:{{ $order->email }}">{{ $order->email }}</a></p>
           </div>
        </div>
        <div class="invoice-right-top float-right">
          <h3>Invoice #{{ $order->id }}</h3>
           <p>
             {{ $order->created_at }}
           </p>

              </div>
              <div class="clearfix"></div>
          </div>

            <div class="card-body">

              <h3>Products</h3>
             @if ($order->carts->count() > 0)
             <table class="table table-bordered table-stripe">
               <thead>
                 <tr>
                   <th>No.</th>
                   <th>Product Title</th>
                   <th>Product Quantity</th>
                   <th>Unit Price</th>
                   <th>Sub total Price</th>
                 </tr>
               </thead>
               <tbody>
                 @php
                 $total_price = 0;
                 @endphp
                 @foreach ($order->carts as $cart)
                 <tr>
                   <td>
                     {{ $loop->index + 1 }}
                   </td>
                   <td>
                     <a href="{{ route('products.show', $cart->product->slug) }}">{{ $cart->product->title }}</a>
                   </td>
                  <td>{{ $cart->product_quantity }}</td>
                   <td>
                     {{ $cart->product->price }} Taka
                   </td>
                   <td>
                     @php
                     $total_price += $cart->product->price * $cart->product_quantity;
                     @endphp

                     {{ $cart->product->price * $cart->product_quantity }} Taka
                   </td>
                 </tr>
                 @endforeach
                 <tr>
                   <td colspan="4"></td>
                   <td>
                     Discount:
                   </td>
                   <td colspan="3">
                     <strong>  {{ $order->custom_discount }} Taka</strong>
                   </td>
                 </tr>
                 <tr>
                   <tr>
                     <td colspan="4"></td>
                     <td>
                       Shipping Charge:
                     </td>
                     <td colspan="3">
                       <strong>  {{ $order->shipping_charge }} Taka</strong>
                     </td>
                   </tr>
                   <tr>
                   <td colspan="4"></td>
                   <td>
                     Total Amount:
                   </td>
                   <td colspan="3">
                     <strong>  {{ $total_price+$order->shipping_charge-$order->custom_discount }} Taka</strong>
                   </td>
                 </tr>
               </tbody>
             </table>
             @endif
            </div>
            <div class="thanks mt-3">
                     <h4>Thank you for your business!!</h4>
            </div>
          </div>

  </body>
</html>
