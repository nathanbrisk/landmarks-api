<?php namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\HighSchool;

class CachingMysqlHighSchoolsRepository implements HighSchoolsRepositoryInterface
{
    public function all()
    {
        // Return cached copy if available
        if (Cache::has('high_schools_all')) {
            return Cache::get('high_schools_all');
        }

        // Otherwise pull fresh data and cache it
        $all = HighSchool::select('title', 'city', 'state', 'slug', 'order')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->orderBy('slug', 'asc')
            ->get();

        // Only cache real results
        if (count($all)) {
            $seconds = 43200;
            Cache::put('high_schools_all', $all, $seconds);
        }

        return $all;
    }

    public function find($term)
    {
        if (strlen($term) >= 3) {
            // Return cached copy if available
            if (Cache::has('high_schools_find_'.$term)) {
                return Cache::get('high_schools_find_'.$term);
            }

            // Otherwise pull fresh data and cache it
            $results = HighSchool::select('title', 'city', 'state', 'slug', 'order')
                ->where('active', 1)
                ->where('title', 'like', "%$term%")
                ->orderBy('title', 'asc')
                ->get();

            // cache even blank results
            $seconds = 43200;
            Cache::put('high_schools_find_'.$term, $results, $seconds);
        } else {
            return $this->all();
        }

        return $results;
    }

    public function show($slug)
    {
        // Return cached copy if available
        if (Cache::has('high_school_'.$slug)) {
            return Cache::get('high_school_'.$slug);
        }

        // Otherwise pull fresh data and cache it
        $one = HighSchool::select('title', 'city', 'state', 'slug', 'order')
            ->where('active', 1)
            ->where('slug', $slug)
            ->get();

        // Only cache real results
        if (count($one)) {
            $seconds = 43200;
            Cache::put('high_school_'.$slug, $one, $seconds);
        }

        return $one;
    }
}
