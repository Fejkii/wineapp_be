<?php

namespace App\Models;

use Database\Factories\VatFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Vat
 *
 * @property int $id
 * @property string $title
 * @property float $vat
 * @property int $is_default
 * @method static VatFactory factory(...$parameters)
 * @method static Builder|Vat newModelQuery()
 * @method static Builder|Vat newQuery()
 * @method static Builder|Vat query()
 * @method static Builder|Vat whereId($value)
 * @method static Builder|Vat whereIsDefault($value)
 * @method static Builder|Vat whereTitle($value)
 * @method static Builder|Vat whereVat($value)
 * @mixin Eloquent
 */
class Vat extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const VAT = "vat";
    public const IS_DEFAULT = "is_default";
}
