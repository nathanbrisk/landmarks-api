<?php
namespace App\Http;

use App\UsZipCodesCollection;

class GetUsZipCodeResponse
{
    public $usZipCode;

    public function __construct(UsZipCodesCollection $usZipCode)
    {
        $this->usZipCode = $usZipCode->toArray();
    }
}
