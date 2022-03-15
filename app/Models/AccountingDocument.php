<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingDocument extends Model
{
    use HasFactory;

    public const COMPANY_ID = "company_id";
    public const PAYMENT_TYPE_ID = "payment_type_id";
    public const USER_ID = "user_id";
    public const DOCUMENT_PAYMENT_STATE_ID = "document_payment_state_id";
    public const DOCUMENT_NUMBER = "document_number";
    public const VARIABLE_SYMBOL = "variable_symbol";
    public const SUPPLY_DATE = "supply_date";
    public const DUE_DATE = "due_date";
    public const EXCHANGE_TO_CZK = "exchange_to_czk";
    public const PAID_DATE = "paid_date";
    public const DOCUMENT_TYPE = "document_type";
}
