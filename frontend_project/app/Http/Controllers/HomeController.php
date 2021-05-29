<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Str;

class HomeController extends Controller
{
    public function index(){
        
        $products = Product::query()->limit(20)->get();
        return view('home.home', compact('products'));
    }
}
