<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UserRole;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isAdmin = UserRole::isAdmin($request->user()->id);

        if($isAdmin) {
            return $next($request);
        }

        return response()->json([
                "status" => [
                    "http_status_code" => 401,
                    "http_status_message" => "Unauthorized"
                ],
                "errors" => "You are not an Administrator",
            ], 401);
    }
}
