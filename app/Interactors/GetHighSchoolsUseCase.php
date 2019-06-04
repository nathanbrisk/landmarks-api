<?php namespace App\Interactors;

use App\Repositories\HighSchoolsRepositoryInterface;
use App\Http\GetHighSchoolsResponse;

class GetHighSchoolsUseCase
{
    private $highSchoolsRepository;

    public function __construct(HighSchoolsRepositoryInterface $highSchoolsRepository)
    {
        $this->highSchoolsRepository = $highSchoolsRepository;
    }

    // Get all active instances of the model
    public function all()
    {
        $all = $this->highSchoolsRepository->all();

        if (count($all)) {
            $response = new GetHighSchoolsResponse($all);
        } else {
            $response = null;
        }

        return $response;
    }
}
