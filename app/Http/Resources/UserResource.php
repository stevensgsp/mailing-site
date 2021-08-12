<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'cedula'       => $this->cedula,
            'birth_date'   => $this->birth_date,
            'age'          => Carbon::parse($this->birth_date)->age,
            'logs'         => $this->logs,
            'city'         => $this->city->name,
        ];
    }
}
