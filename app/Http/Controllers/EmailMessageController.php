<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmailMessageRequest;
use App\Http\Resources\EmailMessageResource;
use App\Models\EmailMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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
        $emailMessages = auth()->user()->emailMessages()->orderByDesc('created_at')->get();

        return view('emailMessages.index', compact('emailMessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emailMessages.create');
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
        $user->emailMessages()->create($input);

        return redirect()->route('emailMessages.index')->with('success', 'Email stored!');
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

        // abort if the user is not who created the email message
        abort_if(! $emailMessage->wasCreatedBy(auth()->user()), 401);

        return view('emailMessages.show', compact('emailMessage'));
    }

    /**
     * Send the email messages that has not been sent yet.
     *
     * @return \Illuminate\Http\Response
     */
    public function queueEmailMessages()
    {
        // get user
        $user = auth()->user();

        // get email messages
        $emailMessages = $user->emailMessages()->notSent()->get();

        if ($emailMessages->isEmpty()) {
            return redirect()->route('emailMessages.index')->with('success', 'No email messages to queue.')->with('type', 'yellow');
        }

        // call artisan command to queue the email messages
        Artisan::call('queue:mails', [
            '--user' => $user->id
        ]);

        return redirect()->route('emailMessages.index')->with('success', 'Email messages queued!');
    }
}
