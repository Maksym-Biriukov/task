<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Session;

class ProductsController extends Controller
{
    public function get(){
        $data = []; 
        $data['products'] = Product::all();
        !session()->has('cart') && session()->put('cart', []);
        $data['totalSum'] = 0;
        foreach(session()->get('cart') as $product){
            $data['totalSum'] += floatval($product['cost'])*floatval($product['count']);
        }
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

        return redirect()->route('cart.page');
    }
    public function add(Request $request)
    {
        $addProductCode = $request->input("product_code");
        $addProductCount = $request->input("product_count");


        $product = Product::where('id', $addProductCode)->update(['count' => $addProductCount]);

        return redirect()->route('cart.page');
    }
    public function addToCart(Request $request)
    {
        $addToCartProductCode = $request->input("products_add_code");
        $addToCartProductCount = (double)$request->input("products_add_count");
        $bool = false;
        try{
            $product = Product::where('id', $addToCartProductCode)->firstOrFail();
            $productdetector = session()->pull('cart');
            foreach(array_keys($productdetector) as $productPos){
                if($productdetector[$productPos]['id'] == $product['id']){
                    $productdetector[$productPos]['count'] += $addToCartProductCount;
                    $bool = true;
                }
            }
            if(!$bool){
                $productdetector[] = ['id' => $product['id'], "name" => $product['name'], "cost" => $product['cost'], "count" => $addToCartProductCount];
            }
            
            session()->put('cart', $productdetector);
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            session()->put('errors', 'There is no product with that code');
        }
        return redirect()->route('cart.page');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.page');
    }
    public function delete($id)
    {
        $deleteProductPosition = session()->pull('cart');
        foreach(array_keys($deleteProductPosition) as $product){
            if ($deleteProductPosition[$product]['id'] == $id)
                unset($deleteProductPosition[$product]);
        }
        session()->put('cart', $deleteProductPosition);
        return redirect()->route('cart.page');
    }

    public function paymentCard(Request $request)
    {
        $ses = Session::find(session()->get('session_id'));
        $ses->card_total += (double) $request->input('totalSum');
        $ses->save();
        session()->put("cart", []);
        return redirect()->route("cart.page");
    }

    public function paymentCash(Request $request)
    {
        $ses = Session::find(session()->get('session_id'));
        $ses->cash_total += (double) $request->input('totalSum');
        $ses->save();
        session()->put("cart", []);
        return redirect()->route("cart.page");
    }
}
