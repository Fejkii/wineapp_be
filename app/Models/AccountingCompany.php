<?php

namespace App\Models;

use Database\Factories\AccountingCompanyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AccountingCompany
 *
 * @property int $id
 * @property int $project_id
 * @property int $country_id
 * @property string $title
 * @property string|null $cin
 * @property string|null $vat
 * @property string|null $iban
 * @property string|null $bank_account_prefix
 * @property string|null $bank_account
 * @property string|null $bank_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static AccountingCompanyFactory factory(...$parameters)
 * @method static Builder|AccountingCompany newModelQuery()
 * @method static Builder|AccountingCompany newQuery()
 * @method static Builder|AccountingCompany query()
 * @method static Builder|AccountingCompany whereBankAccount($value)
 * @method static Builder|AccountingCompany whereBankAccountPrefix($value)
 * @method static Builder|AccountingCompany whereBankCode($value)
 * @method static Builder|AccountingCompany whereCin($value)
 * @method static Builder|AccountingCompany whereCountryId($value)
 * @method static Builder|AccountingCompany whereCreatedAt($value)
 * @method static Builder|AccountingCompany whereIban($value)
 * @method static Builder|AccountingCompany whereId($value)
 * @method static Builder|AccountingCompany whereTitle($value)
 * @method static Builder|AccountingCompany whereUpdatedAt($value)
 * @method static Builder|AccountingCompany whereVat($value)
 * @mixin Eloquent
 * @method static Builder|AccountingCompany whereProjectId($value)
 */
class AccountingCompany extends Model
{
    use HasFactory;

    public const PROJECT_ID = "project_id";
    public const COUNTRY_ID = "country_id";
    public const TITLE = "title";
    public const CIN = "cin";
    public const VAT = "vat";
    public const IBAN = "iban";
    public const BANK_ACCOUNT_PREFIX = "bank_account_prefix";
    public const BANK_ACCOUNT = "bank_account";
    public const BANK_CODE = "bank_code";

    protected $fillable = [
        self::PROJECT_ID,
        self::COUNTRY_ID,
        self::TITLE,
        self::CIN,
        self::VAT,
        self::IBAN,
        self::BANK_ACCOUNT_PREFIX,
        self::BANK_ACCOUNT,
        self::BANK_CODE,
    ];
}
