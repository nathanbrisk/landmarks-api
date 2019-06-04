<?php namespace App\Interactors;

use App\Repositories\UsStatesRepositoryInterface;
use App\Http\GetUsStateRequest;
use App\Http\GetUsStateResponse;

class GetUsStateUseCase
{
    private $usStatesRepository;

    public function __construct(UsStatesRepositoryInterface $usStatesRepository)
    {
        $this->usStatesRepository = $usStatesRepository;
    }

    // show the record with the given slug
    public function show(GetUsStateRequest $request)
    {
        $slug = $request->slug;
        $one = $this->usStatesRepository->show($slug);

        if (count($one)) {
            $response = new GetUsStateResponse($one);
        } else {
            $response = null;
        }

        return $response;
    }
}
