<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GymResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $user = $request->route('card')->user;

        return [
            'status' => '200 OK',
            'object_name' => $this->resource->name,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name
        ];
    }
}
