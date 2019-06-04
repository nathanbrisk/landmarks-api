<?php namespace App\Interactors;

use App\Repositories\HighSchoolsRepositoryInterface;
use App\Http\FindHighSchoolsRequest;
use App\Http\FindHighSchoolsResponse;

class FindHighSchoolsUseCase
{
    private $highSchoolsRepository;

    public function __construct(HighSchoolsRepositoryInterface $highSchoolsRepository)
    {
        $this->highSchoolsRepository = $highSchoolsRepository;
    }

    // Get all active instances of the model
    public function find(FindHighSchoolsRequest $request)
    {
        $term = $request->term;
        $results = $this->highSchoolsRepository->find($term);

        if (count($results)) {
            $response = new FindHighSchoolsResponse($results);
        } else {
            $response = null;
        }

        return $response;
    }
}
