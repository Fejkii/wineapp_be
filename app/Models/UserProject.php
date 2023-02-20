<?php

namespace App\Models;

use Database\Factories\UserProjectFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\UserProject
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property int $is_default
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Project $project
 * @property-read User $user
 * @method static UserProjectFactory factory(...$parameters)
 * @method static Builder|UserProject newModelQuery()
 * @method static Builder|UserProject newQuery()
 * @method static Builder|UserProject query()
 * @method static Builder|UserProject whereCreatedAt($value)
 * @method static Builder|UserProject whereId($value)
 * @method static Builder|UserProject whereIsDefault($value)
 * @method static Builder|UserProject whereProjectId($value)
 * @method static Builder|UserProject whereUpdatedAt($value)
 * @method static Builder|UserProject whereUserId($value)
 * @property int $is_owner
 * @method static Builder|UserProject whereIsOwner($value)
 * @mixin Eloquent
 */
class UserProject extends Model
{
    use HasFactory;

    public const ID = "id";
    public const PROJECT_ID = "project_id";
    public const USER_ID = "user_id";
    public const IS_DEFAULT = "is_default";
    public const IS_OWNER = "is_owner";

    protected $fillable = [
        self::PROJECT_ID,
        self::USER_ID,
        self::IS_DEFAULT,
        self::IS_OWNER,
    ];

    protected $casts = [
        self::IS_DEFAULT => 'boolean',
        self::IS_OWNER => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
