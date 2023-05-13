@extends('client.layout.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Shopping Cart</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $cart as $id => $item )
                                <tr id="product{{$item['id']}}">
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('images') . '/' . $item['image']}}" alt="" style="width:150px;">
                                        <h5>{{$item['name']}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        ${{number_format($item['price'], 2)}}
                                    </td>

                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                            {{-- <span class="dec qtybtn">-</span> --}}
                                               <input data-id="{{$item['id']}}" 
                                                        data-url="{{route('cart.update-in-cart', $item['id'])}}" 
                                                        type="text" 
                                                        value="{{ $item['qty'] }}">
                                            {{-- <span class="inc qtybtn">+</span> --}}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <div class="child_shoping__cart__total">
                                            ${{number_format($item['qty'] * $item['price'], 2)}}
                                        </div>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close" data-url="{{route('cart.delete-product-in-cart', $item['id']) }}"></span> 
                                    </td>
                                </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="{{ route('cart.delete-all')}}" class="primary-btn cart-btn cart-btn-right cart-btn-delete-all"><span class=""></span>
                        Delete Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        @php
                            $total = 0;
                            foreach ($cart as $item) {
                                $total += $item['qty'] * $item['price'];
                            }
                        @endphp
                        {{-- <li>Subtotal <span>$454.98</span></li> --}}
                        <li class="total1">
                            <div class="total2" >Total <span id="total_cart">${{number_format($total,2)}}</span></div>
                        </li>
                    </ul>
                    <a href="{{route('checkout')}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->
@endsection

@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function() {
            $('span.icon_close').on('click', function() {
                var id = $(this).data('id');
                var url = $(this).data('url');
                var selectorTr = '#product' + id;
                var urlCart = "{{ route('cart.cart') }}" + ' .total2';

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(res) {
                        // swal("Xoa san pham thang thanh cong ^^!", "", "success");
                        $(selectorTr).empty();
                        // $(".total1").load(urlCart);
                        $('#total_cart').html(res.total_cart);
                        console.log(res);
                    }
                });
            });
        });

       $('span.qtybtn').on('click',function(){
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        if ($button.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }

        var url = $button.parent().find('input').data('url') + '/' + newVal;
        var id = $button.parent().find('input').data('id');

        var urlCart = "{{ route('cart.cart') }}" + ' #product' + id +
        ' .shoping__cart__total .child_shoping__cart__total';

        var selector = "#product" + id + ' .shoping__cart__total';

        var urlCartTotal ="{{ route('cart.cart') }}" + ' .total2';

        // console.log('urlCart', urlCart);
        // console.log('selector', selector);

        $.ajax({
            type:'GET',
            url:url,
            success:function(res){
                if(res.id && newVal ==0){
                $("#product" + id).empty();
                }
                $(selector).load(urlCart);
                $(".total1").load(urlCartTotal);
            }
        });

       });

    </script>
@endsection
{{-- @section('js-custom')

<script type="text/javascript">
    $(document).ready(function(){
        $('span.icon_close').on('click', function(){
            var id = $(this).data('id');
            var url= $(this).data('url');
            var selectorTr = '#product' + id;
            var urlCart = "{{route('cart')}}" + ' .total2';
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(res){
                            $(selectorTr).empty();
                            $(".total1").load(urlCart);
                            // $('#total_cart').html(res.total_cart);

                            console.log(res);
                    }
                });
        });
        
        //tang/giam so luong cart
        // var proQty = $('.pro-qty');
            
        //     proQty.on('click', '.qtybtn', function () {
        //         var $button = $(this);
        //         var oldValue = $button.parent().find('input').val();
        //         // var oldValue = $button.siblings('input').val();
        //         if ($button.hasClass('inc')) {
        //             var newVal = parseFloat(oldValue) + 1;
        //         } else {
        //             // Don't allow decrementing below zero
        //             if (oldValue > 1) {
        //                 var newVal = parseFloat(oldValue) - 1;
        //             } else {
        //                 newVal=0;
        //             }
        //         }
        //         let url = $button.parent().find('input').data('url')+'/'+newVal;
        //         let id = $button.parent().find('input').data('id');
        //         $.ajax({
        //             type:"GET",
        //             url: url,
        //             success: function(res) {
        //                 console.log(res);
        //                 if(newVal == 0){
        //                     $(".shoppincart_"+id).remove();
        //                 }
        //             }
        //             });
        //             $button.parent().find('input').val(newVal);
        //     });
        $('span.qtybtn').on('click', function () {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                alert(newVal);

                // var url = $button.parent().find('input').data('url') + '/' + newVal;
                // var id = $button.parent().find('input').data('id');

                // var urlCart = "{{route('cart')}}" + ' ' + '#product' + id + ' .shoping__cart__total .child_shoping__cart__total';
                // var selector = '#product' + id ' .shoping__cart__total';
                // var urlCartTotal =  "{{route('cart')}}" + ' .total2';
                // console.log('urCart'. urlCart);
                // console.log('urlCartTotal'. urlCartTotal);

                // $.ajax({
                //     type:'GET',
                //     url: url,
                //     success: function(res){
                //         if(res.id && newVal == 0){
                //             $("#product" + id).empty(); // lay nguyen cai product do
                            
                //         }
                //         $(selector).load(urlCart);
                //         $(".total1").load(urlCartTotal);
                //     }
                // });
            });
        
    }); 
</script>
@endsection --}}