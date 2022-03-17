<?php

namespace App\Models;

use Database\Factories\AccountingDocumentPaymentStateFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AccountingDocumentPaymentState
 *
 * @property int $id
 * @property string $title
 * @property string $color
 * @property string $is_initial
 * @method static AccountingDocumentPaymentStateFactory factory(...$parameters)
 * @method static Builder|AccountingDocumentPaymentState newModelQuery()
 * @method static Builder|AccountingDocumentPaymentState newQuery()
 * @method static Builder|AccountingDocumentPaymentState query()
 * @method static Builder|AccountingDocumentPaymentState whereColor($value)
 * @method static Builder|AccountingDocumentPaymentState whereId($value)
 * @method static Builder|AccountingDocumentPaymentState whereIsInitial($value)
 * @method static Builder|AccountingDocumentPaymentState whereTitle($value)
 * @mixin Eloquent
 */
class AccountingDocumentPaymentState extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const COLOR = "color";
    public const IS_INITIAL = "is_initial";
}
