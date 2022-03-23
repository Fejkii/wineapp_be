<?php

namespace App\Models;

use Database\Factories\WineFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Wine
 *
 * @property int $id
 * @property int $project_id
 * @property int $wine_variety_id
 * @property int $wine_classification_id
 * @property string $title
 * @property string $year
 * @property float|null $alcohol
 * @property float|null $acid
 * @property float|null $sugar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineFactory factory(...$parameters)
 * @method static Builder|Wine newModelQuery()
 * @method static Builder|Wine newQuery()
 * @method static Builder|Wine query()
 * @method static Builder|Wine whereAcid($value)
 * @method static Builder|Wine whereAlcohol($value)
 * @method static Builder|Wine whereCreatedAt($value)
 * @method static Builder|Wine whereId($value)
 * @method static Builder|Wine whereSugar($value)
 * @method static Builder|Wine whereTitle($value)
 * @method static Builder|Wine whereUpdatedAt($value)
 * @method static Builder|Wine whereWineClassificationId($value)
 * @method static Builder|Wine whereWineVarietyId($value)
 * @method static Builder|Wine whereYear($value)
 * @mixin Eloquent
 * @method static Builder|Wine whereProjectId($value)
 */
class Wine extends Model
{
    use HasFactory;

    public const PROJECT_ID = "project_id";
    public const WINE_VARIETY_ID = "wine_variety_id";
    public const WINE_CLASSIFICATION_ID = "wine_classification_id";
    public const TITLE = "title";
    public const YEAR = "year";
    public const ALCOHOL = "alcohol";
    public const ACID = "acid";
    public const SUGAR = "sugar";

    protected $fillable = [
        self::PROJECT_ID,
        self::WINE_VARIETY_ID,
        self::WINE_CLASSIFICATION_ID,
        self::TITLE,
        self::YEAR,
        self::ALCOHOL,
        self::ACID,
        self::SUGAR,
    ];
}
