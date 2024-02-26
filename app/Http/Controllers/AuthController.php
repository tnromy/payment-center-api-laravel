<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\UserRole;
use App\Models\SystemConfig;
use App\Models\Pegawai;
use App\Providers\Keycloak\Keycloak;
use Illuminate\Support\Facades\Redis;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myRedis() {
        session()->put('name', "tasya20");

        $data = session("name");

        return $data;

    }

    public function registerView()
    {
        //
        return view('pages.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function verificationEmail( $user_id ) {
        //
        $user = user::find( $user_id );
        $user->update( [
            'email_verified_at' => date( 'Y-m-d H:i:s' )
        ] );

        $emailConfirmedPage = SystemConfig::where( 'system_config_key', 'email_confirmed_redirect_page' )->first()->system_config_value;
        return redirect()->to( $emailConfirmedPage );
    }

    public function introspect() {
        $keycloak = new Keycloak();
        $result = $keycloak->getUserIntrospect("eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJjUlZZR2xpRk5QcnI1N3VNRnBwUXViSzgtajF3NU9xSVlFRVdpVElVMzMwIn0.eyJleHAiOjE3MDIwMDU2MTgsImlhdCI6MTcwMjAwNTQzOCwiYXV0aF90aW1lIjoxNzAyMDA1NDM3LCJqdGkiOiIwNTM5YzU1ZS0yNzIyLTRlMDEtYjc4ZC0yNWQ5OTAzMTc3NGEiLCJpc3MiOiJodHRwczovL3Nzby50YW5nZXJhbmdzZWxhdGFua290YS5nby5pZC9hdXRoL3JlYWxtcy9pbnRlcm5hbCIsImF1ZCI6ImFjY291bnQiLCJzdWIiOiI5YmU5YTA1Yi03ZWFjLTQ5N2EtODFmNC0zYjdhMmY5Y2EzOGQiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJzaW1wZWciLCJzZXNzaW9uX3N0YXRlIjoiNmRiNDE0YWItMTQ1MC00NjAxLWFhMGItYzc1NTQ4NTE0YTE3IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyJodHRwczovL2FwaXNpbXBlZy50YW5nZXJhbmdzZWxhdGFua290YS5nby5pZCIsImh0dHA6Ly9zaW1wZWctYXBwLnRlc3QiLCJodHRwOi8vbG9jYWxob3N0OjMwMDAvKiIsImh0dHBzOi8vZGV2bGFzaWsudGFuZ2VyYW5nc2VsYXRhbmtvdGEuZ28uaWQiLCJodHRwczovL2FwaXR0ZS50YW5nZXJhbmdzZWxhdGFua290YS5nby5pZCJdLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsiZGVmYXVsdC1yb2xlcy10YW5nZXJhbmdzZWxhdGFua290YS5nby5pZCIsIm9mZmxpbmVfYWNjZXNzIiwidW1hX2F1dGhvcml6YXRpb24iXX0sInJlc291cmNlX2FjY2VzcyI6eyJzaW1wZWciOnsicm9sZXMiOlsic3VwZXIgYWRtaW4iLCJBU04iXX0sImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoiZW1haWwgcHJvZmlsZSIsInNpZCI6IjZkYjQxNGFiLTE0NTAtNDYwMS1hYTBiLWM3NTU0ODUxNGExNyIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwaG9uZSI6IjA4Nzc4MTMwMzE1MiIsIm5hbWUiOiJUYXN5YSAzIiwicHJlZmVycmVkX3VzZXJuYW1lIjoidGFzeWEzIiwiZ2l2ZW5fbmFtZSI6IlRhc3lhIiwiZmFtaWx5X25hbWUiOiIzIiwiZW1haWwiOiJ0dWFuLnJvbXlAZ21haWwuY29tIn0.W9X-GwUZc_J6P7gZVwW9TlYJxj8NeADz62CubNXfvCepLwn5heIk8O_X2GFO_HiowDfehB4sq8YHg-6e6CoEXy5UTuxVcXeA7rdH0nl3y8qQmtXTenednS7F_RxzXDc0iWYWZBMlCnBNFLXFMY3lIgs0Z-Go0abe7Gswp3--qJr1Jelrs0hc4FcQSpXmLT4ud8uEUMZY9HzNlm0A4vS3yHuKVc1W9uNE0VxkzCwCwG3tKngT514K8I7e0vrDVBj8evG8taRakFqyv7j1VgKtGFtAmkAXrQmJYEq9j9ajS63JzsCHB_vPZKAFhG3jZWeZsxrxbC32_rnlzeEPvdGO0Q");

        var_dump($result->active);
    }

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
                "access_token" => $userToken["token"],
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

    public function login(Request $request) {
        

        $validator = \Validator::make($request->all(), [
            'username_or_email_or_nip'                 => 'required|string',
            'password'              => 'required|min:6|max:30',
        ]);

        if($validator->fails()) {
            return response()->json([
                "status" => [
                    "http_status_code" => 400,
                    "http_status_message" => "Bad Request"
                ],
                "errors" => $validator->errors(),
            ], 400);
        } // end validator fails

        if(user::isEmail($request->username_or_email_or_nip)) {
             $pegawai = pegawai::where('pegawai_email', $request->email)->first();

             if(!$pegawai) {
                return user::unAuth();
            } 
            $user = user::find($pegawai->user_id);
        } else {
                $user = user::where('username', $request->username_or_email_or_nip)->first();

                if(!$user) {
                     $pegawai = pegawai::where('nip_baru', $request->username_or_email_or_nip)->first();

             if(!$pegawai) {
                return user::unAuth();
            } 
            $user = user::find($pegawai->user_id);
                } // end if !$user
            } // end if else isEmail

        if(!Hash::check($request->password, $user->password)) {
            return user::unAuth();
            die();
        }


       $roles = UserRole::select([
        'roles.role_level',
        'roles.role_name'
       ])->join(
        'roles',
        'user_roles.role_level',
        '=',
        'roles.role_level'
       )->where('user_roles.user_id', $user->id)->get();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "status" => [
                "http_status_code" => 200,
                "http_status_message" => "OK"
            ],
            "result" => $user,
            "roles" => $roles,
            "auth" => [
                "access_token" => $token,
                "token_type" => "bearer"
            ],
        ], 200);
    }

    public function isLogedIn() {
         // return response()->json([
         //        "status" => [
         //            "http_status_code" =>200,
         //            "http_status_message" => "OK"
         //        ],
         //        "result" => 1, // end result
         //    ]);

        return response()->json([
                "status" => [
                    "http_status_code" => 401,
                    "http_status_message" => "Unauthorized"
                ],
                "errors" => "Email or password not match",
            ], 401);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
