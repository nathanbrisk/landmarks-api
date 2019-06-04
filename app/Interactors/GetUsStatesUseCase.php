<?php namespace App\Interactors;

use App\Repositories\UsStatesRepositoryInterface;
use App\Http\GetUsStatesResponse;

class GetUsStatesUseCase
{
    private $usStatesRepository;

    public function __construct(UsStatesRepositoryInterface $usStatesRepository)
    {
        $this->usStatesRepository = $usStatesRepository;
    }

    // Get all active instances of the model
    public function all()
    {
        $all = $this->usStatesRepository->all();

        if (count($all)) {
            $response = new GetUsStatesResponse($all);
        } else {
            $response = null;
        }

        return $response;
    }
}
