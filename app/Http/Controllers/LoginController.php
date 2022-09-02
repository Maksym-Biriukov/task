<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manager;

class LoginController extends Controller
{
    public function login(Request $request){
        try{
            $data = [];
            $login = $request->input("login");
            $password = md5(md5($request->input("password")));
            $manager = Manager::where("login", $login)->firstOrFail();
            $managerId = $manager['id'];
            if ($password == $manager['password']){
                session([
                    'loginError' => '',
                    'idManager' => $managerId
                ]);

                return redirect()->route('cart_page');
            }
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
