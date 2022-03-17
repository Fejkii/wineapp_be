<?php

namespace App\Models;

use Database\Factories\AccountingDocumentFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AccountingDocument
 *
 * @property int $id
 * @property int $company_id
 * @property int $payment_type_id
 * @property int $user_id
 * @property int $document_payment_state_id
 * @property int $document_type_id
 * @property string|null $document_number
 * @property string|null $variable_symbol
 * @property string|null $supply_date
 * @property string|null $due_date
 * @property float|null $exchange_to_czk
 * @property string|null $paid_date
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static AccountingDocumentFactory factory(...$parameters)
 * @method static Builder|AccountingDocument newModelQuery()
 * @method static Builder|AccountingDocument newQuery()
 * @method static Builder|AccountingDocument query()
 * @method static Builder|AccountingDocument whereCompanyId($value)
 * @method static Builder|AccountingDocument whereCreatedAt($value)
 * @method static Builder|AccountingDocument whereDocumentNumber($value)
 * @method static Builder|AccountingDocument whereDocumentPaymentStateId($value)
 * @method static Builder|AccountingDocument whereDocumentTypeId($value)
 * @method static Builder|AccountingDocument whereDueDate($value)
 * @method static Builder|AccountingDocument whereExchangeToCzk($value)
 * @method static Builder|AccountingDocument whereId($value)
 * @method static Builder|AccountingDocument wherePaidDate($value)
 * @method static Builder|AccountingDocument wherePaymentTypeId($value)
 * @method static Builder|AccountingDocument whereSupplyDate($value)
 * @method static Builder|AccountingDocument whereUpdatedAt($value)
 * @method static Builder|AccountingDocument whereUserId($value)
 * @method static Builder|AccountingDocument whereVariableSymbol($value)
 * @mixin Eloquent
 */
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
    public const DOCUMENT_TYPE_ID = "document_type_id";

    protected $fillable = [
        self::COMPANY_ID,
        self::PAYMENT_TYPE_ID,
        self::USER_ID,
        self::DOCUMENT_TYPE_ID,
        self::DOCUMENT_NUMBER,
        self::VARIABLE_SYMBOL,
        self::SUPPLY_DATE,
        self::DUE_DATE,
        self::EXCHANGE_TO_CZK,
        self::PAID_DATE,
    ];
}
