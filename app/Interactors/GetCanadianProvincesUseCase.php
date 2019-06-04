<?php namespace App\Interactors;

use App\Repositories\CanadianProvincesRepositoryInterface;
use App\Http\GetCanadianProvincesResponse;

class GetCanadianProvincesUseCase
{
    private $canadianProvincesRepository;

    public function __construct(CanadianProvincesRepositoryInterface $canadianProvincesRepository)
    {
        $this->canadianProvincesRepository = $canadianProvincesRepository;
    }

    // Get all active instances of the model
    public function all()
    {
        $all = $this->canadianProvincesRepository->all();

        if (count($all)) {
            $response = new GetCanadianProvincesResponse($all);
        } else {
            $response = null;
        }

        return $response;
    }
}
