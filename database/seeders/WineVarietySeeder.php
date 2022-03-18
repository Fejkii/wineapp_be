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
                WineVariety::TITLE => "Tramín červený",
                WineVariety::CODE => "TČ",
            ),
            array(
                WineVariety::TITLE => "Müller Thurgau",
                WineVariety::CODE => "MT",
            ),
            array(
                WineVariety::TITLE => "Frankovka",
                WineVariety::CODE => "F",
            ),
            array(
                WineVariety::TITLE => "Chardonnay",
                WineVariety::CODE => "CH",
            ),
            array(
                WineVariety::TITLE => "Rulandské šedé",
                WineVariety::CODE => "RŠ",
            ),
            array(
                WineVariety::TITLE => "Rulandské bílé",
                WineVariety::CODE => "RB",
            ),
            array(
                WineVariety::TITLE => "Ryzlink rýnský",
                WineVariety::CODE => "RR",
            ),
            array(
                WineVariety::TITLE => "Sauvignon",
                WineVariety::CODE => "S",
            ),
            array(
                WineVariety::TITLE => "Veltlínské zelené",
                WineVariety::CODE => "VZ",
            ),
        ));
    }
}
