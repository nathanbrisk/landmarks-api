<?php

namespace App\Repositories;

interface CanadianProvincesRepositoryInterface
{
    /**
     * Returns all Canadian Provinces
     *
     * Returns all Canadian Provinces that are active
     *
     * @return \Illuminate\Support\Collection
     */

    public function all();

    /**
     * Returns one Canadian Province
     *
     * Returns Canadian Province by the slug
     *
     * @param string $slug
     * @return \Illuminate\Support\Collection
     */

    public function show($slug);
}
