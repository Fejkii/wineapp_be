<?php

namespace App\Models;

use Database\Factories\WineEvidenceWineFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\WineEvidenceWine
 *
 * @property int $id
 * @property int $wine_evidence_id
 * @property int $wine_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static WineEvidenceWineFactory factory($count = null, $state = [])
 * @method static Builder|WineEvidenceWine newModelQuery()
 * @method static Builder|WineEvidenceWine newQuery()
 * @method static Builder|WineEvidenceWine query()
 * @method static Builder|WineEvidenceWine whereCreatedAt($value)
 * @method static Builder|WineEvidenceWine whereId($value)
 * @method static Builder|WineEvidenceWine whereUpdatedAt($value)
 * @method static Builder|WineEvidenceWine whereWineEvidenceId($value)
 * @method static Builder|WineEvidenceWine whereWineId($value)
 * @mixin Eloquent
 */
class WineEvidenceWine extends Model
{
    use HasFactory;

    public const ID = "id";
    public const WINE_EVIDENCE_ID = "wine_evidence_id";
    public const WINE_ID = "wine_id";

    protected $fillable = [
        self::WINE_EVIDENCE_ID,
        self::WINE_ID,
    ];
}
