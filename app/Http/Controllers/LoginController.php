<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;

class LoginController extends Controller
{
    public function get(){
        if(($idManager = session()->get("idManager")) != ""){
            return redirect()->route('cart_page');
        }
        return view("login");
    }

    public function login(Request $request){
        try{
            $credentials = [
                "login" => $request->input("login"),
                "password" => $request->input("password")
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
     
                session([
                    'loginError' => '',
                    'idManager' => $managerId
                ]);

                return redirect()->intended('cart');
            }
            else
                throw new \Exception("Wrong password");
        }
        catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            session([
                'loginError' => "Wrong login",
            ]);
            return redirect()->route('login_page');
        }
        catch(\Exception $e){
            session([
                'loginError' => $e->getMessage(),
            ]);
            return redirect()->route('login_page');
        }
    }
}
