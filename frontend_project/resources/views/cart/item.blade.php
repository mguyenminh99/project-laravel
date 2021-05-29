        @if (session('cart')==false)
            <div class="empty-cart" style="color: white">
                <h2>Cart empty</h2>
                <button class="btn btn-light" onclick="closeNavR() ">Go shopping</button>
            </div>
        @endif
        
        @if (session('cart'))
            <div class="column-labels">
                <label class="product-image">Image</label>
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-removal">Remove</label>
                <label class="product-line-price">Total</label>
            </div>
            <div class="append_product">
                @php $total = 0; $total_item = 0; @endphp
                @foreach ($cart as $key=>$item)
                @php 
                $total += $item['price'] * $item['quantity']; $total_item += $item['quantity'];
                $product = DB::table('products')->find($key);
                @endphp
                <div class="product product_cart" style="height: 180px !important;">
                    <div class="product-image" >
                        <img src="http://localhost:8000/{{ $product->image }}">
                    </div>
                    <div class="product-details">
                        <div class="product-title">{{ $item['title'] }}</div>
                        {{-- <p class="product-description">Born from running culture, these men's shoes deliver the freedom of a cage-free design</p> --}}
                    </div>
                    <div class="product-price">{{ $item['price'] }}</div>
                    <div class="product-quantity">
                        <input style="width: 50px" type="number" value="{{ $item['quantity'] }}" min="1" data-id="{{ $key }}" >
                    </div>
                    <div class="product-removal">
                        <button class="remove-product" data-id="{{ $key }}" data-quantity="{{ $item['quantity'] }}">
                        Remove
                        </button>
                    </div>
                    <div class="product-line-price">{{ $item['price'] * $item['quantity'] }}</div>
                </div>
                @endforeach
            </div>
            <div class="total_item" data-id="{{ $total_item }}" ></div>
            
            <div class="totals">
                {{-- <div class="totals-item">
                <label>Subtotal</label>
                <div class="totals-value" id="cart-subtotal"></div>
                </div> --}}
                {{-- <div class="totals-item">
                <label>Tax (5%)</label>
                <div class="totals-value" id="cart-tax"></div>
                </div> --}}
                {{-- <div class="totals-item">
                <label>Shipping</label>
                <div class="totals-value" id="cart-shipping"></div>
                </div> --}}
                <div class="totals-item totals-item-total">
                <label>Grand Total</label>
                <div class="totals-value" id="cart-total">{{ $total }}</div>
                </div>
            </div>
                @if (session('user'))
                    <a href="{{ route('cart.check') }}"><button class="checkout">Checkout</button></a>
                @else   
                    <a href="javascript:void(0)" class="need_login"><button class="checkout">Checkout</button></a>
                @endif
        @endif

        <script>

            $(document).ready(function() {
                
                $('.need_login').click(function(){
                    if(confirm('You need login to checkout, your cart will be save')){
                        window.location.href = '/login-user';
                    }
                })  
                    
                
                /* Set rates + misc */
                var taxRate = 0;
                var shippingRate = 0; 
                var fadeTime = 300;
                
                
                /* Assign actions */
                $('.product-quantity input').change( function() {
                    var quantity = $(this).val();
                    var id = $(this).attr('data-id');
                    updateQuantity(this);
                    $.ajax({
                        url: '/changeQuantity/'+id,
                        data: {quantity:quantity},
                        type:'GET',
                        success: function(data) {
                            $('.checkout_items').text(data);
                        }
                    });
                });
                
                $('.product-removal button').click( function() {
                    removeItem(this);
                    var id = $(this).attr('data-id');
                    var quantity = $(this).attr('data-quantity');
                    var total_item = $('.total_item').attr('data-id');
                    var item = total_item - quantity;
                    console.log(quantity);
                    console.log(total_item);
                    $.ajax({
                        url: '/removeItemCart/'+id,
                        type:'GET',
                        success: function(data) {
                            $('.checkout_items').text(item);
                        }
                    });
                });
                
                
                /* Recalculate cart */
                function recalculateCart()
                {
                var subtotal = 0;
                
                /* Sum up row totals */
                $('.product_cart').each(function () {
                    subtotal += parseFloat($(this).children('.product-line-price').text());
                });
                
                /* Calculate totals */
                var tax = subtotal * taxRate;
                var shipping = (subtotal > 0 ? shippingRate : 0);
                var total = subtotal;
                
                /* Update totals display */
                $('.totals-value').fadeOut(fadeTime, function() {
                    $('#cart-subtotal').html(subtotal.toFixed(2));
                    $('#cart-tax').html(tax.toFixed(2));
                    $('#cart-shipping').html(shipping.toFixed(2));
                    $('#cart-total').html(total.toFixed(2));
                    if(total == 0){
                    $('.checkout').fadeOut(fadeTime);
                    }else{
                    $('.checkout').fadeIn(fadeTime);
                    }
                    $('.totals-value').fadeIn(fadeTime);
                });
                }
                
                
                /* Update quantity */
                function updateQuantity(quantityInput)
                {
                /* Calculate line price */
                var productRow = $(quantityInput).parent().parent();
                var price = parseFloat(productRow.children('.product-price').text());
                var quantity = $(quantityInput).val();
                var linePrice = price * quantity;
                
                /* Update line price display and recalc cart totals */
                productRow.children('.product-line-price').each(function () {
                    $(this).fadeOut(fadeTime, function() {
                    $(this).text(linePrice.toFixed(2));
                    recalculateCart();
                    $(this).fadeIn(fadeTime);
                    });
                });  
                }
                
                
                /* Remove item from cart */
                function removeItem(removeButton)
                {
                /* Remove row from DOM and recalc cart total */
                var productRow = $(removeButton).parent().parent();
                productRow.slideUp(fadeTime, function() {
                    productRow.remove();
                    recalculateCart();
                });
                }
                
            });
                
        </script>
            
            