<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        try{
            if(Auth::check()){
                return $next($request);
            }
            throw new \Exception("You need to be authorized");
            

        }catch(\Exception $e){

            session([
                'loginError' => $e->getMessage(),
            ]);

            return redirect()->route('manager.login_page');
        }
        
    }
}
