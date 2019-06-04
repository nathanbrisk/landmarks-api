<?php
namespace App\Http;

use App\HighSchoolsCollection;

class GetHighSchoolResponse
{
    public $highSchool;

    public function __construct(HighSchoolsCollection $highSchool)
    {
        $this->highSchool = $highSchool->toArray();
    }
}
