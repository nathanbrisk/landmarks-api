<?php
namespace App\Http;

use App\UsStatesCollection;

class GetUsStateResponse
{
    public $usState;

    public function __construct(UsStatesCollection $usState)
    {
        $this->usState = $usState->toArray();
    }
}
