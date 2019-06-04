<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CanadianProvincesTableSeeder');
        $this->call('CountriesTableSeeder');
        $this->call('HighSchoolsTableSeeder');
        $this->call('UsStatesTableSeeder');
        $this->call('UsZipCodesTableSeeder');
    }
}
