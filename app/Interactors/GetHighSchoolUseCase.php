<?php namespace App\Interactors;

use App\Repositories\HighSchoolsRepositoryInterface;
use App\Http\GetHighSchoolRequest;
use App\Http\GetHighSchoolResponse;

class GetHighSchoolUseCase
{
    private $highSchoolsRepository;

    public function __construct(HighSchoolsRepositoryInterface $highSchoolsRepository)
    {
        $this->highSchoolsRepository = $highSchoolsRepository;
    }

    // show the record with the given slug
    public function show(GetHighSchoolRequest $request)
    {
        $slug = $request->slug;
        $one = $this->highSchoolsRepository->show($slug);

        if (count($one)) {
            $response = new GetHighSchoolResponse($one);
        } else {
            $response = null;
        }

        return $response;
    }
}
