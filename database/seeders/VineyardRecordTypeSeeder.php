<?php

namespace Database\Seeders;

use App\Models\VineyardRecordType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VineyardRecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vineyard_record_types')->insert(array(
            array(
                VineyardRecordType::TITLE => 'Stříkání',
            ),
            array(
                VineyardRecordType::TITLE => 'Plečkování',
            ),
            array(
                VineyardRecordType::TITLE => 'Zalamování',
            ),
            array(
                VineyardRecordType::TITLE => 'Orání',
            ),
            array(
                VineyardRecordType::TITLE => 'Sběr hroznů',
            ),
            array(
                VineyardRecordType::TITLE => 'Střihání',
            ),
            array(
                VineyardRecordType::TITLE => 'Vázání',
            ),
            array(
                VineyardRecordType::TITLE => 'Hnojení',
            ),
            array(
                VineyardRecordType::TITLE => 'Ostatní',
            ),
        ));
    }
}
