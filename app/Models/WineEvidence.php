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
 * @property int $wine_id
 * @property string $title
 * @property float $volume
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineEvidenceFactory factory(...$parameters)
 * @method static Builder|WineEvidence newModelQuery()
 * @method static Builder|WineEvidence newQuery()
 * @method static Builder|WineEvidence query()
 * @method static Builder|WineEvidence whereCreatedAt($value)
 * @method static Builder|WineEvidence whereId($value)
 * @method static Builder|WineEvidence whereTitle($value)
 * @method static Builder|WineEvidence whereUpdatedAt($value)
 * @method static Builder|WineEvidence whereVolume($value)
 * @method static Builder|WineEvidence whereWineId($value)
 * @mixin Eloquent
 * @property int $project_id
 * @method static Builder|WineEvidence whereProjectId($value)
 */
class WineEvidence extends Model
{
    use HasFactory;

    public const PROJECT_ID = "project_id";
    public const WINE_ID = "wine_id";
    public const TITLE = "title";
    public const VOLUME = "volume"; // objem / množství

    protected $fillable = [
        self::PROJECT_ID,
        self::WINE_ID,
        self::TITLE,
        self::VOLUME,
    ];
}
