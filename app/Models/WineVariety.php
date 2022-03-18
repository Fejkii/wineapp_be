<?php

namespace App\Models;

use Database\Factories\WineVarietyFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WineVariety
 *
 * @property int $id
 * @property string $title
 * @property string $code
 * @method static WineVarietyFactory factory(...$parameters)
 * @method static Builder|WineVariety newModelQuery()
 * @method static Builder|WineVariety newQuery()
 * @method static Builder|WineVariety query()
 * @method static Builder|WineVariety whereCode($value)
 * @method static Builder|WineVariety whereId($value)
 * @method static Builder|WineVariety whereTitle($value)
 * @mixin Eloquent
 */
class WineVariety extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const CODE = "code";
}
