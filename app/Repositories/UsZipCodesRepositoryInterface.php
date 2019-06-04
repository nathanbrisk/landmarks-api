<?php

namespace App\Repositories;

interface UsZipCodesRepositoryInterface
{
    /**
     * Returns all US Zip Codes
     *
     * @return \Illuminate\Support\Collection
     */

    public function all();

    /**
     * Returns information for one US Zip Code
     *
     * @param string $zip_code
     * @return \Illuminate\Support\Collection
     */

    public function show($zip_code);
}
