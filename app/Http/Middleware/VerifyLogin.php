<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    /*protected $except = 
    [
        'http://localhost:8000/login*'
    ];*/

    public function handle(Request $request, Closure $next)
    {
        try{
            if(session()->has('idManager')){
                return $next($request);
            }
            throw new \Exception("You need to be authorized");
            

        }catch(\Exception $e){

            session([
                'loginError' => $e->getMessage(),
            ]);

            return redirect()->route('login_page');
        }
        
    }
}
