@extends('client.layout.layout')
@section('content')
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body {
    font-family: Arial;
    font-size: 17px;
    padding: 8px;
    }

    * {
    box-sizing: border-box;
    }

    .row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
    margin: 0 -16px;
    }

    .col-25 {
    -ms-flex: 25%; /* IE10 */
    flex: 25%;
    }

    .col-50 {
    -ms-flex: 50%; /* IE10 */
    flex: 50%;
    }

    .col-75 {
    -ms-flex: 75%; /* IE10 */
    flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
    padding: 0 16px;
    }

    .container {
    background-color: #f2f2f2;
    padding: 5px 20px 15px 20px;
    border: 1px solid lightgrey;
    border-radius: 3px;
    }

    input[type=text] {
    width: 100%;
    margin-bottom: 20px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 3px;
    }

    label {
    margin-bottom: 10px;
    display: block;
    }

    .icon-container {
    margin-bottom: 20px;
    padding: 7px 0;
    font-size: 24px;
    }

    .btn {
    background-color: #04AA6D;
    color: white;
    padding: 12px;
    margin: 10px 0;
    border: none;
    width: 100%;
    border-radius: 3px;
    cursor: pointer;
    font-size: 17px;
    }

    .btn:hover {
    background-color: #45a049;
    }

    a {
    color: #2196F3;
    }

    hr {
    border: 1px solid lightgrey;
    }

    span.price {
    float: right;
    color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
    .row {
        flex-direction: column-reverse;
    }
    .col-25 {
        margin-bottom: 20px;
    }
    }
</style>
</head>
<body class="m-5">

<h2>Responsive Checkout Form</h2>
<p>Resize the browser window to see the effect. When the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other.</p>
<div class="row m-5 d-flex">
    <div class="col-25">
        <div class="container">
            <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b></b></span></h4>

            @php
                $total = 0;
            @endphp
            @foreach ( $cart as $items)
                @php
                    $total += $items['price'] * $items['qty'];
                @endphp
                    <p><a href="#">{{$items['name']}}</a>  X {{$items['qty']}}
                    <span class="price">${{ number_format($items['price'] * $items['qty'] , 2)}}</span></p>
            @endforeach
            <hr>
            <p>Total <span class="price" style="color:black"><b>${{ number_format($total,2)}}</b></span></p>

            <div class="radio">
                <input id="cod" name="radio" type="radio" value="payment_method" checked>
                <label for="cod" class="radio-label">Cash on</label>
              </div>
              <div class="radio">
                <input id="pay" name="radio" type="radio" value="payment_method">
                <label  for="pay" class="radio-label">VNpay</label>
              </div>
        </div>
  </div>
  <div class="col-75">
    <div class="container">
      <form action="{{route('checkout.place-order')}}" method="POST">
        @csrf 
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="full_name"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="full_name" name="full_name"  value="{{Auth::user()->name}}">
    
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" >
            <label for="phone"><i class="fa fa-institution"></i> phone</label>
            <input type="text" id="phone" name="phone" >
            <label for="notes"><i class="fa fa-institution"></i> notes</label>
            <input type="text" id="notes" name="notes" >
            <label for="payment_method"><i class="fa fa-institution"></i> payment_method</label>
            <input type="text" id="payment_method" name="payment_method" >
            </div>
          </div>
          <input type="submit" value="Continue to checkout" class="btn">
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>

@endsection