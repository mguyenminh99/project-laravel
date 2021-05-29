@extends('layouts.app')
@section('content')
<style>
    .container {
  width: 100%;
}
#progressbar {
    margin-bottom: 3vh;
    overflow: hidden;
    color: rgb(252, 103, 49);
    padding-left: 0px;
    margin-top: 3vh
}

#progressbar li {
    list-style-type: none;
    font-size: x-small;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
    color: rgb(160, 159, 159)
}

#progressbar #step1:before {
    content: "";
    color: rgb(252, 103, 49);
    width: 5px;
    height: 5px;
    margin-left: 0px !important
}

#progressbar #step2:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-left: 32%
}

#progressbar #step3:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-right: 32%
}

#progressbar #step4:before {
    content: "";
    color: #fff;
    width: 5px;
    height: 5px;
    margin-right: 0px !important
}

#progressbar li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #ddd;
    border-radius: 50%;
    margin: auto;
    z-index: -1;
    margin-bottom: 1vh
}

#progressbar li:after {
    content: '';
    height: 2px;
    background: #ddd;
    position: absolute;
    left: 0%;
    right: 0%;
    margin-bottom: 2vh;
    top: 1px;
    z-index: 1
}

.progress-track {
    padding: 0 8%
}

#progressbar li:nth-child(2):after {
    margin-right: auto
}

#progressbar li:nth-child(1):after {
    margin: auto
}

#progressbar li:nth-child(3):after {
    float: left;
    width: 68%
}

#progressbar li:nth-child(4):after {
    margin-left: auto;
    width: 132%
}

#progressbar li.active {
    color: black
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: rgb(252, 103, 49)
}
.progressbar {
  counter-reset: step;
}
.progressbar li {
  list-style: none;
  display: inline-block;
  width: 24%;
  position: relative;
  text-align: center;
  cursor: pointer;
}
.progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  line-height : 30px;
  border: 1px solid #ddd;
  border-radius: 100%;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  background-color: #fff;
}
.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 1px;
  background-color: #ddd;
  top: 15px;
  left: -50%;
  z-index : -1;
}
.progressbar li:first-child:after {
  content: none;
}
.progressbar li.active {
  color: green;
}
.progressbar li.active:before  {
  border-color: green;
} 
.progressbar li.active + li:after {
  background-color: green;
}
.cart{
    padding: 20px;
}
.item-container{
    border-bottom: 1px solid #ccc;
}
.img-item{
    max-width: 100  px;
}
.img-item img{
    width: 100%;
}
.sale_price{
    text-decoration: line-through;
    padding: 0px 5px;
}
.cupon{
    padding: 5px 0px;
    border-bottom: 1px solid #ccc;
    margin-bottom: 5px
}
.totals{
    padding: 5px;
}
</style>
<style>
  

.card {
    max-width: 100%;
    margin: 2vh
}

.card-top {
    padding: 0.7rem 5rem
}

.card-top a {
    float: left;
    margin-top: 0.7rem
}

#logo {
    font-family: 'Dancing Script';
    font-weight: bold;
    font-size: 1.6rem
}

.card-body {
    background-image: url("https://i.pinimg.com/originals/82/88/12/828812007e1f0c5019ae46f4a29bcda2.jpg");
    background-size: cover;
    background-repeat: no-repeat
}

@media(max-width:768px) {
    .card-body {
        padding: 0 1rem 1rem 1rem;
        background-image: url("https://i.pinimg.com/originals/82/88/12/828812007e1f0c5019ae46f4a29bcda2.jpg");
        background-size: cover;
        background-repeat: no-repeat
    }

    .card-top {
        padding: 0.7rem 1rem
    }
}

.row {
    margin: 0
}

.upper {
    padding: 1rem 0;
    justify-content: space-evenly
}

#three {
    border-radius: 1rem;
    width: 22px;
    height: 22px;
    margin-right: 3px;
    border: 1px solid blue;
    text-align: center;
    display: inline-block
}

#payment {
    margin: 0;
    color: blue
}

.icons {
    margin-left: auto
}

form span {
    color: rgb(179, 179, 179)
}

form {
    padding: 2vh 0
}

input, textarea {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input:focus::-webkit-input-placeholder {
    color: transparent
}

.header {
    font-size: 1.5rem
}

.left {
    background-color: #ffffff;
    padding: 2vh
}

.left img {
    width: 2rem
}

.left .col-4 {
    padding-left: 0
}

.right .item {
    padding: 0.3rem 0
}

.right {
    background-color: #ffffff;
    padding: 2vh
}

.col-8 {
    padding: 0 1vh
}

.lower {
    line-height: 2
}




a {
    color: black
}

a:hover {
    color: black;
    text-decoration: none
}

input[type=checkbox] {
    width: unset;
    margin-bottom: unset
}

#cvv {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575), rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}

#cvv:hover {}
</style>
<div class="d-flex container">
    <div class="col-md-12">
        <div class="progress-track">
            <ul id="progressbar">
                <li class="step0 active " id="step1">Login</li>
                <li class="step0 active text-center" id="step2">Shopping</li>
                <li class="step0 active text-right" id="step3">Place order</li>
                <li class="step0 text-right" id="step4">shipping</li>
            </ul>
        </div>
        <div class="card">
            <div class="card-top border-bottom text-center"> <a href="/home"> Back to shop</a> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <div class="left border">
                            @php
                                $user = Session::get('user');
                            @endphp
                            <div class="row"> <span class="top">Payment</span>
                            </div>
                            <form id="paymentInfo" method="POST" action="{{ route('cart.checkout') }}">
                                @csrf 
                                <span>Name:</span> <input value="{{ $user['name'] }}" name="full_name" required> <span>Address</span> <input name="address" value="{{ old('address') }}" required>
                                <div class="row col-12" style="padding: 0">
                                    <div class="col-6" style="padding-left: 0 !important"><span>Email:</span> <input name="email" value="{{ $user['email'] }}"> </div>
                                    <div class="col-6" style="padding-right: 0 !important"><span>Phone:</span> <input name="mobile" value="{{ $user['phone'] }}" required> </div>
                                    <div class="col-12" style="padding: 0">
                                        <span>Note:</span>
                                        <textarea name="note" cols="30" rows="7">{{ old('note') }}</textarea>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="right border">
                            <div class="top">Order Summary</div>
                            @php
                            use App\Models\Product;
                            $total = 0; $total_item = 0; $total_price = 0;
                            @endphp
                            @foreach ($cart as $item)
                                @php
                                    $total_item += $item['quantity'];
                                @endphp
                            @endforeach
                            <p>{{ $total_item }} items</p>
                            
                            @foreach ($cart as $key=>$item)
                            @php 
                            $product = Product::find($key);
                            $total_price += ($item['price'] - ($product->is_sale * $item['price'] / 100)) * $item['quantity'];
                            $sale_price = $product->is_sale * $item['price'] / 100;
                            $sale = $item['price'] - $sale_price;
                            $total = ($item['price'] - $sale_price)*$item['quantity'];
                            @endphp
                            <div class="item-container">
                                <div class="row item">
                                    <div class="col-4 align-self-center"><img class="img-fluid" src="http://localhost:8000/{{ $product->image }}"></div>
                                    <div class="col-8">
                                        @if ($product->is_sale>0)
                                        <div class="d-flex">
                                            <span class="sale_price" style="padding: 0"><div class="price-item" > ${{ $item['price'] }} </div></span>
                                            <div class="row"><b style="padding: 0">$ {{ $sale }} </b></div>
                                        </div>
                                        @else
                                        <div class="row"><b style="padding: 0">$ {{ $item['price'] }}</b></div>
                                        @endif
                                        
                                        <div class="row text-muted">{{ $item['title'] }} x {{ $item['quantity'] }}</div>
                                        <div class="row">total: ${{ $total }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @if (session('coupon'))
                                    @php
                                        $coupon = session('coupon'); 
                                        $total_price = $total_price - ( $total_price * $coupon['percent'] / 100 );
                                    @endphp
                                @endif
                            <div class="cupon">
                                <div class="form-group">
                                    <label for="" style="padding-left: 13px;">Gif card / Discount code</label>
                                    <div class="d-flex" style="justify-content: space-between;">
                                        <div class="col-md-8" style="display: flex; align-item: center;" >
                                            <input class="form-control " name="coupon" type="text" style="margin: 0" value="{{ session('coupon') ? $coupon['code'] : '' }}">
                                        </div>
                                        <div class="col-md-4" style="display: flex; align-item: center;">
                                            <button type="button" class="btn btn-outline-primary  coupon_check" style="margin: 0">Apply</button>
                                        </div>
                                    </div>
                                    <div class="message-cupon text-secondary" style="padding-top: 20px; padding-left: 13px;">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Subtotal</div>
                                <div class="col text-right">$ {{ $total_price }}</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Gif card / Discount code</div>
                                
                                <div class="col text-right"> <span class="coupon_value">{{ session('coupon') ? $coupon['percent'] : '0' }}</span> % </div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Delivery</div>
                                <div class="col text-right">Free</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><b>Total to pay</b></div>
                                <div class="col text-right"><b><span>$</span> <span class="total_price">{{ $total_price }}</span></b></div>
                            </div>
                            <div class="row lower">
                            </div> <button class="btn btn-primary w-100 btn-placeOrder">Place order</button>
                        </div>
                    </div>
                </div>
            </div>
            <div> </div>
        </div>
       
        
    </div>
    
</div>
    
<script>
    $('.btn-placeOrder').click(function(){
        $('#paymentInfo').submit();
    });
    $('.coupon_check').click(function(){
        var code = $('input[name=coupon]').val();
        var total_price = $('.total_price').text();
        var total = '';
        if(code == ''){
            console.log('no');
        }
        else{
            $.ajax({
                url: '/checkCoupon',
                data : {code:code},
                type:'GET',
                dataType: 'json',
                success: function(data) {
                    if(data.code === 200){
                        $('.message-cupon').html(data.message);
                        if(data.percent){
                            total = total_price - ( total_price - (total_price * data.percent / 100) )
                            $('.coupon_value').text(data.percent);
                            $('.total_price').text(total);
                        }
                    }
                }
            });
        }
    })
</script>
@endsection