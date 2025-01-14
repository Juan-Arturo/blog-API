<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;


class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       try {
         $user = JWTAuth::parseToken()->authenticate();
       }catch (TokenExpiredException $e) {
        return response()->json(['error' => 'token_expired'], 401);
      } catch (TokenInvalidException $e) {
        return response()->json(['error' => 'token_invalid'],401);
      } catch (JWTException $e) {
        return response()->json(['error' => 'token_absent'], 401);
      } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
      }

      return $next($request);
    }
}
