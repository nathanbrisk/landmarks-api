<?php
namespace App\Http;

class GetHighSchoolRequest
{
    public $slug;

    public function __construct($slug = null)
    {
        $this->slug = $slug;
    }
}
