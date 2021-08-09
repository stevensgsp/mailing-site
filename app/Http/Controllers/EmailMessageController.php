<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmailMessageRequest;
use App\Http\Resources\EmailMessageResource;
use App\Models\EmailMessage;
use Illuminate\Http\Request;

class EmailMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get email messages
        $emailMessages = EmailMessage::all();

        return EmailMessageResource::collection($emailMessages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmailMessageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmailMessageRequest $request)
    {
        // request inputs
        $input = $request->validated();

        // get user
        $user = auth()->user();

        // create email message
        $emailMessage = $user->emailMessages()->create($input);

        return new EmailMessageResource($emailMessage);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get email message
        $emailMessage = EmailMessage::findOrFail($id);

        # TODO: verificar que usuario logueado es el que ha realizado el email

        return new EmailMessageResource($emailMessage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
