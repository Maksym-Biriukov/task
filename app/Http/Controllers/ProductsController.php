<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\ViewErrorBag;

class ProductsController extends Controller
{
    public function get(){
        $data = []; 
        $data['products'] = Product::all();
        !session()->has('cart') && session()->put('cart', []);
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
        // echo "<pre>";
        //dd(session()->get('cart'));
        $bool = false;
        try{
            $product = Product::where('id', $addToCartProductCode)->firstOrFail();
            $productdetector = session()->pull('cart');
            dd($productdetector);
            for ($i = 0; $i < count($productdetector); $i++){
                // echo($productdetector[$i]['id']." => ".$product['id']);
                if($productdetector[$i]['id'] == $product['id']){
                    $productdetector[$i]['count'] += $addToCartProductCount;
                    $bool = true;
                }
            }
            if($bool == true){
                session()->put('cart', $productdetector);
            }else{
                //dd(array_push($productdetector, ['id' => $product['id'], "name" => $product['name'], "cost" => $product['cost'], "count" => $addToCartProductCount]));
                session()->put('cart', array_push($productdetector, ['id' => $product['id'], "name" => $product['name'], "cost" => $product['cost'], "count" => $addToCartProductCount]));
            }
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            //$request->session()->put('errors', 'There is no product with that code');
        }
        // var_dump(session()->get('cart'));
        // echo "</pre>";
        return redirect()->route('cart.page');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.page');
    }
    public function delete($id)
    {
        $deleteProductPosition = session()->forget('cart', $id);
        return redirect()->route('cart.page');
    }

}
