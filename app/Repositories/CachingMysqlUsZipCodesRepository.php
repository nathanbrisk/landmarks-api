<?php namespace App\Repositories;

use Illuminate\Support\Facades\Cache;
use App\UsZipCode;

class CachingMysqlUsZipCodesRepository implements UsZipCodesRepositoryInterface
{
    // Get all instances of model
    public function all()
    {
        // Return cached copy if available
        if (Cache::has('us_zip_codes_all')) {
            return Cache::get('us_zip_codes_all');
        }

        // Otherwise pull fresh data and cache it
        $all = UsZipCode::select('zip_code', 'city', 'state', 'order')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->orderBy('zip_code', 'asc')
            ->get();

        // Only cache real results
        if (count($all)) {
            $seconds = 43200;
            Cache::put('us_zip_codes_all', $all, $seconds);
        }

        return $all;
    }

    // show the record with the given zip code
    public function show($zip_code)
    {
        // Return cached copy if available
        if (Cache::has('us_zip_code_'.$zip_code)) {
            return Cache::get('us_zip_code_'.$zip_code);
        }

        // Otherwise pull fresh data and cache it
        $one = UsZipCode::select('zip_code', 'city', 'state', 'order')
            ->where('active', 1)
            ->where('zip_code', $zip_code)
            ->get();

        // Only cache real results
        if (count($one)) {
            $seconds = 43200;
            Cache::put('us_zip_code_'.$zip_code, $one, $seconds);
        }

        return $one;
    }
}
