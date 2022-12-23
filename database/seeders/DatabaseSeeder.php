<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProjectSeeder::class,
            UserProjectSeeder::class,
            VatSeeder::class,
            CountrySeeder::class,
            AccountingDocumentPaymentStateSeeder::class,
            AccountingPaymentTypeSeeder::class,
            AccountingDocumentTypeSeeder::class,
            WineVarietySeeder::class,
            WineClassificationSeeder::class,
            WineSeeder::class,
            WineRecordTypeSeeder::class,
            WineEvidenceSeeder::class,
            VineyardRecordTypeSeeder::class,
        ]);
    }
}
