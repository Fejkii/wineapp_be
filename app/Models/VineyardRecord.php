<?php

namespace App\Models;

use Database\Factories\VineyardRecordFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\VineyardRecord
 *
 * @property int $id
 * @property int $vineyard_id
 * @property string $title
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static VineyardRecordFactory factory(...$parameters)
 * @method static Builder|VineyardRecord newModelQuery()
 * @method static Builder|VineyardRecord newQuery()
 * @method static Builder|VineyardRecord query()
 * @method static Builder|VineyardRecord whereCreatedAt($value)
 * @method static Builder|VineyardRecord whereId($value)
 * @method static Builder|VineyardRecord whereNote($value)
 * @method static Builder|VineyardRecord whereTitle($value)
 * @method static Builder|VineyardRecord whereUpdatedAt($value)
 * @method static Builder|VineyardRecord whereVineyardId($value)
 * @mixin Eloquent
 * @property string $date
 * @method static Builder|VineyardRecord whereDate($value)
 */
class VineyardRecord extends Model
{
    use HasFactory;

    public const VINEYARD_ID = "vineyard_id";
    public const TITLE = "title";
    public const DATE = "date";
    public const NOTE = "note";

    protected $fillable = [
        self::VINEYARD_ID,
        self::TITLE,
        self::DATE,
        self::NOTE,
    ];
}