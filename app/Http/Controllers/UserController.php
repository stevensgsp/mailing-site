<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get users
        $users = User::orderByDesc('is_admin')->orderByDesc('created_at')->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get countries
        $countries = Country::all();

        return view('users.create', compact('countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // get user
        $user = User::findOrFail($id);

        // get countries
        $countries = Country::all();

        // get states
        $states = $user->city->state->country->states;

        // get cities
        $cities = $user->city->state->cities;

        return view('users.edit', compact('countries', 'states', 'cities', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // request inputs
        $input = $request->validated();

        // create user
        $user = User::create($input);

        return redirect()->route('users.index')->with('success', 'User stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get user
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        // get user
        $user = User::findOrFail($id);

        // request inputs
        $input = $request->validated();

        // update user
        $user->update($input);

        return redirect()->route('users.index')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get user
        $user = User::findOrFail($id);

        // (soft) delete user
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted!');
    }
}
