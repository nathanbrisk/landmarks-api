<?php namespace App\Interactors;

use App\Repositories\UsZipCodesRepositoryInterface;
use App\Http\GetUsZipCodesResponse;

class GetUsZipCodesUseCase
{
    private $usZipCodesRepository;

    public function __construct(UsZipCodesRepositoryInterface $usZipCodesRepository)
    {
        $this->usZipCodesRepository = $usZipCodesRepository;
    }

    // Get all active instances of the model
    public function all()
    {
        $all = $this->usZipCodesRepository->all();

        if (count($all)) {
            $response = new GetUsZipCodesResponse($all);
        } else {
            $response = null;
        }

        return $response;
    }
}
