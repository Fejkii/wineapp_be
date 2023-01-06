<?php

namespace App\Models;

use Database\Factories\VineyardRecordTypeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\VineyardRecordType
 *
 * @property int $id
 * @property string $title
 * @property string|null $color
 * @property string|null $note
 * @method static VineyardRecordTypeFactory factory(...$parameters)
 * @method static Builder|VineyardRecordType newModelQuery()
 * @method static Builder|VineyardRecordType newQuery()
 * @method static Builder|VineyardRecordType query()
 * @method static Builder|VineyardRecordType whereColor($value)
 * @method static Builder|VineyardRecordType whereId($value)
 * @method static Builder|VineyardRecordType whereNote($value)
 * @method static Builder|VineyardRecordType whereTitle($value)
 * @mixin Eloquent
 */
class VineyardRecordType extends Model
{
    use HasFactory;

    public $timestamps = false;

    public const TITLE = "title";
    public const COLOR = "color";
    public const NOTE = "note";

    protected $fillable = [
        self::TITLE,
        self::COLOR,
        self::NOTE,
    ];
}
