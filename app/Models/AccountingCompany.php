<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingCompany extends Model
{
    use HasFactory;

    public const COUNTRY_ID = "country_id";
    public const TITLE = "title";
    public const CIN = "cin";
    public const VAT = "vat";
    public const IBAN = "iban";
    public const BANK_ACCOUNT_PREFIX = "bank_account_prefix";
    public const BANK_ACCOUNT = "bank_account";
    public const BANK_CODE = "bank_code";
}
