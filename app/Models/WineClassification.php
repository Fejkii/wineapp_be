<?php

namespace App\Models;

use Database\Factories\WineClassificationFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WineClassification
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @property string|null $params
 * @method static WineClassificationFactory factory(...$parameters)
 * @method static Builder|WineClassification newModelQuery()
 * @method static Builder|WineClassification newQuery()
 * @method static Builder|WineClassification query()
 * @method static Builder|WineClassification whereCode($value)
 * @method static Builder|WineClassification whereId($value)
 * @method static Builder|WineClassification whereParams($value)
 * @method static Builder|WineClassification whereTitle($value)
 * @mixin Eloquent
 */
class WineClassification extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const CODE = "code";
    public const PARAMS = "params";
}
