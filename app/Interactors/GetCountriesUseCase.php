<?php namespace App\Interactors;

use App\Repositories\CountriesRepositoryInterface;
use App\Http\GetCountriesResponse;

class GetCountriesUseCase
{
    private $countriesRepository;

    public function __construct(CountriesRepositoryInterface $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    // Get all active instances of the model
    public function all()
    {
        $all = $this->countriesRepository->all();

        if (count($all)) {
            $response = new GetCountriesResponse($all);
        } else {
            $response = null;
        }

        return $response;
    }
}
