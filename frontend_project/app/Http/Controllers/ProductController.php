<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Order_detail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CheckoutUserRequest;
use Illuminate\Support\Facades\DB;
use Str;
use Mail;


class ProductController extends Controller
{
    public function index(){
        $product = Product::query()->paginate(20);
        $category = Category::query()->get();
        return view('home.shop', compact('product' , 'category'));
    }
    public function detail($id){
        $product = Product::findOrFail($id);
        return view('home.product', compact('product'));
    }
    public function addToCart($id){
        
        $product = Product::find($id);
        $cart = Session::get('cart');
        if(isset($cart[$id])){
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
        }
        else{
            $cart[$id] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        Session::put('cart', $cart);
        
       
        return response()->json([
            'code' => 200,
            'message' => 'successful'
        ], 200);
    }
    public function showCart(){
        $cart = Session::get('cart');
   
        return view('cart.item', compact('cart'));
    }
    public function removeItemCart($id){
        $cart = Session::get('cart');
        unset($cart[$id]);
        return Session::put('cart' , $cart);
    }
    public function checkCart(){

        $cart = Session::get('cart');
        return view('cart.cart' , compact('cart'));

    }
    public function updateQuantity(Request $request, $id){
        $cart = Session::get('cart');
        $cart[$id]['quantity'] = $request->quantity;
        $total = 0;
        foreach($cart as $item){
            $total += $item['quantity'];
        }
        Session::put('cart', $cart);
        return $total;
    }
    public function checkCoupon(Request $request){
        $code = $request->code;
        $discount = Discount::where('code' , $code)->limit(1)->get();
        if(session('coupon')){
            return response()->json([
                'message' => 'You can only use one coupon',
                'code' => 200,
            ]);
        }else{
            if(!empty($discount[0])){
                $message = 'You have discount: ' . $discount[0]['percent'] . '%';
                $arr = [
                    'code' => $code,
                    'percent' => $discount[0]['percent']
                ];
                Session::put('coupon' , $arr);
                return response()->json([
                    'message' => $message,
                    'code' => 200,
                    'percent' => $discount[0]['percent']
                ]);
            }
            else{
                return response()->json([
                    'message' => 'Invalid Gif card/ Discount code',
                    'code' => 200,
                    'percent' => 0
                ]);
            }
        }
    }   
    public function checkOut(CheckoutUserRequest $request){
        $user = Session::get('user');
        $order_item = Session::get('cart');
        $total_price = 0;
        foreach($order_item as $item){
            $total_price += $item['quantity'] * $item['price'];
        }
        $coupon_code = '';
        $discount = 0;
        if(session('coupon')){
            $coupon = Session::get('coupon');
            $coupon_code = $coupon['code'];
            $discount = $coupon['percent'];
            $total_price = $total_price - ( $total_price * $coupon['percent'] / 100 );
        }
        Order::query()->create([
            'user_id' => $user['id'],
            'full_name' => $user['name'],
            'mobile' => $request->mobile,
            'email' => $request->email,
            'note' => $request->note,
            'address' => $request->address,
            'total_price' => $total_price,
            'payment_status' => 0 ,
            'coupon' => $coupon_code,
            'discount' => $discount
        ]);

        $order = DB::table('orders')->orderBy('id' , 'desc')->get();
        foreach( $order_item as $key=>$item ){
            Order_detail::query()->create([
                'order_id' => $order[0]->id,
                'product_id' => $key,
                'quantity' => $item['quantity']
            ]);
        }
        $email = $request->email; $name = $request->name;
        $data = ['order' => $order[0]];
        Mail::send('cart.sendMail', $data, function ($message) use( $email , $name ) {
            $message->from('mguyenminh99@gmail.com', 'Nguyễn Minh');
            $message->sender('mguyenminh99@gmail.com', 'Nguyễn Minh');
            $message->to($email, $name);
            $message->subject("You've a new order from Reptile Shop");
        });
        Session::forget('cart');
        Session::forget('coupon');
        return redirect()->route('payment.success')->with('success', 'Place order successful');
    }
    public function checkOutSuccess(){
        return view('cart.success');
    }
    public function category($slug, $id){
        $product = DB::table('products')->where('category_id' , $id)->paginate(15);
        $category = DB::table('categories')->get();
        $this_cate = DB::table('categories')->find($id);
        return view('home.category', compact('product', 'category', 'this_cate'));
    }
    public function filterItem(Request $request){
        $price = $request->price;
        $category_id = $request->category_id;
        if($category_id == ''){
            $products = DB::table('products')->where('price' , '>' ,$price )->orderBy('price', 'asc')->get();
        }else{
            $products = DB::table('products')->where('price' , '>' ,$price )->where('category_id', $category_id)->orderBy('price', 'asc')->get();
        }
        return view('product.filter', compact('products'));
    }
}