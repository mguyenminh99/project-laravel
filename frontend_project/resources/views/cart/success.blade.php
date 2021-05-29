@extends('layouts.app')
@section('content')
<style>

.card {
    margin: auto;
    width: 38%;
    max-width: 600px;
    padding: 4vh 0;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-top: 3px solid rgb(252, 103, 49);
    border-bottom: 3px solid rgb(252, 103, 49);
    border-left: none;
    border-right: none
}

@media(max-width:768px) {
    .card {
        width: 90%
    }
}

.title {
    color: rgb(252, 103, 49);
    font-weight: 600;
    margin-bottom: 2vh;
    padding: 0 8%;
    font-size: initial
}

#details {
    font-weight: 400
}

.info {
    padding: 5% 8%
}

.info .col-5 {
    padding: 0
}

#heading {
    color: grey;
    line-height: 6vh
}

.pricing {
    background-color: #ddd3;
    padding: 2vh 8%;
    font-weight: 400;
    line-height: 2.5
}

.pricing .col-3 {
    padding: 0
}

.total {
    padding: 2vh 8%;
    color: rgb(252, 103, 49);
    font-weight: bold
}

.total .col-3 {
    padding: 0
}

.footer {
    padding: 0 8%;
    font-size: x-small;
    color: black
}

.footer img {
    height: 5vh;
    opacity: 0.2
}

.footer a {
    color: rgb(252, 103, 49)
}

.footer .col-10,
.col-2 {
    display: flex;
    padding: 3vh 0 0;
    align-items: center
}

.footer .row {
    margin: 0
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
</style>
@php
    $order = DB::table('orders')->latest()->first();
    $order_detail = DB::table('order_details')->where('order_id' , $order->id)->get();

    // dd($order_detail);
    $date = date( 'd/m/Y' , strtotime($order->created_at) );
@endphp
<div class="card">
    <div class="title "><a href="/home" class="btn btn-info">Back to shop</a></div>
    <div class="title">Purchase Reciept</div>
    <div class="info">
        <div class="row">
            <div class="col-4"> <span id="heading">Date</span><br> <span id="details">{{ $date }}</span> </div>
            <div class="col-4"> <span id="heading">Name</span><br> <span id="details">{{ $order->full_name }}</span> </div>
            <div class="col-4"> <span id="heading">Phone</span><br> <span id="details">{{ $order->mobile }}</span> </div>
        </div>
        <div class="row">
            <div class="col-4"> <span id="heading">Address</span><br> <span id="details">{{ $order->address }}</span> </div>
            <div class="col-8"> <span id="heading">Email</span><br> <span id="details">{{ $order->email }}</span> </div>
        </div>
    </div>
    <div class="pricing">
        @foreach ($order_detail as $item)
        @php
            $product = DB::table('products')->find($item->product_id);
            $total = $item->quantity * ( $product->price - ( $product->price * $product->is_sale / 100 ) );
        @endphp
        <div class="row">
            <div class="col-9"> <span id="name"> {{ $product->title }} x {{ $item->quantity }}</span> </div>
            <div class="col-3"> <span id="price">$ {{ $total }}</span> </div>
        </div>
        @endforeach
    </div>
    <div class="total">
        <div class="row">
            <div class="col-9">Discount</div>
            <div class="col-3"><smaill>{{ $order->discount }}%</smaill></div>
        </div>
        <div class="row">
            <div class="col-9">Total</div>
            <div class="col-3"><big>$ {{ $order->total_price }}</big></div>
        </div>
    </div>
    <div class="tracking">
        <div class="title">Tracking Order</div>
    </div>
    <div class="progress-track">
        <ul id="progressbar">
            <li class="step0 active " id="step1">Place order</li>
            <li class="step0 active text-center" id="step2">Shipped</li>
            <li class="step0 active text-right" id="step3">On the way</li>
            <li class="step0 text-right" id="step4">Delivered</li>
        </ul>
    </div>
    <div class="footer">
        <div class="row">
            <div class="col-10">Want any help? Please &nbsp;<a href="/contact"> contact us</a></div>
        </div>
    </div>
</div>
@endsection