<?php

namespace Database\Seeders;

use App\Models\Vat;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vats')->insert(array(
            array(
                Vat::TITLE => '21 %',
                Vat::VAT => 21,
                Vat::IS_DEFAULT => true,
            ),
            array(
                Vat::TITLE => '20 %',
                Vat::VAT => 20,
                Vat::IS_DEFAULT => true,
            ),
        ));
    }
}
