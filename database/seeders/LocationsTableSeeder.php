<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
{
    $sql = \File::get(database_path('sqls/locations.sql'));
    \DB::unprepared($sql);
}
}
