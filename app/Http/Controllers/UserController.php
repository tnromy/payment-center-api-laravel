<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\MailProvider;
use App\Models\Component;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function show( Request $request) {
       //
         $request->merge(['user_id' => $request->route('user_id')]);

        $validator = \Validator::make($request->all(),[
      'user_id' => 'required|integer|exists:users,id',


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

        $user = user::getProfileInfo($request->user_id);

        return response()->json([
                "status" => [
                    "http_status_code" =>200,
                    "http_status_message" => "OK"
                ],
                "result" => $user
            ]);
    }

    public function updateAva(Request $request) {
        $validator = \Validator::make($request->all(),[
      'ava_image' => 'required|mimes:png,jpg|max:10000',


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

        $url = user::updateAva($request->file('ava_image'), $request->user()->id);

         return response()->json([
                "status" => [
                    "http_status_code" =>200,
                    "http_status_message" => "OK"
                ],
                "result" => $url
            ]);
    }

    public function register(Request $request) {
       $validator = \Validator::make($request->all(),[
        'username' => 'required|string|unique:users,username',
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => "required|digits_between:10,12|unique:users,phone",
            'password' => 'required|min:6|max:30|confirmed',
            "password_confirmation" => 'required|same:password'

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

       $user = user::create([
        'username' => $request->username,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),

    ]);

       $genUrl = Component::genExpireUrl('email.verification', $user->id);
       $verificationURL = $genUrl['url'];

        $email = new MailProvider([
            'verification_url' => $verificationURL,
            'full_name' => $user->full_name,
            'subject' => 'Register Confirmation',
            'view' => 'mail.register-confirmation'
        ]);
            \Mail::to($user->email)->queue($email);

            return response()->json([
                "status" => [
                    "http_status_code" =>200,
                    "http_status_message" => "OK"
                ],
                "result" => [
                    "email_status" => [
                        "mail_verification_url_status" => "sent",
                        "verification_url_sent_to" => $user->email,
                        "verification_url_expired" => $genUrl['expired']
                    ],
                    "user" => $user
                ] // end result
            ]);
    }

     public function mailConfirmation($user_id) {
        //
        $user = user::where('id', $user_id)->firstOrFail();
        $user->update([
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        if(!$user->password) {
           $genUrl = Component::genExpireUrl('user.setpassword', $user->id);
       $setPassUrl = $genUrl['url'];

            return view('auth.setpassword', compact([
                'setPassUrl',
            ]));
        } // end passwerd empty

        return response()->json([
            "status" => [
                "http_status_code" =>200,
                "http_status_message" => "OK"
            ],
            "result" => "Email verification successfully"
        ]);
    }

    public function searchUser(Request $request) {
         $validator = \Validator::make($request->all(),[
            'keyword' => 'required|string',

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

        $users = user::where('email', 'like', '%' . $request->keyword . '%')->whereNull('deleted_at')->paginate(6);

         return responseJsonForPaginate($users);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
