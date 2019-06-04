<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CanadianProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\CanadianProvince::query()->truncate();
        DB::table('canadian_provinces')->truncate();

        $canadian_province_data = array(
            ['title' => "Alberta", 'slug' => "alberta", 'abbrev' => "AB", 'active' => 1],
            ['title' => "British Columbia", 'slug' => "british-columbia", 'abbrev' => "BC", 'active' => 1],
            ['title' => "Manitoba", 'slug' => "manitoba", 'abbrev' => "MB", 'active' => 1],
            ['title' => "New Brunswick", 'slug' => "new-brunswick", 'abbrev' => "NB", 'active' => 1],
            ['title' => "Newfoundland and Labrador", 'slug' => "newfoundland-and-labrador", 'abbrev' => "NL", 'active' => 1],
            ['title' => "Northwest Territories", 'slug' => "northwest-territories", 'abbrev' => "NT", 'active' => 1],
            ['title' => "Nova Scotia", 'slug' => "nova-scotia", 'abbrev' => "NS", 'active' => 1],
            ['title' => "Nunavut", 'slug' => "nunavut", 'abbrev' => "NU", 'active' => 1],
            ['title' => "Ontario", 'slug' => "ontario", 'abbrev' => "ON", 'active' => 1],
            ['title' => "Prince Edward Island", 'slug' => "prince-edward-island", 'abbrev' => "PE", 'active' => 1],
            ['title' => "Quebec", 'slug' => "quebec", 'abbrev' => "QC", 'active' => 1],
            ['title' => "Saskatchewan", 'slug' => "saskatchewan", 'abbrev' => "SK", 'active' => 1],
            ['title' => "Yukon", 'slug' => "yukon", 'abbrev' => "YT", 'active' => 1],
            ['title' => "Hockey Province", 'slug' => "hockey-province", 'abbrev' => "HP", 'active' => 0]
        );

        DB::table('canadian_provinces')->insert($canadian_province_data);
    }
}