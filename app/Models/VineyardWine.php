<?php

namespace App\Models;

use Database\Factories\VineyardWineFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\VineyardWine
 *
 * @property int $id
 * @property int $vineyard_id
 * @property int $wine_id
 * @property string $title
 * @property int $quantity
 * @property string|null $note
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static VineyardWineFactory factory(...$parameters)
 * @method static Builder|VineyardWine newModelQuery()
 * @method static Builder|VineyardWine newQuery()
 * @method static Builder|VineyardWine query()
 * @method static Builder|VineyardWine whereCreatedAt($value)
 * @method static Builder|VineyardWine whereId($value)
 * @method static Builder|VineyardWine whereNote($value)
 * @method static Builder|VineyardWine whereQuantity($value)
 * @method static Builder|VineyardWine whereTitle($value)
 * @method static Builder|VineyardWine whereUpdatedAt($value)
 * @method static Builder|VineyardWine whereVineyardId($value)
 * @method static Builder|VineyardWine whereWineId($value)
 * @mixin Eloquent
 */
class VineyardWine extends Model
{
    use HasFactory;

    public const ID = "id";
    public const VINEYARD_ID = "vineyard_id";
    public const WINE_ID = "wine_id";
    public const TITLE = "title";
    public const QUANTITY = "quantity";
    public const NOTE = "note";

    protected $fillable = [
        self::VINEYARD_ID,
        self::WINE_ID,
        self::TITLE,
        self::QUANTITY,
        self::NOTE,
    ];
}
