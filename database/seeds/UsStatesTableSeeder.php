<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsStatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UsState::query()->truncate();
        DB::table('us_states')->truncate();

        $us_state_data = array(
            ['title' => "Alabama", 'slug' => "alabama", 'abbrev' => "AL", 'active' => 1],
            ['title' => "Alaska", 'slug' => "alaska", 'abbrev' => "AK", 'active' => 1],
            ['title' => "Arizona", 'slug' => "arizona", 'abbrev' => "AZ", 'active' => 1],
            ['title' => "Arkansas", 'slug' => "arkansas", 'abbrev' => "AR", 'active' => 1],
            ['title' => "California", 'slug' => "california", 'abbrev' => "CA", 'active' => 1],
            ['title' => "Colorado", 'slug' => "colorado", 'abbrev' => "CO", 'active' => 1],
            ['title' => "Connecticut", 'slug' => "connecticut", 'abbrev' => "CT", 'active' => 1],
            ['title' => "Delaware", 'slug' => "delaware", 'abbrev' => "DE", 'active' => 1],
            ['title' => "District of Columbia", 'slug' => "district-of-columbia", 'abbrev' => "DC", 'active' => 1],
            ['title' => "Florida", 'slug' => "florida", 'abbrev' => "FL", 'active' => 1],
            ['title' => "Georgia", 'slug' => "georgia", 'abbrev' => "GA", 'active' => 1],
            ['title' => "Hawaii", 'slug' => "hawaii", 'abbrev' => "HI", 'active' => 1],
            ['title' => "Idaho", 'slug' => "idaho", 'abbrev' => "ID", 'active' => 1],
            ['title' => "Illinois", 'slug' => "illinois", 'abbrev' => "IL", 'active' => 1],
            ['title' => "Indiana", 'slug' => "indiana", 'abbrev' => "IN", 'active' => 1],
            ['title' => "Iowa", 'slug' => "iowa", 'abbrev' => "IA", 'active' => 1],
            ['title' => "Kansas", 'slug' => "kansas", 'abbrev' => "KS", 'active' => 1],
            ['title' => "Kentucky", 'slug' => "kentucky", 'abbrev' => "KY", 'active' => 1],
            ['title' => "Louisiana", 'slug' => "louisiana", 'abbrev' => "LA", 'active' => 1],
            ['title' => "Maine", 'slug' => "maine", 'abbrev' => "ME", 'active' => 1],
            ['title' => "Montana", 'slug' => "montana", 'abbrev' => "MT", 'active' => 1],
            ['title' => "Nebraska", 'slug' => "nebraska", 'abbrev' => "NE", 'active' => 1],
            ['title' => "Nevada", 'slug' => "nevada", 'abbrev' => "NV", 'active' => 1],
            ['title' => "New Hampshire", 'slug' => "new-hampshire", 'abbrev' => "NH", 'active' => 1],
            ['title' => "New Jersey", 'slug' => "new-jersey", 'abbrev' => "NJ", 'active' => 1],
            ['title' => "New Mexico", 'slug' => "new-mexico", 'abbrev' => "NM", 'active' => 1],
            ['title' => "New York", 'slug' => "new-york", 'abbrev' => "NY", 'active' => 1],
            ['title' => "North Carolina", 'slug' => "north-carolina", 'abbrev' => "NC", 'active' => 1],
            ['title' => "North Dakota", 'slug' => "north-dakota", 'abbrev' => "ND", 'active' => 1],
            ['title' => "Ohio", 'slug' => "ohio", 'abbrev' => "OH", 'active' => 1],
            ['title' => "Oklahoma", 'slug' => "oklahoma", 'abbrev' => "OK", 'active' => 1],
            ['title' => "Oregon", 'slug' => "oregon", 'abbrev' => "OR", 'active' => 1],
            ['title' => "Maryland", 'slug' => "maryland", 'abbrev' => "MD", 'active' => 1],
            ['title' => "Massachusetts", 'slug' => "massachusetts", 'abbrev' => "MA", 'active' => 1],
            ['title' => "Michigan", 'slug' => "michigan", 'abbrev' => "MI", 'active' => 1],
            ['title' => "Minnesota", 'slug' => "minnesota", 'abbrev' => "MN", 'active' => 1],
            ['title' => "Mississippi", 'slug' => "mississippi", 'abbrev' => "MS", 'active' => 1],
            ['title' => "Missouri", 'slug' => "missouri", 'abbrev' => "MO", 'active' => 1],
            ['title' => "Pennsylvania", 'slug' => "pennsylvania", 'abbrev' => "PA", 'active' => 1],
            ['title' => "Rhode Island", 'slug' => "rhode-island", 'abbrev' => "RI", 'active' => 1],
            ['title' => "South Carolina", 'slug' => "south-carolina", 'abbrev' => "SC", 'active' => 1],
            ['title' => "South Dakota", 'slug' => "south-dakota", 'abbrev' => "SD", 'active' => 1],
            ['title' => "Tennessee", 'slug' => "tennessee", 'abbrev' => "TN", 'active' => 1],
            ['title' => "Texas", 'slug' => "texas", 'abbrev' => "TX", 'active' => 1],
            ['title' => "Utah", 'slug' => "utah", 'abbrev' => "UT", 'active' => 1],
            ['title' => "Vermont", 'slug' => "vermont", 'abbrev' => "VT", 'active' => 1],
            ['title' => "Virginia", 'slug' => "virginia", 'abbrev' => "VA", 'active' => 1],
            ['title' => "Washington", 'slug' => "washington", 'abbrev' => "WA", 'active' => 1],
            ['title' => "West Virginia", 'slug' => "west-virginia", 'abbrev' => "WV", 'active' => 1],
            ['title' => "Wisconsin", 'slug' => "wisconsin", 'abbrev' => "WI", 'active' => 1],
            ['title' => "Wyoming", 'slug' => "wyoming", 'abbrev' => "WY", 'active' => 1],
            ['title' => "State of Nathan", 'slug' => "state-of-nathan", 'abbrev' => "SN", 'active' => 0]
        );

        DB::table('us_states')->insert($us_state_data);
    }
}