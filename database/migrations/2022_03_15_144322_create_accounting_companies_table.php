<?php

use App\Models\AccountingCompany;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(AccountingCompany::PROJECT_ID);
            $table->unsignedBigInteger(AccountingCompany::COUNTRY_ID);
            $table->string(AccountingCompany::TITLE)->unique();
            $table->string(AccountingCompany::CIN)->nullable();
            $table->string(AccountingCompany::VAT)->nullable();
            $table->string(AccountingCompany::IBAN)->nullable();
            $table->string(AccountingCompany::BANK_ACCOUNT_PREFIX)->nullable();
            $table->string(AccountingCompany::BANK_ACCOUNT)->nullable();
            $table->string(AccountingCompany::BANK_CODE)->nullable();
            $table->timestamps();

            $table->foreign(AccountingCompany::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(AccountingCompany::COUNTRY_ID)->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_companies');
    }
}
