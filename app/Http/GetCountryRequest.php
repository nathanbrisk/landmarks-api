<?php
namespace App\Http;

class GetCountryRequest
{
    public $slug;

    public function __construct($slug = null)
    {
        $this->slug = $slug;
    }
}
