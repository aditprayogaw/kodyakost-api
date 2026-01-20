<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        // Cek apakah user yang sedang login adalah owner dari resource yang diakses
        if ($request->user() && $request->user()->role !== 'owner') {
            return response()->json(['message' => 'Akses ditolak. Khusus Owner!'], 403);
        }
        
        return $next($request);
    }
}
