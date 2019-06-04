<?php

namespace App\Repositories;

interface CountriesRepositoryInterface
{
    /**
     * Returns all active Countries
     *
     * @return \Illuminate\Support\Collection
     */

    public function all();

    /**
     * Returns one Country by the slug
     *
     * @param string $slug
     * @return \Illuminate\Support\Collection
     */

    public function show($slug);
}
