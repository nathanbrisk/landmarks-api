<?php
namespace App\Http;

class FindHighSchoolsRequest
{
    public $term;

    public function __construct($term = null)
    {
        $this->term = $term;
    }
}
