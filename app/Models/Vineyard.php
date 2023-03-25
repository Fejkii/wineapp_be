<?php

namespace App\Models;

use Database\Factories\VineyardFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Vineyard
 *
 * @property int $id
 * @property int $project_id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static VineyardFactory factory(...$parameters)
 * @method static Builder|Vineyard newModelQuery()
 * @method static Builder|Vineyard newQuery()
 * @method static Builder|Vineyard query()
 * @method static Builder|Vineyard whereCreatedAt($value)
 * @method static Builder|Vineyard whereId($value)
 * @method static Builder|Vineyard whereProjectId($value)
 * @method static Builder|Vineyard whereTitle($value)
 * @method static Builder|Vineyard whereUpdatedAt($value)
 * @property float|null $area
 * @method static Builder|Vineyard whereArea($value)
 * @mixin Eloquent
 */
class Vineyard extends Model
{
    use HasFactory;

    public const ID = "id";
    public const PROJECT_ID = "project_id";
    public const TITLE = "title";
    public const AREA = "area";

    protected $fillable = [
        self::PROJECT_ID,
        self::TITLE,
        self::AREA,
    ];
}
