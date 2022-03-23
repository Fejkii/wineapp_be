<?php

use App\Models\AccountingDocument;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(AccountingDocument::PROJECT_ID);
            $table->unsignedBigInteger(AccountingDocument::COMPANY_ID);
            $table->unsignedBigInteger(AccountingDocument::PAYMENT_TYPE_ID);
            $table->unsignedBigInteger(AccountingDocument::USER_ID);
            $table->unsignedBigInteger(AccountingDocument::DOCUMENT_PAYMENT_STATE_ID)->default(1);
            $table->unsignedBigInteger(AccountingDocument::DOCUMENT_TYPE_ID);
            $table->string(AccountingDocument::DOCUMENT_NUMBER)->nullable();
            $table->string(AccountingDocument::VARIABLE_SYMBOL)->nullable();
            $table->date(AccountingDocument::SUPPLY_DATE)->nullable();
            $table->date(AccountingDocument::DUE_DATE)->nullable();
            $table->double(AccountingDocument::EXCHANGE_TO_CZK)->nullable();
            $table->date(AccountingDocument::PAID_DATE)->nullable();
            $table->timestamps();

            $table->foreign(AccountingDocument::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(AccountingDocument::COMPANY_ID)->references('id')->on('accounting_companies');
            $table->foreign(AccountingDocument::PAYMENT_TYPE_ID)->references('id')->on('accounting_payment_types');
            $table->foreign(AccountingDocument::USER_ID)->references('id')->on('users');
            $table->foreign(AccountingDocument::DOCUMENT_PAYMENT_STATE_ID)->references('id')->on('accounting_document_payment_states');
            $table->foreign(AccountingDocument::DOCUMENT_TYPE_ID)->references('id')->on('accounting_document_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_documents');
    }
}
