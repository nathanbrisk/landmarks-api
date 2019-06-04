<?php
namespace App\Http;

use App\CanadianProvincesCollection;

class GetCanadianProvinceResponse
{
    public $canadianProvince;

    public function __construct(CanadianProvincesCollection $canadianProvince)
    {
        $this->canadianProvince = $canadianProvince->toArray();
    }
}
