<?php

namespace App\Models;

use Database\Factories\WineEvidenceFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WineEvidence
 *
 * @property int $id
 * @property int $project_id
 * @property int $wine_id
 * @property int $wine_classification_id
 * @property string $title
 * @property float $volume
 * @property int $year
 * @property float|null $alcohol
 * @property float|null $acid
 * @property float|null $sugar
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineEvidenceFactory factory(...$parameters)
 * @method static Builder|WineEvidence newModelQuery()
 * @method static Builder|WineEvidence newQuery()
 * @method static Builder|WineEvidence query()
 * @method static Builder|WineEvidence whereAcid($value)
 * @method static Builder|WineEvidence whereAlcohol($value)
 * @method static Builder|WineEvidence whereCreatedAt($value)
 * @method static Builder|WineEvidence whereId($value)
 * @method static Builder|WineEvidence whereProjectId($value)
 * @method static Builder|WineEvidence whereSugar($value)
 * @method static Builder|WineEvidence whereTitle($value)
 * @method static Builder|WineEvidence whereUpdatedAt($value)
 * @method static Builder|WineEvidence whereVolume($value)
 * @method static Builder|WineEvidence whereWineClassificationId($value)
 * @method static Builder|WineEvidence whereWineId($value)
 * @method static Builder|WineEvidence whereYear($value)
 * @mixin Eloquent
 */
class WineEvidence extends Model
{
    use HasFactory;

    public const ID = "id";
    public const PROJECT_ID = "project_id";
    public const WINE_ID = "wine_id";
    public const WINE_CLASSIFICATION_ID = "wine_classification_id";
    public const TITLE = "title";
    public const VOLUME = "volume"; // objem / množství
    public const YEAR = "year";
    public const ALCOHOL = "alcohol"; // procent alkoholu
    public const ACID = "acid"; // kyseliny
    public const SUGAR = "sugar"; // cukernatost

    protected $fillable = [
        self::PROJECT_ID,
        self::WINE_ID,
        self::WINE_CLASSIFICATION_ID,
        self::TITLE,
        self::VOLUME,
        self::YEAR,
        self::ALCOHOL,
        self::ACID,
        self::SUGAR,
    ];
}