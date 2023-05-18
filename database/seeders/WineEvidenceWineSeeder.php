<?php

namespace Database\Seeders;

use App\Models\WineEvidenceWine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineEvidenceWineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_evidence_wines')->insert(array(
            array(
                WineEvidenceWine::WINE_EVIDENCE_ID => 1,
                WineEvidenceWine::WINE_ID => 1,
                Model::CREATED_AT => now(),
            ),
            array(
                WineEvidenceWine::WINE_EVIDENCE_ID => 1,
                WineEvidenceWine::WINE_ID => 2,
                Model::CREATED_AT => now(),
            ),
            array(
                WineEvidenceWine::WINE_EVIDENCE_ID => 2,
                WineEvidenceWine::WINE_ID => 1,
                Model::CREATED_AT => now(),
            ),
            array(
                WineEvidenceWine::WINE_EVIDENCE_ID => 2,
                WineEvidenceWine::WINE_ID => 3,
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
