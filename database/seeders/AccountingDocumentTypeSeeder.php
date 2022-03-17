<?php

namespace Database\Seeders;

use App\Models\AccountingDocumentType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountingDocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounting_document_types')->insert(array(
            array(
                AccountingDocumentType::TITLE => "Invoice",
                AccountingDocumentType::CODE => "INV",
            ),
            array(
                AccountingDocumentType::TITLE => "Receipt",
                AccountingDocumentType::CODE => "RCPT",
            ),
        ));
    }
}
