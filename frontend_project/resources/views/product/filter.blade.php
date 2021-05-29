@foreach ($products as $item)
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
