<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert([
          'name' => 'India',
          'code' => 'IN',
          'created_at' => NOW()
        ]);

        DB::table('countries')->insert([
          'name' => 'United Kingdom',
          'code' => 'UK',
          'created_at' => NOW()
        ]);
    }
}
