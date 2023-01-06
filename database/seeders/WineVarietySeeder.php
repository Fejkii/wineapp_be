<?php

namespace Database\Seeders;

use App\Models\WineVariety;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineVarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_varieties')->insert(array(
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Tramín červený",
                WineVariety::CODE => "TČ",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Müller Thurgau",
                WineVariety::CODE => "MT",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Frankovka",
                WineVariety::CODE => "F",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Chardonnay",
                WineVariety::CODE => "CH",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Rulandské šedé",
                WineVariety::CODE => "RŠ",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Rulandské bílé",
                WineVariety::CODE => "RB",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Ryzlink rýnský",
                WineVariety::CODE => "RR",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Sauvignon",
                WineVariety::CODE => "S",
            ),
            array(
                WineVariety::PROJECT_ID => 1,
                WineVariety::TITLE => "Veltlínské zelené",
                WineVariety::CODE => "VZ",
            ),
        ));
    }
}
