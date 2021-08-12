<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\StateResource;
use App\Models\Country;
use App\Models\State;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  string  $countryId
     * @return \Illuminate\Http\Response
     */
    public function statesByCountry($countryId)
    {
        // get country
        $country = Country::findOrFail($countryId);

        return StateResource::collection($country->states);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $stateId
     * @return \Illuminate\Http\Response
     */
    public function citiesByState($stateId)
    {
        // get state
        $state = State::findOrFail($stateId);

        return CityResource::collection($state->cities);
    }
}
