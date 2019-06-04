<?php
namespace App\Http;

use App\HighSchoolsCollection;

class GetHighSchoolsResponse
{
    public $highSchools;

    public function __construct(HighSchoolsCollection $highSchools)
    {
        $this->highSchools = $highSchools->toArray();
    }
}
