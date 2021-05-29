@extends('layouts.app')
@section('content')
<style></style>
<!-- Slider -->

<div class="main_slider" style="background-image:url('https://www.kiezebrink.co.uk/image/cache/catalog/reptile-banner-1500x600.jpg')">
    <div class="container fill_height">
        <div class="row align-items-center fill_height">
            <div class="col">
                <div class="main_slider_content">
                    <h6 style="color: white">Spring / Summer     2021</h6>
                    <h1 style="color: white">Get up to 30% Off New Arrivals</h1>
                    <div class="red_button shop_now_button"><a style="color: white" href="/shop">shop now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->

<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="banner_item align-items-center" style="background-image:url('https://i.natgeofe.com/n/e4c73a4d-83d7-42c1-b437-013cc3d1e836/01waqsnakes_16x9.jpg?w=636&h=358')">
                    <div class="banner_category">
                        <a href="/shop/category/{{  Str::slug('Snake') }}/18">Snake</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="banner_item align-items-center" style="background-image:url('http://1.bp.blogspot.com/_GIts5onJMJY/TGDCoa7xNxI/AAAAAAAAADc/vKNf7FoQVcY/s1600/leo_pard.jpg')">
                    <div class="banner_category">
                        <a href="/shop/category/{{  Str::slug('Leopard Gecko') }}/18">Leopard Gecko</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="banner_item align-items-center" style="background-image:url('https://i.pinimg.com/originals/80/41/ce/8041ce46c86b9f8671c0741c035403d1.jpg')">
                    <div class="banner_category">
                        <a href="/shop/category/{{  Str::slug('Monitor Lizard') }}/18">Monitor Lizard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Arrivals -->

<div class="new_arrivals">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col text-center">
                <div class="new_arrivals_sorting">
                    <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">all</li>
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".Snake">Snake</li>
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".Python">Python</li>
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center" data-filter=".Turtle">Turtle</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="product-grid" style="height: 1600px !important" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

                    <!-- Product 1 -->
                    @foreach ($products as $item)
                    @php
                        $category = DB::table('categories')->find($item->category_id);
                        $slug = Str::slug($item->title);
                    @endphp
                        <div class="product-item {{ $category->title }}">
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
                            <div class="red_button add_to_cart_button" data-id="{{ $item->id }}" data-url="{{ route('ajax.cart' , $item->id) }}" >add to cart</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deal of the week -->

<div class="deal_ofthe_week">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="deal_ofthe_week_img">
                    <img src="https://reptilerapture.net/assets/images/guyana%20redtail%20boa%20female%202.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-6 text-right deal_ofthe_week_col">
                <div class="deal_ofthe_week_content d-flex flex-column align-items-center float-right">
                    <div class="section_title">
                        <h2>Deal Of The Week</h2>
                    </div>
                    <ul class="timer">
                        <li class="d-inline-flex flex-column justify-content-center align-items-center">
                            <div id="day" class="timer_num">03</div>
                            <div class="timer_unit">Day</div>
                        </li>
                        <li class="d-inline-flex flex-column justify-content-center align-items-center">
                            <div id="hour" class="timer_num">15</div>
                            <div class="timer_unit">Hours</div>
                        </li>
                        <li class="d-inline-flex flex-column justify-content-center align-items-center">
                            <div id="minute" class="timer_num">45</div>
                            <div class="timer_unit">Mins</div>
                        </li>
                        <li class="d-inline-flex flex-column justify-content-center align-items-center">
                            <div id="second" class="timer_num">23</div>
                            <div class="timer_unit">Sec</div>
                        </li>
                    </ul>
                    <div class="red_button deal_ofthe_week_button"><a href="#">shop now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Best Sellers -->

<div class="best_sellers">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>Best Sellers</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="product_slider_container">
                    <div class="owl-carousel owl-theme product_slider">

                        <!-- Slide 1 -->
                        @foreach ($products as $item)
                        @php
                        $category = DB::table('categories')->find($item->category_id);
                        @endphp
                        <div class="owl-item product_slider_item">
                            <div class="product-item {{ $category->title }}">
                                <div class="product discount">
                                    <div class="product_image">
                                        <img src="http://localhost:8000/{{ $item->image }}" alt="">
                                    </div>
                                    <div class="favorite favorite_left"></div>
                                    @if ($item->is_sale > 0)
                                    <div class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center"><span><?=($item->is_sale>0)? $item->is_sale . '%' : '';?></span></div>
                                @endif
                                <div class="product_info">
                                    <h6 class="product_name"><a href="single.html">{{ $item->title }}</a></h6>
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
                            </div>
                        </div>
                        @endforeach
                        <!-- Slide 2 -->
                    </div>

                    <!-- Slider Navigation -->

                    <div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </div>
                    <div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
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

<!-- Blogs -->

<div class="blogs">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <div class="section_title">
                    <h2>Latest Blogs</h2>
                </div>
            </div>
        </div>
        <div class="row blogs_container">
            <div class="col-lg-4 blog_item_col">
                <div class="blog_item">
                    <div class="blog_background" style="background-image:url(images/blog_1.jpg)"></div>
                    <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                        <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                        <span class="blog_meta">by admin | dec 01, 2017</span>
                        <a class="blog_more" href="#">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 blog_item_col">
                <div class="blog_item">
                    <div class="blog_background" style="background-image:url(images/blog_2.jpg)"></div>
                    <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                        <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                        <span class="blog_meta">by admin | dec 01, 2017</span>
                        <a class="blog_more" href="#">Read more</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 blog_item_col">
                <div class="blog_item">
                    <div class="blog_background" style="background-image:url(images/blog_3.jpg)"></div>
                    <div class="blog_content d-flex flex-column align-items-center justify-content-center text-center">
                        <h4 class="blog_title">Here are the trends I see coming this fall</h4>
                        <span class="blog_meta">by admin | dec 01, 2017</span>
                        <a class="blog_more" href="#">Read more</a>
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
                <form action="post">
                    <div class="newsletter_form d-flex flex-md-row flex-column flex-xs-column align-items-center justify-content-lg-end justify-content-center">
                        <input id="newsletter_email" type="email" placeholder="Your email" required="required" data-error="Valid email is required.">
                        <button id="newsletter_submit" type="submit" class="newsletter_submit_btn trans_300" value="Submit">subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
