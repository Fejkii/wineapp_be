<?php

namespace App\Models;

use Database\Factories\WineRecordFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WineRecord
 *
 * @property int $id
 * @property int $wine_evidence_id
 * @property int $wine_record_type_id
 * @property string $title
 * @property string $date
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineRecordFactory factory(...$parameters)
 * @method static Builder|WineRecord newModelQuery()
 * @method static Builder|WineRecord newQuery()
 * @method static Builder|WineRecord query()
 * @method static Builder|WineRecord whereCreatedAt($value)
 * @method static Builder|WineRecord whereDate($value)
 * @method static Builder|WineRecord whereId($value)
 * @method static Builder|WineRecord whereNote($value)
 * @method static Builder|WineRecord whereTitle($value)
 * @method static Builder|WineRecord whereUpdatedAt($value)
 * @method static Builder|WineRecord whereWineEvidenceId($value)
 * @method static Builder|WineRecord whereWineRecordTypeId($value)
 * @property string|null $data
 * @method static Builder|WineRecord whereData($value)
 * @mixin Eloquent
 */
class WineRecord extends Model
{
    use HasFactory;

    public const ID = "id";
    public const WINE_EVIDENCE_ID = "wine_evidence_id";
    public const WINE_RECORD_TYPE_ID = "wine_record_type_id";
    public const WINE_RECORD_TYPE = "wine_record_type";
    public const TITLE = "title";
    public const DATA = "data";
    public const DATE = "date";
    public const NOTE = "note";

    protected $fillable = [
        self::WINE_EVIDENCE_ID,
        self::WINE_RECORD_TYPE_ID,
        self::TITLE,
        self::DATA,
        self::DATE,
        self::NOTE,
    ];
}
