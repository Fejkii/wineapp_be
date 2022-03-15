<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDocumentItem extends Model
{
    use HasFactory;

    public const VAT_ID = "vat_id";
    public const ACCOUNTING_DOCUMENT_ID = "accounting_document_id";
    public const TITLE = "title";
    public const COUNT = "count";
    public const PRICE = "price";
    public const PRICE_CURRENCY = "price_currency";
}
