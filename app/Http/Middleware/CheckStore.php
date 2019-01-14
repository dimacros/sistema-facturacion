<?php

namespace App\Http\Middleware;

use Closure;
use App\Store;

class CheckStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( auth()->user()->hasRole('admin') ) {

            $store_exists = Store::where([
                'slug' => $request->slug,
                'company_id' => auth()->user()->company_id
            ])->exists();
            
            abort_unless($store_exists, 404);

        }
        else {
            abort_unless( auth()->user()->stores->contains('slug', $request->slug), 404);
        }
        
        return $next($request);
    }
}
