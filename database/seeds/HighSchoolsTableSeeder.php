<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HighSchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\HighSchool::query()->truncate();
        DB::table('high_schools')->truncate();

        // Read data from CSV
        $file_path = base_path().'/database/seeds/csvs/high_schools.csv';
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $keys = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                DB::insert('insert into high_schools (title, city, state, slug, active) values (?, ?, ?, ?, ?)',
                    [$data[0], $data[1], $data[2], $data[3], $data[4]]
                );
            }
            fclose($handle);
        }
    }
}