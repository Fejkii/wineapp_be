<?php

namespace Database\Seeders;

use App\Models\WineClassification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_classifications')->insert(array(
            array(
                WineClassification::TITLE => "Stolní víno",
                WineClassification::CODE => "ST",
                WineClassification::PARAMS => "",
            ),
            array(
                WineClassification::TITLE => "Zemské víno",
                WineClassification::CODE => "ZV",
                WineClassification::PARAMS => "",
            ),
            array(
                WineClassification::TITLE => "Suchá",
                WineClassification::CODE => "SU",
                WineClassification::PARAMS => "max. 4 g zbytkového cukru na litr. max. 9 g cukru v litru, pokud rozdíl zbytkového cukru a celkového obsahu kyselin přepočtený na kyselinu vinnou je 2 gramy nebo méně.",
            ),
            array(
                WineClassification::TITLE => "Polosuchá",
                WineClassification::CODE => "PSU",
                WineClassification::PARAMS => "max. 12 g zbytkového cukru na litr. max. 18 g cukru v litru, pokud rozdíl zbytkového cukru a celkového obsahu kyselin přepočtený na kyselinu vinnou je 10 gramů nebo méně.",
            ),
            array(
                WineClassification::TITLE => "Polosladká",
                WineClassification::CODE => "PSL",
                WineClassification::PARAMS => "Obsah zbytkového cukru ve víně je větší než nejvyšší hodnota stanovená pro vína polosuchá, ale dosahuje nejvýše 45 g na 1 litr.",
            ),
            array(
                WineClassification::TITLE => "Sladká",
                WineClassification::CODE => "SL",
                WineClassification::PARAMS => "Dle legislativních předpisů se jedná o víno se zbytkovým cukrem ve výši nejméně 45 g na litr.",
            ),
        ));
    }
}
