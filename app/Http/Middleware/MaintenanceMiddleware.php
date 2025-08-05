<?php

namespace App\Http\Middleware;
use App\Helpers\helper;

class MaintenanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if(!file_exists(storage_path() . "/installed")) {
            return redirect('install');
            exit;
        }
        helper::language();
        if (\App\Helpers\helper::appdata()->maintenance_mode == 1){
            return response()->view('maintenance');
        }
        return $next($request);
    }
}
