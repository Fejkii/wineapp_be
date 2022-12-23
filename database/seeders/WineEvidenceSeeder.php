<?php

namespace Database\Seeders;

use App\Models\WineEvidence;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineEvidenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_evidences')->insert(array(
            array(
                WineEvidence::PROJECT_ID => 1,
                WineEvidence::WINE_ID => 1,
                WineEvidence::WINE_CLASSIFICATION_ID => 3,
                WineEvidence::TITLE => "Tramín 2022",
                WineEvidence::VOLUME => 100,
                WineEvidence::YEAR => 2022,
                WineEvidence::ALCOHOL => 11,
                WineEvidence::ACID => 1.5,
                WineEvidence::SUGAR => 2.5,
                Model::CREATED_AT => now(),
            ),
            array(
                WineEvidence::PROJECT_ID => 1,
                WineEvidence::WINE_ID => 3,
                WineEvidence::WINE_CLASSIFICATION_ID => 3,
                WineEvidence::TITLE => "Frankovka 2020",
                WineEvidence::VOLUME => 150,
                WineEvidence::YEAR => 2020,
                WineEvidence::ALCOHOL => 12,
                WineEvidence::ACID => 3.5,
                WineEvidence::SUGAR => 1.5,
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
