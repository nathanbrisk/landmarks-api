<?php
namespace App\Http;

class GetUsStateRequest
{
    public $slug;

    public function __construct($slug = null)
    {
        $this->slug = $slug;
    }
}
