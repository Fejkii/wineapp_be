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
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineFactory factory(...$parameters)
 * @method static Builder|Wine newModelQuery()
 * @method static Builder|Wine newQuery()
 * @method static Builder|Wine query()
 * @method static Builder|Wine whereCreatedAt($value)
 * @method static Builder|Wine whereId($value)
 * @method static Builder|Wine whereProjectId($value)
 * @method static Builder|Wine whereTitle($value)
 * @method static Builder|Wine whereUpdatedAt($value)
 * @method static Builder|Wine whereWineVarietyId($value)
 * @mixin Eloquent
 */
class Wine extends Model
{
    use HasFactory;

    public const ID = "id";
    public const PROJECT_ID = "project_id";
    public const WINE_VARIETY_ID = "wine_variety_id";
    public const TITLE = "title";

    protected $fillable = [
        self::PROJECT_ID,
        self::WINE_VARIETY_ID,
        self::TITLE,
    ];
}
