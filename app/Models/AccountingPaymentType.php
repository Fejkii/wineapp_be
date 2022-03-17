<?php

namespace App\Models;

use Database\Factories\AccountingPaymentTypeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingPaymentType
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @method static AccountingPaymentTypeFactory factory(...$parameters)
 * @method static Builder|AccountingPaymentType newModelQuery()
 * @method static Builder|AccountingPaymentType newQuery()
 * @method static Builder|AccountingPaymentType query()
 * @method static Builder|AccountingPaymentType whereCode($value)
 * @method static Builder|AccountingPaymentType whereId($value)
 * @method static Builder|AccountingPaymentType whereTitle($value)
 * @mixin Eloquent
 */
class AccountingPaymentType extends Model
{
    use HasFactory;

    public const ID = "id";
    public const TITLE = "title";
    public const CODE = "code";
}
