<?php
namespace App\Http;

use App\UsStatesCollection;

class GetUsStatesResponse
{
    public $usStates;

    public function __construct(UsStatesCollection $usStates)
    {
        $this->usStates = $usStates->toArray();
    }
}
