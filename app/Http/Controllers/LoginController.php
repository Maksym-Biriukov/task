<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Manager;
use App\Models\Session;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function get(){
        if(($idManager = session()->get("idManager")) != ""){
            return redirect()->route('cart.page');
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
     
                $sesId = Session::create(['id_manager' => Auth::id()]);

                session([
                    'loginError' => '',
                    "session_id" => $sesId['id']
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
            return redirect()->route('manager.login_page');
        }
        catch(\Exception $e){
            session([
                'loginError' => $e->getMessage(),
            ]);
            return redirect()->route('manager.login_page');
        }
    }

    public function logout(Request $request)
    {
        // dd(session()->get("session_id"));
        $ses = Session::find(session()->get("session_id"));
        // dd(date("Y-m-d h:i:s"));
        $ses->date_end = Carbon::now()->format("Y-m-d H:i:s");
        $ses->save();
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        //
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
