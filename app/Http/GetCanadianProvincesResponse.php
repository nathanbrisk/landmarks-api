<?php
namespace App\Http;

use App\CanadianProvincesCollection;

class GetCanadianProvincesResponse
{
    public $canadianProvinces;

    public function __construct(CanadianProvincesCollection $canadianProvinces)
    {
        $this->canadianProvinces = $canadianProvinces->toArray();
    }
}
