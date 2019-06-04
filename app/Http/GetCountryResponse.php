<?php
namespace App\Http;

use App\CountriesCollection;

class GetCountryResponse
{
    public $country;

    public function __construct(CountriesCollection $country)
    {
        $this->country = $country->toArray();
    }
}
