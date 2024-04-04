<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessMail;

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
     ProcessMail::dispatch(
        configId: 1,
        from: [
                        "name" => "dari controller",
                        "email" => "designer@cybercenter.co.id"
                    ],
                    replyTo: [
                        "name" => "dari controller",
                        "email" => "designer@cybercenter.co.id"
                    ],
                    to: "tuanromy@gmail.com",
                    subject: "coba 200",
                    template: "mails.main"
     );

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
