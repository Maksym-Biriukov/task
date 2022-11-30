<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Session;
use App\Models\Categories;
use Illuminate\Support\Facades\Mail;
use App\Mail\FeedbackMail;

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
        // $request->validate([
        //     'products_image' => 'required|image|mimes:jpeg,jpg',
        // ]);
  
        $imageName = time().'.'.$request->products_image->extension();  
   
        $request->products_image->move(storage_path('app/public/images'), $imageName);


        $addProductName = $request->input("product_name_new");
        $addProductCost = $request->input("product_new_cost");
        $addCategoryId = $request->input("category_id");
        $product = Product::create([
            'name' => $addProductName,
            'cost' => $addProductCost,
            'picture_file_name' => $imageName,
            'category_id' =>$addCategoryId,
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
        $products = session()->pull('cart');
        $Order = Orders::create([
            'id_session' => session()->get("session_id"),
            'type' => 'card',
            'total' => $request->input('totalSum'),
        ]);
        
        foreach($products as $product){
            $productUpd = Product::find($product['id']);
            $productUpd->count -= $product['count'];
            $productUpd->save();
            $productsToOrder = DB::table('products_to_orders')->insert([
                'id_order' => $Order['id'],
                'id_product' => $product['id'],
                'count' => $product['count']
            ]);

        }
        $comment = 'Это сообщение отправлено из формы обратной связи';
        $toEmail = "qweeasdrftg2@ukr.net";
        Mail::to($toEmail)->send(new FeedbackMail($comment));
        
        return redirect()->route("cart.page");
    }

    public function paymentCash(Request $request)
    {
        $ses = Session::find(session()->get('session_id'));
        $ses->cash_total += (double) $request->input('totalSum');
        $ses->save();
        $products = session()->pull('cart');
        $Order = Orders::create([
            'id_session' => session()->get("session_id"),
            'type' => 'cash',
            'total' => $request->input('totalSum'),
        ]);
        foreach($products as $product){
            $productUpd = Product::find($product['id']);
            $productUpd->count -= $product['count'];
            $productUpd->save();
            $productsToOrder = DB::table('products_to_orders')->insert([
                'id_order' => $Order['id'],
                'id_product' => $product['id'],
                'count' => $product['count']
            ]);

        }
        $comment = 'Это сообщение отправлено из формы обратной связи';
        $toEmail = "postmaster@sandbox92f98cbc95e14ef58ae10352094dde94.mailgun.org"; 
        Mail::to($toEmail)->send(new FeedbackMail($comment));
        
        return redirect()->route("cart.page");
    }

    public function all(Request $request)
    {   
        $Products = DB::table('products')
        ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        ->get();
        $data = [];
        $data['products'] = $Products;
        
        return view("allProducts", $data);
    }
    public function catrgoryAdd(Request $request)
    {
        $addCategory = $request->input("category_name");
        
        $category = Categories::create([
            'category' => $addCategory,
        ]);
        
        return redirect()->route("all");
    }
}
