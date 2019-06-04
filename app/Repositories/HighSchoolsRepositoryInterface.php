<?php

namespace App\Repositories;

interface HighSchoolsRepositoryInterface
{
    /**
     * Returns all high schools
     *
     * @return \Illuminate\Support\Collection
     */

    public function all();

    /**
     * Returns high schools that contain term
     *
     * Ignores terms less than 3 characters
     *
     * @param string $term
     * @return \Illuminate\Support\Collection
     */

    public function find($term);

    /**
     * Returns one high school by the slug
     *
     * @param string $slug
     * @return \Illuminate\Support\Collection
     */

    public function show($slug);
}
