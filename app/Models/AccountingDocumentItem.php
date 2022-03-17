<?php

namespace App\Models;

use Database\Factories\AccountingDocumentItemFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\AccountingDocumentItem
 *
 * @property int $id
 * @property int $accounting_document_id
 * @property int $vat_id
 * @property string $title
 * @property int $count
 * @property float $price
 * @property string $price_currency
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static AccountingDocumentItemFactory factory(...$parameters)
 * @method static Builder|AccountingDocumentItem newModelQuery()
 * @method static Builder|AccountingDocumentItem newQuery()
 * @method static Builder|AccountingDocumentItem query()
 * @method static Builder|AccountingDocumentItem whereAccountingDocumentId($value)
 * @method static Builder|AccountingDocumentItem whereCount($value)
 * @method static Builder|AccountingDocumentItem whereCreatedAt($value)
 * @method static Builder|AccountingDocumentItem whereId($value)
 * @method static Builder|AccountingDocumentItem wherePrice($value)
 * @method static Builder|AccountingDocumentItem wherePriceCurrency($value)
 * @method static Builder|AccountingDocumentItem whereTitle($value)
 * @method static Builder|AccountingDocumentItem whereUpdatedAt($value)
 * @method static Builder|AccountingDocumentItem whereVatId($value)
 * @mixin Eloquent
 */
class AccountingDocumentItem extends Model
{
    use HasFactory;

    public const VAT_ID = "vat_id";
    public const ACCOUNTING_DOCUMENT_ID = "accounting_document_id";
    public const TITLE = "title";
    public const COUNT = "count";
    public const PRICE = "price";
    public const PRICE_CURRENCY = "price_currency";

    protected $fillable = [
        self::VAT_ID,
        self::ACCOUNTING_DOCUMENT_ID,
        self::TITLE,
        self::COUNT,
        self::PRICE,
        self::PRICE_CURRENCY,
    ];
}
