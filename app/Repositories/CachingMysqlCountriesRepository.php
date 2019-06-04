<?php namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\Country;

class CachingMysqlCountriesRepository implements CountriesRepositoryInterface
{
    public function all()
    {
        // Return cached copy if available
        if (Cache::has('countries_all')) {
            return Cache::get('countries_all');
        }

        // Otherwise pull fresh data and cache it
        $all = Country::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->orderBy('slug', 'asc')
            ->get();

        // Only cache real results
        if (count($all)) {
            $seconds = 43200;
            Cache::put('countries_all', $all, $seconds);
        }

        return $all;
    }

    public function show($slug)
    {
        // Return cached copy if available
        if (Cache::has('countries_'.$slug)) {
            return Cache::get('countries_'.$slug);
        }

        // Otherwise pull fresh data and cache it
        $one = Country::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->where('slug', $slug)
            ->get();

        // Only cache real results
        if (count($one)) {
            $seconds = 43200;
            Cache::put('countries_'.$slug, $one, $seconds);
        }

        return $one;
    }
}
