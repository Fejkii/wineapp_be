<?php

use App\Models\AccountingDocumentItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountingDocumentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounting_document_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(AccountingDocumentItem::ACCOUNTING_DOCUMENT_ID);
            $table->unsignedBigInteger(AccountingDocumentItem::VAT_ID);
            $table->string(AccountingDocumentItem::TITLE);
            $table->integer(AccountingDocumentItem::COUNT);
            $table->float(AccountingDocumentItem::PRICE);
            $table->string(AccountingDocumentItem::PRICE_CURRENCY);
            $table->timestamps();

            $table->foreign(AccountingDocumentItem::ACCOUNTING_DOCUMENT_ID)->references('id')->on('accounting_documents');
            $table->foreign(AccountingDocumentItem::VAT_ID)->references('id')->on('vats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounting_document_items');
    }
}
