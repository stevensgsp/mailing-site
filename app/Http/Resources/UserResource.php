<?php

namespace App\Http\Resources;

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
            'name'         => $this->name,
            'email'        => $this->email,
            'phone_number' => $this->phone_number,
            'cedula'       => $this->cedula,
            'birth_date'   => $this->birth_date,
            'age'          => $this->birth_date->age,
            'logs'         => $this->logs,
            'city'         => $this->city->name,
        ];
    }
}
