<?php 
    use App\Models\Category;
    use App\Models\Product;
    $products = Product::all();
    $cates = Category::where('parents_id' , 0)->get();
?>
<header class="header trans_300" style="z-index: 5">

    <!-- Top Navigation -->
    <style>
        .dropdown-submenu {
    position: relative;
    }
    .dropdown-menu {
    top: 80% !important;
}
    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -6px;
    margin-left: -1px;
    -webkit-border-radius: 0 6px 6px 6px;
    -moz-border-radius: 0 6px 6px;
    border-radius: 0 6px 6px 6px;
    }
    
    .dropdown-submenu:hover>.dropdown-menu {
    display: block;
    }
    
    .dropdown-submenu>a:after {
    display: block;
    content: " ";
    float: right;
    width: 0;
    height: 0;
    border-color: transparent;
    border-style: solid;
    border-width: 5px 0 5px 5px;
    border-left-color: #ccc;
    margin-top: 5px;
    margin-right: -10px;
    }
    
    .dropdown-submenu:hover>a:after {
    border-left-color: #fff;
    }
    
    .dropdown-submenu.pull-left {
    float: none;
    }
    
    .dropdown-submenu.pull-left>.dropdown-menu {
    left: -100%;
    margin-left: 10px;
    -webkit-border-radius: 6px 0 6px 6px;
    -moz-border-radius: 6px 0 6px 6px;
    border-radius: 6px 0 6px 6px;
    }
    .test:hover ul.dropdown-menu.multi-level{
    display: block;
    }
    ul.dropdown-menu.multi-level:hover{
        display: block;
    }
    </style>
    <style>
        .sidenav{background-color:#111;height:100%;left:0;overflow-x:hidden;padding-top:60px;position:fixed;top:0;transition:.5s;width:0;z-index:1;}
.sidenavR{background-color:#111;height:100%;overflow-x:hidden;padding-top:60px;position:fixed;right:0;top:0;transition:.5s;width:0;z-index:1;}
.sidenav a,.sidenavR a{color:#818181;display:block;font-size:25px;padding:8px 8px 8px 32px;text-decoration:none;transition:.3s;}
.sidenav a:hover,.offcanvas a:focus,.sidenavR a:hover,.offcanvas a:focus{color:#f1f1f1;}
.sidenav .closebtn,.sidenavR .closebtn{font-size:36px;margin-left:50px;position:absolute;right:25px;top:0;}
@media screen and max-height 450px {
.sidenav,.sidenavR{padding-top:15px;}
.sidenav a,.sidenavR a{font-size:18px;}
    
}
    </style>
    <style>
        .background_cart{
        display: none;
        position: fixed;
        z-index: 1;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: #2d292963;
    }
    .cart_body{
        z-index: 2;
        padding: 20px;
    }

    /* Global settings */
 
.product-image {
  float: left;
  width: 20%;
}
 
.product-details {
  float: left;
  width: 25%;
}
 
.product-price {
  float: left;
  width: 12%;
  color: white;
}
 
.product-quantity {
  float: left;
  width: 10%;
}
 
.product-removal {
  float: left;
  width: 9%;
}
 
.product-line-price {
  float: left;
  width: 12%;
  text-align: right;
}
 
/* This is used as the traditional .clearfix class */
.group:before, .shopping-cart:before, .column-labels:before, .product:before, .totals-item:before,
.group:after,
.shopping-cart:after,
.column-labels:after,
.product:after,
.totals-item:after {
  content: '';
  display: table;
}
 
.group:after, .shopping-cart:after, .column-labels:after, .product:after, .totals-item:after {
  clear: both;
}
 
.group, .shopping-cart, .column-labels, .product, .totals-item {
  zoom: 1;
}
 
/* Apply clearfix in a few places */
/* Apply dollar signs */
.product .product-price:before, .product .product-line-price:before, .totals-value:before {
  content: '$';
}
 
/* Body/Header stuff */
body {
  padding: 0px 30px 30px 20px;
  font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 100;
}
 
h1 {
  font-weight: 100;
}
 
label {
  color: #aaa;
}
 
.shopping-cart {
  margin-top: -45px;
}
 
/* Column headers */
.column-labels label {
  padding-bottom: 15px;
  margin-bottom: 15px;
  border-bottom: 1px solid #eee;
}
.column-labels .product-image, .column-labels .product-details, .column-labels .product-removal {
  text-indent: -9999px;
}
 
/* Product entries */
.product {
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid #eee;
}
.product .product-image {
  text-align: center;
}
.product .product-image img {
  width: 100px;
}
.product .product-details .product-title {
  margin-right: 20px;
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}
.product-title, .product-line-price, .totals-value{
    color: white;
}
.product .product-details .product-description {
  margin: 5px 20px 5px 0;
  line-height: 1.4em;
}
.product .product-quantity input {
  width: 40px;
}
.product .remove-product {
  border: 0;
  padding: 4px 8px;
  background-color: #c66;
  color: #fff;
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
  font-size: 12px;
  border-radius: 3px;
}
.product .remove-product:hover {
  background-color: #a44;
}
 
/* Totals section */
.totals .totals-item {
  float: right;
  clear: both;
  width: 100%;
  margin-bottom: 10px;
}
.totals .totals-item label {
  float: left;
  clear: both;
  width: 79%;
  text-align: right;
}
.totals .totals-item .totals-value {
  float: right;
  width: 21%;
  text-align: right;
}
.totals .totals-item-total {
  font-family: "HelveticaNeue-Medium", "Helvetica Neue Medium";
}
 
.checkout {
  float: right;
  border: 0;
  margin-top: 20px;
  padding: 6px 25px;
  background-color: #6b6;
  color: #fff;
  font-size: 25px;
  border-radius: 3px;
}
 
.checkout:hover {
  background-color: #494;
}
 
/* Make adjustments for tablet */
@media screen and (max-width: 650px) {
  .shopping-cart {
    margin: 0;
    padding-top: 20px;
    border-top: 1px solid #eee;
  }

 
  .column-labels {
    display: none;
  }
 
  .product-image {
    float: right;
    width: auto;
  }
  .product-image img {
    margin: 0 0 10px 10px;
  }
 
  .product-details {
    float: none;
    margin-bottom: 10px;
    width: auto;
  }
 
  .product-price {
    clear: both;
    width: 70px;
  }
 
  .product-quantity {
    width: 100px;
  }
  .product-quantity input {
    margin-left: 20px;
  }
 
  .product-quantity:before {
    content: 'x';
  }
 
  .product-removal {
    width: auto;
  }
 
  .product-line-price {
    float: right;
    width: 70px;
  }
}
/* Make more adjustments for phone */
@media screen and (max-width: 350px) {
  .product-removal {
    float: right;
  }
 
  .product-line-price {
    float: right;
    clear: left;
    width: auto;
    margin-top: 10px;
  }
 
  .product .product-line-price:before {
    content: 'Item Total: $';
  }
 
  .totals .totals-item label {
    width: 60%;
  }
  .totals .totals-item .totals-value {
    width: 40%;
  }
  .totals-value{
    color: white;
  }
  
}
  .avatar-user{
    max-width: 36px;
    max-height: 36px;
  }
  .avatar-user img{
    height: 100%;
  }
  .user-name{
    padding: 0 5px;
  }
    </style>
    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-right">
                    <div class="top_nav_right">
                        <div>
                            
                        </div>
                        <ul class="top_nav_menu" style="text-align: right">
                            <li class="account">
                              @if (session('user'))
                              @php
                                  $user = Session::get('user');
                              @endphp
                              <a href="#" class="d-flex">
                                <div class="avatar-user">
                                  <img src="https://upload.wikimedia.org/wikipedia/commons/f/f4/User_Avatar_2.png" alt="">
                                </div>
                                <div class="user-name">{{ $user['name'] }}</div>
                                <i class="fa fa-angle-down" style="display: flex; align-items: center;"></i>
                              </a>
                              <ul class="account_selection" >
                                  <li><a href="/profile/{{ $user['id'] }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Profile</a></li>
                                  <li><a href="{{ route('user.logout') }}"><i class="fas fa-sign-out-alt" aria-hidden="true"></i>Logout</a></li>
                              </ul>
                              @else
                              <a href="#" class="d-flex">
                                My account
                                <i class="fa fa-angle-down" style="display: flex; align-items: center;"></i>
                              </a>
                              <ul class="account_selection" >
                                  <li><a href="{{ route('user.login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign in</a></li>
                                  <li><a href="{{ route('user.register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                              </ul>
                              @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->

    <div class="main_nav_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <div class="logo_container">
                        <a href="{{ route('home') }}">colo<span>shop</span></a>
                    </div>
                    <nav class="navbar">
                        <ul class="navbar_menu">
                            <li><a href="{{ route('home') }}">home</a></li>
                            <li>
                                <div class="dropdown test">
                                    <a id="dLabel" role="button"  href="{{ route('products') }}">
                                        Shop <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                        @foreach ($cates as $item)
                                        <?php $child_cate = Category::query()->where('parents_id' , $item->id)->get(); $slug = Str::slug($item->title); ?>
                                        
                                            <li class="dropdown-submenu">
                                                <a  href="/shop/category/{{ $slug }}/{{ $item->id }}">{{ $item->title }}</a>
                                                @if (!empty($child_cate->toArray()))
                                                <ul class="dropdown-menu">
                                                    @foreach ($child_cate as $item)
                                                    @php
                                                        $slug = Str::slug($item->title)
                                                    @endphp
                                                        <li><a href="/shop/category/{{ $slug }}/{{ $item->id }}">{{ $item->title }}</a></li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                        
                                    </ul>
                                </div>
                                   
                            </li>
                            <li><a href="#">promotion</a></li>
                            <li><a href="#">pages</a></li>
                            <li><a href="#">blog</a></li>
                            <li><a href="contact.html">contact</a></li>
                        </ul>
                        <ul class="navbar_user">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                            <li class="check_out">
                                <a href="javascript:void(0)" class="show_cart" onclick="openNavR()">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    @php
                                    $cart = Session::get('cart');
                                    $total = 0;
                                    if(!empty($cart)){
                                      foreach ($cart as $key => $value) {
                                        $total += $value['quantity'];
                                      }
                                    }
                                    
                                    @endphp
                                    <span id="checkout_items" class="checkout_items">{{ $total }}</span>
                                </a>
                            </li>
                        </ul>
                        <div class="hamburger_container">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="fs_menu_overlay"></div>
    <div class="hamburger_menu">
        <div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
        <div class="hamburger_menu_content text-right">
            <ul class="menu_top_nav">
                <li class="menu_item has-children">
                    <a href="#">
                        usd
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">cad</a></li>
                        <li><a href="#">aud</a></li>
                        <li><a href="#">eur</a></li>
                        <li><a href="#">gbp</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        English
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#">French</a></li>
                        <li><a href="#">Italian</a></li>
                        <li><a href="#">German</a></li>
                        <li><a href="#">Spanish</a></li>
                    </ul>
                </li>
                <li class="menu_item has-children">
                    <a href="#">
                        My Account
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="menu_selection">
                        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i>Sign In</a></li>
                        <li><a href="#"><i class="fa fa-user-plus" aria-hidden="true"></i>Register</a></li>
                    </ul>
                </li>
                <li class="menu_item"><a href="#">home</a></li>
                <li class="menu_item"><a href="#">shop</a>
                    <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                        @foreach ($cates as $item)
                        <?php $child_cate = Category::query()->where('parents_id' , $item->id)->get();  ?>
                            <li class="dropdown-submenu">
                                <a  href="#">{{ $item->title }}</a>
                                @if (!empty($child_cate->toArray()))
                                <ul class="dropdown-menu">
                                    @foreach ($child_cate as $item)
                                        <li><a href="#">{{ $item->title }}</a></li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="menu_item"><a href="#">promotion</a></li>
                <li class="menu_item"><a href="#">pages</a></li>
                <li class="menu_item"><a href="#">blog</a></li>
                <li class="menu_item"><a href="#">contact</a></li>
            </ul>
        </div>
    </div>
    
</header>
<div class="header-height" style="margin-bottom: 20px; "></div>

<div id="mySidenavR" class="sidenavR" style="z-index: 10">
    <div class="background_cart" onclick="closeNavR()"></div>
    <div class="cart_body">
        <div class="shopping-cart append_product">
        
        </div>
        
    </div>
    
</div>
<script>
    
     function openNavR() {
        document.getElementById("mySidenavR").style.width = "800px";
        $('.background_cart').show()
    }

    function closeNavR() {
        document.getElementById("mySidenavR").style.width = "0";
        $('.background_cart').hide()
    }
    $(document).ready(function(){
      var height = $('header').height();
      $('.header-height').css('height' , height)
    })
    
    
</script>
