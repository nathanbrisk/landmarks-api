<?php namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\CanadianProvince;

class CachingMysqlCanadianProvincesRepository implements CanadianProvincesRepositoryInterface
{
    public function all()
    {
        // Return cached copy if available
        if (Cache::has('canadian_provinces_all')) {
            return Cache::get('canadian_provinces_all');
        }

        // TODO add exception-handling to eloquent queries

        // Otherwise pull fresh data and cache it
        $all = CanadianProvince::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->orderBy('slug', 'asc')
            ->get();

        // Only cache real results
        if (count($all)) {
            $seconds = 43200;
            Cache::put('canadian_provinces_all', $all, $seconds);
        }

        return $all;
    }

    public function show($slug)
    {
        // Return cached copy if available
        if (Cache::has('canadian_province_'.$slug)) {
            return Cache::get('canadian_province_'.$slug);
        }

        // Otherwise pull fresh data and cache it
        $one = CanadianProvince::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->where('slug', $slug)
            ->get();

        // Only cache real results
        if (count($one)) {
            $seconds = 43200;
            Cache::put('canadian_province_'.$slug, $one, $seconds);
        }

        return $one;
    }
}
