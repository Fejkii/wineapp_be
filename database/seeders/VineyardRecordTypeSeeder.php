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
                VineyardRecordType::TITLE => 'Orání',
            ),
            array(
                VineyardRecordType::TITLE => 'Plečkování',
            ),
            array(
                VineyardRecordType::TITLE => 'Přiorání',
            ),
            array(
                VineyardRecordType::TITLE => 'Odorání',
            ),
            array(
                VineyardRecordType::TITLE => 'Zalamování',
            ),
            array(
                VineyardRecordType::TITLE => 'Stříkání',
            ),
            array(
                VineyardRecordType::TITLE => 'Sběr hroznů',
            ),
        ));
    }
}
