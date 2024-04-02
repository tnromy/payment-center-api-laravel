<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailProvider;

class MailController extends Controller
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
    public function store(Request $request)
    {
        //
        $mail = new MailProvider(
            template: "mails.main",
            subject: "ini pesan pakai harus default queue"
        );

        \Mail::to('tuanromy@gmail.com')->send($mail);

        return "sudah";
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
