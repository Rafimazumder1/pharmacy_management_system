<?php

namespace App\Http\Middleware;

use App\Models\Shop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetTimeZone
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $shop = Shop::findOrFail(Auth::user()->shop_id);
            if (!empty($shop) && !empty($shop->time_zone)) {
                date_default_timezone_set($shop->time_zone);
            }
        }

        date_default_timezone_set('Asia/Dhaka');
        return $next($request);
    }
}
