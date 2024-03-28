<?php

namespace App\Providers\Keycloak;

use Illuminate\Http\Request;
use App\Models\User;
use App\Providers\Keycloak\Keycloak;
use Illuminate\Support\Facades\Redis;


class KeycloakController extends  \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function getOauth2URL() {
        $keycloak = new Keycloak();
        $authUrl = $keycloak->getAuthorizationUrl();

         return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "result" => $authUrl,
        ], 200);
    }

    public function login(Request $request) {
         $validator = \Validator::make($request->all(),[
            'username' => 'required|string',
            'password' => 'required|string'

    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

         $keycloak = new Keycloak();
        $userToken = $keycloak->getUserAccessTokenForBackend([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "user" => $userToken["user"],
            "auth" =>[
                "access_token" => $userToken["token"]->getToken(),
                "expires" => $userToken["token"]->getExpires(),
                "token_type" => "bearer"
            ],
        ], 200);

        $results = contact::search($request->keyword)->paginate(6);

         return responseJsonForPaginate($results);
    
    }

    public function getLogoutURL(Request $request) {
        $keycloak = new Keycloak();
        $token = $request->bearerToken();

        $logoutURL = $keycloak->getLogoutUrl([
            'access_token' => $token,
            'redirect_uri' => env('KEYCLOAK_POST_LOGOUT_REDIRECT_URI'),
        ]);


         return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "result" => $logoutURL,
        ], 200);
    }

    public function getUserInfo(Request $request) {
        return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "user" => $request->keycloak(),
            "roles" => $request->keycloak()->resource_access->{env('KEYCLOAK_CLIENT_ID')}->roles
        ], 200);
    }

    public function getAccessToken(Request $request) {
        $keycloak = new Keycloak();
        $userToken = $keycloak->getUserAccessToken([
            'code' => $request->code,
            'state' => $request->state,
        ]);

        return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "user" => $userToken["user"],
            "auth" =>[
                "access_token" => $userToken["token"]->getToken(),
                "expires" => $userToken["token"]->getExpires(),
                "token_type" => "bearer"
            ],
        ], 200);
    }

    public function refreshToken(Request $request) {
        $keycloak = new Keycloak();

$token = $request->bearerToken();

list($header, $payload, $signature) = explode(".", $token);
    $payload = json_decode(base64_decode($payload));

    $userToken = json_decode(Redis::get('keycloak' . $payload->sub));

if($token == $userToken->token->access_token) {
    $userToken = $keycloak->getUserRefreshToken($userToken->token->refresh_token);
}

 return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "user" =>$userToken->user,
            "auth" =>[
                "access_token" => $userToken->token->access_token,
                "expires" => $userToken->token->expires,
                "token_type" => "bearer"
            ],
        ], 200);

    }
     
}
