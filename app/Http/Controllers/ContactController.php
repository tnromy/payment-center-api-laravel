<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contacts = contact::paginate(12);

        return responseJsonForPaginate($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function search(Request $request) {
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

        $results = contact::search($request->keyword)->paginate(6);

         return responseJsonForPaginate($results);
    }

    public function store(Request $request)
    {
        //
         $validator = \Validator::make($request->all(),[
      'full_name' => "required|string",
        'email' => "required|email",
        'phone' => "nullable|string",
        'whatsapp' => "nullable|string",
        'telegram' => "nullable|string",
        'tel' => "nullable|string",
        'addr_detail' => "nullable|string",
        'addr_pos_code' => "nullable|integer",
        'location_code' => "nullable|string|exists:locations,code"
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

        $contact = contact::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
        'whatsapp' => $request->whatsapp,
        'telegram' => $request->telegram,
        'tel' => $request->tel,
        'addr_detail' => $request->addr_detail,
        'addr_pos_code' => $request->addr_pos_code,
        'location_code' => $request->location_code,
        ]);

        return responseJsonOk($contact);
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
