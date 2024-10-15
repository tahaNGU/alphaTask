<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class apiWhiteList
{
    protected $whitelist = [
        '127.0.0.1',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $clientIp = $request->ip();
          if (!in_array($clientIp, $this->whitelist)) {
              return response()->json(['message' => 'Forbidden'], Response::HTTP_FORBIDDEN);
          }
  
          return $next($request);
    }
}
