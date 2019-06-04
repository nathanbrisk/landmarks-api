<?php namespace App\Interactors;

use App\Repositories\CanadianProvincesRepositoryInterface;
use App\Http\GetCanadianProvinceRequest;
use App\Http\GetCanadianProvinceResponse;

class GetCanadianProvinceUseCase
{
    private $canadianProvincesRepository;

    public function __construct(CanadianProvincesRepositoryInterface $canadianProvincesRepository)
    {
        $this->canadianProvincesRepository = $canadianProvincesRepository;
    }

    // show the record with the given slug
    public function show(GetCanadianProvinceRequest $request)
    {
        $slug = $request->slug;
        $one = $this->canadianProvincesRepository->show($slug);

        if (count($one)) {
            $response = new GetCanadianProvinceResponse($one);
        } else {
            $response = null;
        }

        return $response;
    }
}
