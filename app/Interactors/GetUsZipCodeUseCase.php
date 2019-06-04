<?php namespace App\Interactors;

use App\Repositories\UsZipCodesRepositoryInterface;
use App\Http\GetUsZipCodeRequest;
use App\Http\GetUsZipCodeResponse;

class GetUsZipCodeUseCase
{
    private $usZipCodeRepository;

    public function __construct(UsZipCodesRepositoryInterface $usZipCodeRepository)
    {
        $this->usZipCodeRepository = $usZipCodeRepository;
    }

    // show the record with the given zip code
    public function show(GetUsZipCodeRequest $request)
    {
        $zip_code = $request->zip_code;

        // Limit zip code to 5 numeric characters
        $zip_code = preg_replace("/[^0-9]/", '', $zip_code);
        if (strlen($zip_code) > 5) {
            $zip_code = substr($zip_code, 0, 5);
        }

        $one = $this->usZipCodeRepository->show($zip_code);

        if (count($one)) {
            $response = new GetUsZipCodeResponse($one);
        } else {
            $response = null;
        }

        return $response;
    }
}
