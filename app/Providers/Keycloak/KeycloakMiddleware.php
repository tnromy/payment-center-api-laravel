<?php

namespace App\Providers\Keycloak;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Providers\Keycloak\Keycloak;

class KeycloakMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role=null): Response
    {
       $keycloak = new Keycloak();

        $token = $request->bearerToken();

        if(!$token) {
            return response()->json([
                "status" => [
                    "http_status_code" => 401,
                    "http_status_message" => "Unauthorized"
                ],
                "errors" => "access_token must be included",
            ], 401);
        } // end if no $token

        $decodedToken = $keycloak->getUserIntrospect($token);

        if(!$decodedToken->active) {
             return response()->json([
                    "status" => [
                        "http_status_code" => 401,
                        "http_status_message" => "Unauthorized"
                    ],
                    "errors" => "Token Expired",
                ], 401);
        }

        if($role) {
            if(!$decodedToken->hasRole($role)) {
               return response()->json([
                    "status" => [
                        "http_status_code" => 401,
                        "http_status_message" => "Unauthorized"
                    ],
                    "errors" => "Access Deny. You'r not " . $role,
                ], 401);
            } 
        } // end if $role

$request->macro('keycloak', function () use ($decodedToken) {
            // Implementasikan logika Anda di sini, misalnya mengambil data dari $this->attributes
            // Sesuaikan dengan kebutuhan Anda
            return $decodedToken;
        });

         return $next($request);
    }
}
