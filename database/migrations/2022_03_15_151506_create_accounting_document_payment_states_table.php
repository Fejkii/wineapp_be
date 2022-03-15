<?php

use App\Models\AccountingDocumentPaymentState;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingDocumentPaymentStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_document_payment_states', function (Blueprint $table) {
            $table->id();
            $table->string(AccountingDocumentPaymentState::TITLE);
            $table->string(AccountingDocumentPaymentState::COLOR);
            $table->string(AccountingDocumentPaymentState::IS_INITIAL);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_document_payment_states');
    }
}
