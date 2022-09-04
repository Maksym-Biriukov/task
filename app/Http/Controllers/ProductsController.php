<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function get(){
        $data = []; 
        $data['products'] = Product::all();
        return view("cart", $data);
    }
    public function create(Request $request)
    {
        $addProductName = $request->input("product_name_new");
        $addProductCost = $request->input("product_new_cost");

        $product = Product::create([
            'name' => $addProductName,
            'cost' => $addProductCost
        ]);

        return redirect()->route('cart_page');
    }
    public function add(Request $request)
    {
        $addProductCode = $request->input("product_code");
        $addProductCount = $request->input("product_count");


        $product = Product::where('id', $addProductCode)->update(['count' => $addProductCount]);

        return redirect()->route('cart_page');
    }
    public function addToCart(Request $request)
    {
        $addToCartProductCode = $request->input("products_add_code");
        $addToCartProductCount = $request->input("product_add_count");


        $product = Product::where('id', $addProductCode)->update(['count' => $addProductCount]);

        return redirect()->route('cart_page');
    }
}
