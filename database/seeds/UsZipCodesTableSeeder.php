<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsZipCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\UsZipCode::query()->truncate();
        DB::table('us_zip_codes')->truncate();

        // Read data from CSV
        $file_path = base_path().'/database/seeds/csvs/us_zip_codes.csv';
        if (($handle = fopen($file_path, "r")) !== FALSE) {
            $keys = fgetcsv($handle, 1000, ",");
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                DB::insert('insert into us_zip_codes (zip_code, city, state, active) values (?, ?, ?, ?)',
                    [$data[0], $data[1], $data[2], $data[3]]
                );
            }
            fclose($handle);
        }
    }
}