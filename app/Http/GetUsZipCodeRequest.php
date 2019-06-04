<?php
namespace App\Http;

class GetUsZipCodeRequest
{
    public $zip_code;

    public function __construct($zip_code = null)
    {
        $this->zip_code = $zip_code;
    }
}
