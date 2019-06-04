<?php
namespace App\Http;

use App\CountriesCollection;

class GetCountriesResponse
{
    public $countries;

    public function __construct(CountriesCollection $countries)
    {
        $this->countries = $countries->toArray();
    }
}
