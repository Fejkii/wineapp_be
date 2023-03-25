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
 * @property string $date
 * @method static Builder|VineyardRecord whereDate($value)
 * @property int|null $vineyard_wine_id
 * @property int|null $vineyard_record_type_id
 * @method static Builder|VineyardRecord whereVineyardRecordTypeId($value)
 * @method static Builder|VineyardRecord whereVineyardWineId($value)
 * @property string|null $data
 * @method static Builder|VineyardRecord whereData($value)
 * @mixin Eloquent
 */
class VineyardRecord extends Model
{
    use HasFactory;

    public const ID = "id";
    public const VINEYARD_ID = "vineyard_id";
    public const VINEYARD_WINE_ID = "vineyard_wine_id";
    public const VINEYARD_RECORD_TYPE_ID = "vineyard_record_type_id";
    public const VINEYARD_RECORD_TYPE = "vineyard_record_type";
    public const TITLE = "title";
    public const DATA = "data";
    public const DATE = "date";
    public const NOTE = "note";

    protected $fillable = [
        self::VINEYARD_ID,
        self::VINEYARD_WINE_ID,
        self::VINEYARD_RECORD_TYPE_ID,
        self::TITLE,
        self::DATA,
        self::DATE,
        self::NOTE,
    ];
}
