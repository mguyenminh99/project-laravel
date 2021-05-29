<style>
    .sale{
        text-decoration: line-through;
    }
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 20px;
}
</style>
thanks for buying at the shop!
<br>
Your order : 
<br>
<table>
    <tr>
        <th>Full Name</th>
        <th>Address</th>
        <th>Mobile phone</th>
        <th>Email</th>
        <th>Note</th>
        <th>Coupon</th>
        <th>Discount</th>
        <th>Total Price</th>
        <th>Order date</th>
    </tr>
    <tr>
       
        <td>{{ $order->full_name }}</td>
        <td>{{ $order->address }}</td>
        <td>{{ $order->mobile }}</td>
        <td>{{ $order->email }}</td>
        <td>{{ $order->note }}</td>
        <td>{{ $order->coupon }}</td>
        <td>{{ $order->discount }} %</td>
        <td>$ {{ $order->total_price }}</td>
        <td>{{ date('Y-m-d h:i:sa',  strtotime($order->created_at)) }}</td>
    </tr>
</table>
<br>

Order detail
<table >
    <tr>
        <th></th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
    </tr>
        @php
            use Illuminate\Support\Facades\DB;
            use App\Models\Product;

            $order_detail = DB::table('order_details')->where('order_id' , $order->id)->get()->toArray();
        @endphp
        @foreach ($order_detail as $key=>$item)
        @php
            $product = DB::table('products')->find($item->product_id);
        @endphp
        <tr>
            <td><img src="http://localhost:8000/{{ $product->image }}" alt=""></td>
            <td>{{ $product->title }}</td>
            @if ($product->is_sale > 0)
            @php
                $price_sale = $product->price - ( $product->price * $product->is_sale / 100 )
            @endphp
                <td>
                    $ {{ $price_sale }}
                </td>
            @else
            <td class="{{ ($product->is_sale > 0)?'sale':'' }}" >$ {{ $product->price}}</td>

            @endif
            <td>
                {{ $item->quantity }}
            </td>
        </tr>

        @endforeach
       
</table>