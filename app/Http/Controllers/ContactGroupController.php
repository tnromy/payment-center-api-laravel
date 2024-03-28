<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactGroup;
use App\Models\Contact;
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

public function getMembers(Request $request)
{
    // Mendapatkan user_id dari request (misalnya dari query string atau parameter route)
    $request->merge(['id' => $request->route('id')]);

         $validator = \Validator::make($request->all(),[
            'id' => 'required|integer|exists:contact_groups,id'
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contactGroupId = $request->id;

    // Menggunakan metode whereHas untuk menyaring kontak yang terkait dengan user_id tertentu di table contact_accesses
    $members = Contact::whereHas('contactGroup', function ($query) use ($contactGroupId) {
        $query->where('contact_groups.id', $contactGroupId);
    })->orderBy('last_use', 'desc')->paginate(8);

    return responseJsonForPaginate($members);
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
        ])->user()->attach($request->keycloak()->id);

        return responseJsonOk($contactGroup);
    }

    public function addMember(Request $request)
    {
        //
         $request->merge(['id' => $request->route('id')]);

         $validator = \Validator::make($request->all(),[
            'contact_id' => 'required|integer|exists:contacts,id',
            'id' => 'required|integer|exists:contact_groups,id'
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contactGroup = contactGroup::find($request->id);

        $contactGroup->contact()->attach($request->contact_id);

        return responseJsonOk($contactGroup);
    }

    public function removeMember(Request $request)
    {
        //
         $request->merge(['id' => $request->route('id')]);

         $validator = \Validator::make($request->all(),[
            'contact_id' => 'required|integer|exists:contacts,id',
            'id' => 'required|integer|exists:contact_groups,id'
    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contactGroup = contactGroup::find($request->id);

        $contactGroup->contact()->detach($request->contact_id);

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
    public function destroy(Request $request)
    {
        //
        $request->merge(['id' => $request->route('id')]);

        $validator = \Validator::make($request->all(),[
            'id' => 'required|integer|exists:contact_groups,id',

    ]);

        if($validator->fails()) {
            return responseJsonError400($validator->errors());
        } // end validator fails

        $contactGroup = contactGroup::find($request->id);

        $contactGroup->contact()->detach();
        $contactGroup->user()->detach();

        $contactGroup->delete();

        return responseJsonOk($contactGroup);
    }
}
