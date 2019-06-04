<?php namespace App\Interactors;

use App\Repositories\CountriesRepositoryInterface;
use App\Http\GetCountryRequest;
use App\Http\GetCountryResponse;

class GetCountryUseCase
{
    private $countriesRepository;

    public function __construct(CountriesRepositoryInterface $countriesRepository)
    {
        $this->countriesRepository = $countriesRepository;
    }

    // show the record with the given slug
    public function show(GetCountryRequest $request)
    {
        $slug = $request->slug;
        $one = $this->countriesRepository->show($slug);

        if (count($one)) {
            $response = new GetCountryResponse($one);
        } else {
            $response = null;
        }

        return $response;
    }
}
