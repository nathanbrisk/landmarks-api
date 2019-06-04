<?php

namespace App\Repositories;

interface UsStatesRepositoryInterface
{
    /**
     * Returns all US States
     *
      * @return \Illuminate\Support\Collection
     */

    public function all();

    /**
     * Returns one US state by the slug
     *
     * @param string $slug
     * @return \Illuminate\Support\Collection
     */

    public function show($slug);
}
