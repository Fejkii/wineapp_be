<?php

namespace App\Models;

use Database\Factories\ProjectSettingsFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ProjectSettings
 *
 * @method static ProjectSettingsFactory factory($count = null, $state = [])
 * @method static Builder|ProjectSettings newModelQuery()
 * @method static Builder|ProjectSettings newQuery()
 * @method static Builder|ProjectSettings query()
 * @property int $id
 * @property int $projectId
 * @property float $defaultFreeSulfur
 * @property float $defaultLiquidSulfur
 * @method static Builder|ProjectSettings whereDefaultFreeSulfur($value)
 * @method static Builder|ProjectSettings whereDefaultLiquidSulfur($value)
 * @method static Builder|ProjectSettings whereId($value)
 * @method static Builder|ProjectSettings whereProjectId($value)
 * @property int $project_id
 * @property float $default_free_sulfur
 * @property float $default_liquid_sulfur
 * @mixin Eloquent
 */
class ProjectSettings extends Model
{
    use HasFactory;
    use HasUuids; // TODO: negeneruje v DB UUIDčka

    public $timestamps = false;

    public const ID = "id";
    public const PROJECT_ID = "project_id";
    public const DEFAULT_FREE_SULFUR = "default_free_sulfur"; // Výchozí hodnota, na kterou se mají vína sířit v mg / l
    public const DEFAULT_LIQUID_SULFUR = "default_liquid_sulfur"; // Výchozí hodnota pro dávkování tekuté síry v %

    protected $fillable = [
        self::PROJECT_ID,
        self::DEFAULT_FREE_SULFUR,
        self::DEFAULT_LIQUID_SULFUR,
    ];
}
