<?php
namespace App\Http;

class GetCanadianProvinceRequest
{
    public $slug;

    public function __construct($slug = null)
    {
        $this->slug = $slug;
    }
}
