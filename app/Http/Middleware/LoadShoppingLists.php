<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;

class LoadShoppingLists
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
        if(Auth::user())
        {
            if( !session()->has('cart.default') )
            {
                try{
                    Cart::instance('default')->restore(Auth::User()->email);
                }
                catch(Exception $e){
                    Log::error("Error restoring cart in LoadShoppingLists\n" . $e);
                }
                try{
                    Cart::instance('default')->erase(Auth::User()->email);
                    Cart::instance('default')->store(Auth::User()->email);
                }
                catch(Exception $e){
                    Log::error("Error storing cart in LoadShoppingLists\n" . $e);
                }
            }
            if( !session()->has('cart.wishlist'))
            {
                try{
                    Cart::instance('wishlist')->restore(Auth::User()->email);
                }
                catch(Exception $e){
                    Log::error("Error restoring wishlist in LoadShoppingLists\n" . $e);
                }
                try{
                    Cart::instance('wishlist')->erase(Auth::User()->email);
                    Cart::instance('wishlist')->store(Auth::User()->email);
                }
                catch(Exception $e){
                    Log::error("Error storing wishlist in LoadShoppingLists\n" . $e);
                }
            }
        }
        
        return $next($request);
    }
}
