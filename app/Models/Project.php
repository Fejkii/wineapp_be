<?php

namespace App\Models;

use Database\Factories\ProjectFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Project
 *
 * @method static ProjectFactory factory(...$parameters)
 * @method static Builder|Project newModelQuery()
 * @method static Builder|Project newQuery()
 * @method static Builder|Project query()
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Project whereCreatedAt($value)
 * @method static Builder|Project whereId($value)
 * @method static Builder|Project whereTitle($value)
 * @method static Builder|Project whereUpdatedAt($value)
 * @method static Builder|Project whereUsers($value)
 * @property-read UserProject|null $userProject
 * @mixin Eloquent
 */
class Project extends Model
{
    use HasFactory;

    public const ID = "id";
    public const TITLE = "title";

    protected $fillable = [
        self::TITLE,
    ];

    public function userProject(): BelongsTo
    {
        return $this->belongsTo(UserProject::class);
    }
}
