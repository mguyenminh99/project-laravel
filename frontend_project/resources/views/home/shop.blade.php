@extends('layouts.app')
@section('content')
<style>
    .product-item {
    position: unset !important;
    left: unset !important;
    width: 20% !important;
    float: left;
}

.slider::-webkit-slider-thumb {
  background: #f6931f;
}
.slider::-moz-range-thumb {
  background: #f6931f;
  cursor: pointer;
}
</style>
<div class="container product_section_container">
    <div class="row">
        <div class="col product_section clearfix">

            <!-- Breadcrumbs -->

            <div class="breadcrumbs d-flex flex-row align-items-center">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="index.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Shop</a></li>
                </ul>
            </div>

            <!-- Sidebar -->

            <div class="sidebar">
                <div class="sidebar_section">
                    <div class="sidebar_title">
                        <h5>Product Category</h5>
                    </div>
                    <ul class="sidebar_categories">
                        @foreach ($category as $item)
                        @php
                            $slug = Str::slug($item->title)
                        @endphp
                        {{-- {{ str_contains(request()->url(), '/{{ $item->title }}') ? 'active' : '' }} --}}
                        {{-- {{ str_contains(request()->url(), "/{{ $item->title }}") ? '<span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>' : ''}} --}}
                            <li class="{{ str_contains(request()->url(), $slug ) ? 'active' : '' }}" ><a href="/shop/category/{{ $slug }}/{{ $item->id }}">{{ $item->title }}</a></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Price Range Filtering -->
                <div class="sidebar_section">
                    <div class="sidebar_title">
                        <h5>Filter by Price</h5>
                    </div>
                    <p class="d-flex">
                        1 &nbsp; <input type="range" id="ranger" min="1" max="1000" value="500" class="slider" style="border:0; background:#f6931f; font-weight:bold;">&nbsp; 1000
                    </p>
                    <div id="slider-range"></div>
                    <div class="filter_button" data-id=""><span>filter</span></div>
                </div>

            </div>

            <!-- Main Content -->

            <div class="main_content">

                <!-- Products -->

                <div class="products_iso">
                    <div class="row">
                        <div class="col">

                            <!-- Product Sorting -->

                            <div class="product_sorting_container product_sorting_container_top">
                                <ul class="product_sorting">
                                    <li>
                                        <span class="type_sorting_text">Default Sorting</span>
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="sorting_type">
                                            <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "original-order" }'><span>Default Sorting</span></li>
                                            <li class="type_sorting_btn" data-isotope-option='{ "sortBy": "price" }'><span>Price</span></li>
                                        </ul>
                                    </li>
                                </ul>
                                <div class="pages d-flex flex-row align-items-center">
                                    {{ $product->links() }}
                                </div>

                            </div>

                            <!-- Product Grid -->

                            <div class="product-grid append_fillter_item" style="z-index: 1">

                                <!-- Product 1 -->
                                @foreach ($product as $item)
                                @php
                                $category = DB::table('categories')->find($item->category_id);
                                $slug = Str::slug($item->title);
                                @endphp
                                    <div class="product-item men" style="z-index: 2">
                                        <div class="product discount product_filter">
                                            <div class="product_image">
                                                <img src="http://localhost:8000/{{ $item->image }}" alt="">
                                            </div>
                                            <div class="favorite favorite_left"></div>
                                            @if ($item->is_sale > 0)
                                            <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span><?=($item->is_sale>0)? $item->is_sale . '%' : '';?></span></div>
                                                @endif
                                                <div class="product_info">
                                                <h6 class="product_name"><a href="{{ route('products.detail' ,[$item->id , $slug]) }}">{{ $item->title }}</a></h6>
                                                @if ($item->is_sale > 0)
                                                    @php
                                                        $sale_price = $item->price - ($item->price * $item->is_sale / 100);
                                                    @endphp
                                                    <div class="product_price">${{ $sale_price }}<span>${{ $item->price }}</span></div>
                                                @else
                                                    <div class="product_price">${{ $item->price }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="red_button add_to_cart_button" data-id="{{ $item->id }}" data-url="{{ route('ajax.cart' , $item->id) }}">add to cart</div>
                                    </div>
                                    
                                @endforeach
                            </div>
                            <!-- Product Sorting -->
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Benefit -->

<div class="benefit">
    <div class="container">
        <div class="row benefit_row">
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>free shipping</h6>
                        <p>Suffered Alteration in Some Form</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>cach on delivery</h6>
                        <p>The Internet Tend To Repeat</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>45 days return</h6>
                        <p>Making it Look Like Readable</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>opening all week</h6>
                        <p>8AM - 09PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Newsletter -->

<div class="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="newsletter_text d-flex flex-column justify-content-center align-items-lg-start align-items-md-center text-center">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter and get 20% off your first purchase</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                    <input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
                    <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var slider = document.getElementById("ranger");
    var output = document.getElementById("slider-range");
    output.innerHTML = slider.value;
    
    slider.oninput = function() {
      output.innerHTML = this.value;
    }
    </script>
@endsection