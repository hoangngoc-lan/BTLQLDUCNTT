<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminLevelCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->get('admin_details')->level != '1') {
            return redirect()->route('admin_book_lists');
        }
        return $next($request);
    }
}
