<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->insert(array(
            array(
                Country::TITLE => 'Czech Republic',
                Country::CODE => 'CZE',
            ),
            array(
                Country::TITLE => 'Slovakia',
                Country::CODE => 'SVK',
            ),
        ));
    }
}
