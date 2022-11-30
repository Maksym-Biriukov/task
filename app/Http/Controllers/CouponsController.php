<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Session;
use App\Models\Categories;

class CouponsController extends Controller
{
    function addCoupon(){

        $addCouponName = $request->input("product_name_new");
        $addCouponValue = $request->input("product_new_cost");
        $addCouponType = $request->input("category_id");
        $addCouponCode =
        $addCouponExpire =
        $addCouponId =
        $addCouponScope =
        $addCouponLabel =
        $Coupon = Product::create([
            'name' => $addProductName,
            'cost' => $addProductCost,
            'picture_file_name' => $imageName,
            'category_id' =>$addCategoryId,
        ]);

    }
    function activateCoupon(){

    }
    function allcoupons(){
        return view("coupons");
    }


}
