<?php

namespace App\Models;

use Database\Factories\WineRecordTypeFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WineRecordType
 *
 * @method static WineRecordTypeFactory factory(...$parameters)
 * @method static Builder|WineRecordType newModelQuery()
 * @method static Builder|WineRecordType newQuery()
 * @method static Builder|WineRecordType query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property string|null $color
 * @property string|null $note
 * @method static Builder|WineRecordType whereColor($value)
 * @method static Builder|WineRecordType whereId($value)
 * @method static Builder|WineRecordType whereNote($value)
 * @method static Builder|WineRecordType whereTitle($value)
 */
class WineRecordType extends Model
{
    use HasFactory;

    public const TITLE = "title";
    public const COLOR = "color";
    public const NOTE = "note";

    protected $fillable = [
        self::TITLE,
        self::COLOR,
        self::NOTE,
    ];
}
