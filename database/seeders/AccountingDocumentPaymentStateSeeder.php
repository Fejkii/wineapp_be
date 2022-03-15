<?php

namespace Database\Seeders;

use App\Models\AccountingDocumentPaymentState;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingDocumentPaymentStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounting_document_payment_states')->insert(array(
            array(
                AccountingDocumentPaymentState::TITLE => "Unpaid",
                AccountingDocumentPaymentState::COLOR => "999999",
                AccountingDocumentPaymentState::IS_INITIAL => true,
            ),
            array(
                AccountingDocumentPaymentState::TITLE => "Paid",
                AccountingDocumentPaymentState::COLOR => "00A520",
                AccountingDocumentPaymentState::IS_INITIAL => false,
            ),
            array(
                AccountingDocumentPaymentState::TITLE => "Bad payment",
                AccountingDocumentPaymentState::COLOR => "FF0000",
                AccountingDocumentPaymentState::IS_INITIAL => false,
            ),
            array(
                AccountingDocumentPaymentState::TITLE => "Cancel",
                AccountingDocumentPaymentState::COLOR => "000000",
                AccountingDocumentPaymentState::IS_INITIAL => false,
            ),
        ));
    }
}
