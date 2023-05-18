<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Wine;
use App\Models\WineEvidenceWine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @author Petr Šťastný <petrstastny09@gmail.com>
 */
class WineEvidenceWineResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            WineEvidenceWine::ID => $this->id,
            WineEvidenceWine::WINE_EVIDENCE_ID => $this->wine_evidence_id,
            "wine" => Wine::findOrFail($this->wine_id),
            Model::CREATED_AT => $this->created_at,
            Model::UPDATED_AT => $this->updated_at,
        ];
    }
}
