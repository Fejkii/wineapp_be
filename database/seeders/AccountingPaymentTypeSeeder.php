<?php

namespace Database\Seeders;

use App\Models\AccountingPaymentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingPaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounting_payment_types')->insert(array(
            array(
                AccountingPaymentType::TITLE => "Cash",
                AccountingPaymentType::CODE => "CSH",
            ),
            array(
                AccountingPaymentType::TITLE => "Bank account",
                AccountingPaymentType::CODE => "BA",
            ),
            array(
                AccountingPaymentType::TITLE => "Payment card",
                AccountingPaymentType::CODE => "CARD",
            ),
        ));
    }
}
