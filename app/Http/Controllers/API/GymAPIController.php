<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GymReceptionRequest;
use App\Http\Resources\GymResource;
use App\Models\Card;
use App\Models\Gym;

class GymAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\GymReceptionRequest  $request
     * @param  \App\Models\Gym  $gym
     * @param  \App\Models\Card  $card
     *
     * @return \App\Http\Resources\GymResource
     */
    public function reception(GymReceptionRequest $request, Gym $gym, Card $card): GymResource
    {
        $gym->sportObjectLog()->create([
            'card_id' => $card->id
        ]);

        return new GymResource($gym);
    }
}
