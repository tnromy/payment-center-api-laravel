<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Mendapatkan user_id dari request (misalnya dari query string atau parameter route)
    $userId = $request->keycloak()->id;

    // Menggunakan metode whereHas untuk menyaring kontak yang terkait dengan user_id tertentu di table contact_accesses
    $contacts = Contact::whereHas('user', function ($query) use ($userId) {
        $query->where('users.id', $userId);
    })->orderBy('last_use', 'desc')->paginate(8);

    return responseJsonForPaginate($contacts);
}


    /**
     * Store a newly created resource in storage.
     */
    public function contactGroups(Request $request) {
        $userId = $request->keycloak()->id;

        $contactGroups =  Contact::whereHas('user', function ($query) use ($userId) {
        $query->where('users.id', $userId);
    })->where('id', $request->route('id'))->orderBy('last_use', 'desc')->firstOrFail()->contactGroup;

        return responseJsonOk($contactGroups);
    }

    public function search(Request $request) {
         $validator = \Validator::make($request->all(),[
            'keyword' => 'required|string',

    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $results = contact::search($request->keyword)->paginate(6);

         return responseJsonForPaginate($results);
    }

    public function store(Request $request)
    {
        //
         $validator = \Validator::make($request->all(),[
      'full_name' => "required|string",
        'email' => "required|email|unique:contacts,email",
        'phone' => "nullable|string|unique:contacts,phone",
        'whatsapp' => "nullable|string|unique:contacts,whatsapp",
        'telegram' => "nullable|string|unique:contacts,telegram",
        'tel' => "nullable|string|unique:contacts,tel",
        'addr_detail' => "nullable|string",
        'addr_pos_code' => "nullable|integer",
        'location_code' => "nullable|string|exists:locations,code"
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
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
        'last_use' => Carbon::now()
        ])->user()->attach($request->keycloak()->id);

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
    public function update(Request $request)
    {
        //
         $validator = \Validator::make($request->all(),[
      'id' => 'required|integer|exists:contacts,id',
      'full_name' => "nullable|string",
        'email' => "nullable|email",
        'phone' => "nullable|string",
        'whatsapp' => "nullable|string",
        'telegram' => "nullable|string",
        'tel' => "nullable|string",
        'addr_detail' => "nullable|string",
        'addr_pos_code' => "nullable|integer",
        'location_code' => "nullable|string|exists:locations,code"
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contact = contact::where('id', $request->id)->firstOrFail();

        $contact->update([
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
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $request->merge(['id' => $request->route('id')]);

        $validator = \Validator::make($request->all(),[
            'id' => 'required|integer|exists:contacts,id',

    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contact = contact::find($request->id);

        //$contact->contactGroup()->detach();
        //$contact->user()->detach();

        $contact->delete();

        return responseJsonOk($contact);
    }
}
