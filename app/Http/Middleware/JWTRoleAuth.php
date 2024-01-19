<?php

namespace App\Http\Middleware;



use auth;
use Closure;
use Exception;


use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\JWTAuth; // Importez la facade JWTAuth



class JWTRoleAuth extends BaseMiddleware
{ 
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next, $role = null)
    {
        try {
            $token_role = $this->auth->parseToken()->getClaim('role');
            
        } 
        catch (JWTException $e) {
            return response()->json(['error'=>'Unuthenticated.'],401);
        }
            if($token_role != $role){
                return response()->json(['error'=>'Unauthenticated.'],401);
            }
           
        
        return $next($request);
    }

}

