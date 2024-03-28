<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactGroup;
use Carbon\Carbon;

class ContactGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
{
    // Mendapatkan user_id dari request (misalnya dari query string atau parameter route)
    $userId = $request->keycloak()->id;

    // Menggunakan metode whereHas untuk menyaring kontak yang terkait dengan user_id tertentu di table contact_accesses
    $contactGroups = ContactGroup::whereHas('user', function ($query) use ($userId) {
        $query->where('users.id', $userId);
    })->orderBy('last_use', 'desc')->paginate(8);

    return responseJsonForPaginate($contactGroups);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
         $validator = \Validator::make($request->all(),[
            'name' => 'required|string|unique:contact_groups,name',
            'contact_group_type_id' => 'required|integer|exists:contact_group_types,id'
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contactGroup = contactGroup::create([
            'name' => $request->name,
            'contact_group_type_id' => $request->contact_group_type_id,
        'last_use' => Carbon::now()
        ])->user()->attach([
            $request->keycloak()->id
        ]);

        return responseJsonOk($contactGroup);
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
