<?php
namespace App\Http;

use App\UsZipCodesCollection;

class GetUsZipCodesResponse
{
    public $usZipCodes;

    public function __construct(UsZipCodesCollection $usZipCodes)
    {
        $this->usZipCodes = $usZipCodes->toArray();
    }
}
