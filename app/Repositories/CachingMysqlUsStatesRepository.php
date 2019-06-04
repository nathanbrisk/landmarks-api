<?php namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\UsState;

class CachingMysqlUsStatesRepository implements UsStatesRepositoryInterface
{
    public function all()
    {
        // Return cached copy if available
        if (Cache::has('us_states_all')) {
            return Cache::get('us_states_all');
        }

        // Otherwise pull fresh data and cache it
        $all = UsState::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->orderBy('slug', 'asc')
            ->get();

        // Only cache real results
        if (count($all)) {
            $seconds = 43200;
            Cache::put('us_states_all', $all, $seconds);
        }

        return $all;
    }

    public function show($slug)
    {
        // Return cached copy if available
        if (Cache::has('us_state_'.$slug)) {
            return Cache::get('us_state_'.$slug);
        }

        // Otherwise pull fresh data and cache it
        $one = UsState::select('title', 'abbrev', 'slug', 'order')
            ->where('active', 1)
            ->where('slug', $slug)
            ->get();

        // Only cache real results
        if (count($one)) {
            $seconds = 43200;
            Cache::put('us_state_'.$slug, $one, $seconds);
        }

        return $one;
    }
}
